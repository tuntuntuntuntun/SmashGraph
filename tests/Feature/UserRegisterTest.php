<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRegisterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp() :void
    {
        parent::setUp();

        $this->artisan('migrate');
    }

    public function test_ユーザー登録()
    {
        $user = User::create([
            'name' => 'John Titor',
            'mail' => 'john@email.com',
            'password' => bcrypt('secret'),
        ]);

        $this->assertEquals(1, User::all()->count());
    }
}
