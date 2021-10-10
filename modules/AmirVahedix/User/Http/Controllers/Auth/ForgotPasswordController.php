<?php

namespace AmirVahedix\User\Http\Controllers\Auth;

use AmirVahedix\User\Http\Requests\SendResetCodeRequest;
use AmirVahedix\User\Http\Requests\VerifyCodeRequest;
use AmirVahedix\User\Models\User;
use AmirVahedix\User\Repositories\UserRepo;
use AmirVahedix\User\Services\VerifyCodeService;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function showVerifyCodeRequestForm()
    {
        return view('User::auth.passwords.email');
    }

    public function sendResetCodeEmail(SendResetCodeRequest $request): RedirectResponse
    {
        $user = resolve(UserRepo::class)->findByEmail($request->get('email'));
        $user->sendResetPasswordNotification();

        session()->flash('user_id', $user->id);
        return redirect()->route('password.verify.form');
    }

    public function showVerifyForm () {
        if (!session()->get('user_id')) abort(403);

        session()->reflash();
        return view('User::auth.passwords.verify');
    }

    public function verify (VerifyCodeRequest $request) {
        if (!session()->get('user_id')) abort(403);

        $user = resolve(UserRepo::class)->find(session()->get('user_id'));
        $result = VerifyCodeService::check($user->id, $request->get('verify_code'));

        if (!$result) {
            session()->reflash();
            return back()->withErrors(['verify_code' => 'کد تایید نامعتبر است.']);
        }

        session()->forget('user_id');
        auth()->loginUsingId($user->id);
        return redirect()->route('password.reset');
    }
}
