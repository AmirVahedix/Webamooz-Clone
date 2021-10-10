<?php /** @noinspection PhpUndefinedMethodInspection */

namespace AmirVahedix\User\Http\Controllers\Auth;

use AmirVahedix\User\Http\Requests\ResetPasswordRequest;
use AmirVahedix\User\Models\User;
use AmirVahedix\User\Rules\ValidPassword;
use AmirVahedix\User\Services\UserService;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    protected $redirectTo = RouteServiceProvider::HOME;

    public function showResetForm(Request $request)
    {
        return view('User::auth.passwords.reset');
    }

    public function reset(ResetPasswordRequest $request): RedirectResponse
    {
        UserService::changePassword(auth()->user(), $request->get('password'));
        return redirect()->route('index');
    }
}
