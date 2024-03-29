<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    // public function test_example(): void
    // {
    //     $this->assertTrue(true);
    // }

    protected function refresh_table($table)
    {
        DB::table($table)->truncate(); //pour supprimmer tous les lignes mais conserver la structure de tableu
    }

    public function test_create_user()
    {
        $this->refresh_table('users');

        $user = [
            'name' => 'zerzkhane',
            'email' => 'zerzkhane@gmail.com',
            'password' => 'zerzkhane@gmail.com',
            'role' => 'user'
        ];

        $response = $this->postJson('/api/CreateUser',$user);

        $response->assertStatus(201);
        $this->assertCount(1, User::all());
    }


    public function test_delete_user()
    {
        $this->refresh_table('users');

        $user = User::create([
            'name' => 'zerz',
            'email' => 'zerz@gmail.com',
            'password' => 'zerz@gmail.com',
            'role' => 'user'
        ]);

        $response = $this->deleteJson('/api/DeleteUser', ['id' => $user->id]);
        $response->assertStatus(202);
    }


    public function test_update_user()
    {
        $this->refresh_table('users');

        $user = User::create([
            'name' => 'hello',
            'email' => 'hello@gmail.com',
            'password' => 'hello@gmail.com',
            'role' => 'user'
        ]);

        $UpdateUser = [
            'name' => 'world',
            'email' => 'world@gmail.com',
            'password' => 'world@gmail.com',
            'role' => 'user'
        ];

        $response = $this->putJson('/api/UpdateUser/'.$user->id, $UpdateUser);
        $response->assertStatus(202);

        $responseUpdateData = $response->json();

        $this->assertEquals('world', $responseUpdateData['name']);
        $this->assertEquals('world@gmail.com', $responseUpdateData['email']);
    }

}
