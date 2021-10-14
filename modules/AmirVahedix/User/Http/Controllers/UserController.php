<?php


namespace AmirVahedix\User\Http\Controllers;


use AmirVahedix\User\Models\User;
use AmirVahedix\User\Repositories\UserRepo;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userRepo;

    public function __construct(UserRepo $userRepo)
    {
        $this->userRepo = $userRepo;
    }

    public function index()
    {
        $this->authorize('index_users', User::class);

        $users = $this->userRepo->paginate();
        return view('User::index', compact('users'));
    }

    public function syncRoles(User $user, Request $request)
    {
        $this->authorize('manage_user_roles', User::class);

        $user->syncRoles($request->get('roles'));

        toast('تغییرات باموفقیت اعمال شد.', 'success');
        return redirect()->route('admin.users.index');
    }
}
