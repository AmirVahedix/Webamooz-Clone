<?php

namespace AmirVahedix\User\Tests\Feature\Auth;

use AmirVahedix\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{

    public function test_user_can_see_login_form()
    {
        $response = $this->get(route('login'));

        $response->assertOk();
    }

    public function test_user_can_login_with_email () {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'email' => $user->email,
            'password' => '!@#ABCabc123'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('index'));
    }

    public function test_user_can_login_with_mobile () {
        $user = User::factory()->create();

        $response = $this->post(route('login'), [
            'email' => $user->mobile,
            'password' => '!@#ABCabc123'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(route('index'));
    }
}
