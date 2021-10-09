<?php

namespace Tests\Feature\Auth;

use AmirVahedix\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    public function test_user_can_see_register_form()
    {
        $response = $this->get(route('register'));
        $response->assertOk();
    }

    public function test_user_can_register () {
        $data = User::factory()->make()->toArray();
        $data['password'] = '!@#ABCabc123456';
        $data['password_confirmation'] = '!@#ABCabc123456';

        $response = $this->post(route('register'), $data);

        $response->assertRedirect(route('index'));
        $this->assertCount(1, User::all());
    }

    public function test_user_must_verify_email () {
        $this->post(route('register'), User::factory()->make()->toArray());

        $response = $this->get(route('index'));
        $response->assertRedirect(route('verification.notice'));
    }

    public function test_verified_user_can_see_index () {
        $user = User::factory()->verified()->state([
            'password' => '!@#ABCabc123456',
        ])->create();

        $this->actingAs($user);
        $this->assertAuthenticated();

        $resopnse = $this->get(route('index'));
        $resopnse->assertOk();
    }
}
