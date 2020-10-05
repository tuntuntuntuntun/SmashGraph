<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FighterPower;

class GraphController extends Controller
{
    public function index()
    {
        // ファイター情報を入力ページへ
        return view('index');
    }

    // グラフ作成に必要なデータを挿入
    public function inputData(Request $request)
    {
        // フォームから送信されたデータを変数へ
        $fighter = $request->fighter;
        $power = $request->power;
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
        if (true) {
            // ログインユーザーの最新のレコードを取得
            $fighter_power = FighterPower::where('user_id', $user_id)->orderBy('created_at', 'desc')->first();
            // 上で取得したファイターが含まれるレコードを取得
            $fighter_data = FighterPower::where('user_id', $user_id)->where('fighter', $fighter_power->fighter)->get();
        }

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
            array_push($created_at, $fighter_data[$i]->created_at);
        }

        //JSONエンコード
        $fighter = json_encode($fighter);
        $power = json_encode($power);
        $created_at = json_encode($created_at);

        return view('graph', ['fighter' => $fighter, 'power' => $power, 'created_at' => $created_at]);
    }
}
