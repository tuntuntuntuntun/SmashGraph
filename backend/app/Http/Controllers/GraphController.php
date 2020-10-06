<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FighterPowerRequest;
use App\Models\User;
use App\Models\FighterPower;
use Abraham\TwitterOAuth\TwitterOAuth;

class GraphController extends Controller
{
    // レコードを取得する
    protected function getRecord($request, $view)
    {
        $user_id = auth()->user()->id;

        $fighter = json_decode($request->fighter);

        // ログインユーザーかつ現在表示されているグラフのファイターであるレコードを取得
        $specific_fighter = FighterPower::where('user_id', $user_id)->where('fighter', $fighter)->get();

        return view($view, ['fighter' => $fighter, 'specific_fighter' => $specific_fighter]);
    }

    public function index(Request $request)
    {
        $user_id = auth()->user()->id;

        // 検索処理
        if($request->has('keyword')) {
            // キーワードに含まれているファイターのみ取得
            $fighters = FighterPower::where('user_id', $user_id)->where('fighter', 'like', '%'.$request->keyword.'%')->groupBy('fighter')->get(['fighter']);
        } else {
            // 重複削除して取得
            $fighters = FighterPower::where('user_id', $user_id)->groupBy('fighter')->get(['fighter']);
        }

        // ファイター情報を入力ページへ
        return view('index', ['fighters' => $fighters]);
    }

    // グラフ作成に必要なデータを挿入
    public function inputData(FighterPowerRequest $request)
    {
        // フォームから送信されたデータを変数へ
        $fighter = $request->input_fighter;
        $power = $request->input_power;
        $user_id = auth()->user()->id;

        // データを挿入
        FighterPower::create(['user_id' => $user_id, 'fighter' => $fighter, 'power' => $power]);

        return redirect()->to('/graph');
    }

    // グラフを表示する
    public function showGraph(Request $request)
    {
        $user_id = auth()->user()->id;
        
        // 最新のレコードまたは選択されたファイターのレコードを取得
        if ($request->has('search')) {
            $fighter_power = FighterPower::where('user_id', $user_id)->where('fighter', $request->fighter)->first();
        } else {
            // ログインユーザーの最新のレコードを取得
            $fighter_power = FighterPower::where('user_id', $user_id)->orderBy('created_at', 'desc')->first();
        }

        // 上で取得したファイターが含まれるレコードを取得
        $fighter_data = FighterPower::where('user_id', $user_id)->where('fighter', $fighter_power->fighter)->get();

        // ファイター名を取り出し変数へ
        $fighter = $fighter_data[0]->fighter;

        // 世界戦闘力は配列へ
        $power = [];
        for ($i = 0; $i < count($fighter_data); $i++) {
            array_push($power, $fighter_data[$i]->power);
        }

        // created_atは配列へ
        $created_at = [];
        for ($i = 0; $i < count($fighter_data); $i++) {
            array_push($created_at, $fighter_data[$i]->created_at->format('Y-m-d H:i:s'));
        }

        //JSONエンコード
        $fighter = json_encode($fighter);
        $power = json_encode($power);
        $created_at = json_encode($created_at);

        return view('graph', ['fighter' => $fighter, 'power' => $power, 'created_at' => $created_at]);
    }

    // 削除ページを表示
    public function showDelete(Request $request)
    {
        return $this->getRecord($request, 'delete');
    }

    // 削除処理
    public function delete(Request $request)
    {
        $user_id = auth()->user()->id;

        $created_at = $request->delete_record;

        // 特定のレコードを削除
        FighterPower::where('user_id', $user_id)->where('created_at', $created_at)->delete();

        return redirect()->to('/');
    }

    // 編集ページを表示
    public function showEdit(Request $request)
    {
        return $this->getRecord($request, 'edit');
    }

    // 編集
    public function edit(Request $request)
    {
        $user_id = auth()->user()->id;
        
        // フォームの数だけループさせる
        for ($i = 0; $i < $request->count; $i++) {
            // フォームに値が入力されていたとき、0ではないときの処理
            if ($request->power[$i]) {
                $created_at = $request->created_at[$i];

                // 編集するレコードを取得
                $edit_record = FighterPower::where('user_id', $user_id)->where('created_at', $created_at)->first();
                // 更新
                $edit_record->update(['power' => $request->power[$i]]);
            }
        }

        return redirect()->to('/');
    }

    // 最新の世界戦闘力をツイート
    public function tweet(Request $request)
    {
        $fighter = json_decode($request->fighter);
        $power = json_decode($request->power);
        // 最新の世界戦闘力を取得
        $latest_power = count($power) - 1;
        $power[$latest_power];

        $twitter = new TwitterOAuth(
            env('TWITTER_CLIENT_ID'),
            env('TWITTER_CLIENT_SECRET'),
            env('TWITTER_CLIENT_ID_ACCESS_TOKEN'),
            env('TWITTER_CLIENT_ID_ACCESS_TOKEN_SECRET'));

        $twitter->post("statuses/update", [
            "status" =>
                'ファイター: ' . $fighter . PHP_EOL . '世界戦闘力: ' . $power[$latest_power]
        ]);

        return redirect()->to('/graph');
    }
}
