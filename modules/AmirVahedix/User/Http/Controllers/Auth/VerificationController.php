<?php

namespace AmirVahedix\User\Http\Controllers\Auth;

use AmirVahedix\User\Services\VerifyCodeService;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Email Verification Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling email verification for any
    | user that recently registered with the application. Emails may also
    | be re-sent if the user didn't receive the original email message.
    |
    */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    /**
     * Show the email verification notice.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function show(Request $request)
    {
        return $request->user()->hasVerifiedEmail()
                        ? redirect($this->redirectPath())
                        : view('User::auth.verify');
    }

    public function verify(Request $request, $id)
    {
        $request->validate([
            'verify_code' => ['required', 'numeric', 'digits:6']
        ]);

        $code = VerifyCodeService::get(auth()->id());

        if ($code == $request->get('verify_code')) {
            auth()->user()->markEmailAsVerified();
            VerifyCodeService::destroy(auth()->id());
            return redirect(route('index'));
        }

        return back()->withErrors([
            'verify_code' => 'کد تایید نامعتبر است.'
        ]);
    }
}
