<?php /** @noinspection PhpParamsInspection */

namespace AmirVahedix\User\Tests\Feature\Auth;

use AmirVahedix\User\Models\User;
use AmirVahedix\User\Services\VerifyCodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResetPasswordTest extends TestCase
{
    public function test_guest_user_can_see_reset_password_request_form()
    {
        $response = $this->get(route('password.request'));
        $response->assertOk();
    }

    public function test_authenticated_user_can_not_see_reset_password_request_form()
    {
        $user = User::factory()->create();
        $response = $this
            ->actingAs($user)
            ->get(route('password.request'));

        $response->assertRedirect(route('index'));
    }

    public function test_user_can_see_verify_form_with_correct_email()
    {
        $user = User::factory()->create();
        $this->post(route('password.email'), [
            'email' => $user->email
        ]);

        $this->get(route('password.verify.form'))
            ->assertOk();
    }

    public function test_user_can_not_see_verify_form_without_using_reset_request_form()
    {
        $this->get(route('password.verify.form'))
            ->assertStatus(403);
    }

    public function test_user_is_banned_after_6_attempts_for_reset_password()
    {
        $user = User::factory()->make();
        for ($i = 0; $i < 5; $i++) {
            $this->post(route('password.email'), ['email' => $user->email])
                ->assertStatus(302);
        }

        $this->post(route('password.email'), ['email' => $user->email])
            ->assertStatus(429);
    }
}
