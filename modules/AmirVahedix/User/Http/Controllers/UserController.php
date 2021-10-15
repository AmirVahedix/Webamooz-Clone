<?php


namespace AmirVahedix\User\Http\Controllers;


use AmirVahedix\Media\Services\MediaService;
use AmirVahedix\User\Http\Requests\UpdateAvatarRequest;
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
        $this->authorize('manage_users', User::class);

        $users = $this->userRepo->paginate();
        return view('User::admin.index', compact('users'));
    }

    public function edit(User $user)
    {
        $this->authorize('manage_users', User::class);
        return view('User::admin.edit', compact('user'));
    }

    public function update(User $user, Request $request)
    {
        $user->update($request->all());

        toast('تغییرات باموفقیت انجام شد.', 'success');
        return redirect(route('admin.users.index'));
    }

    public function delete(User $user)
    {
        $user->delete();

        toast('کاربر باموفقیت حذف شد.', 'success');
        return redirect(route('admin.users.index'));
    }

    public function syncRoles(User $user, Request $request)
    {
        $this->authorize('manage_user_roles', User::class);

        $user->syncRoles($request->get('roles'));

        toast('تغییرات باموفقیت اعمال شد.', 'success');
        return redirect()->route('admin.users.index');
    }

    public function banToggle(User $user)
    {
        if ($user->status == User::STATUS_ACTIVE) {
            $user->update(['status' => User::STATUS_BAN ]);
            toast('کاربر بن شد.', 'success');
        } else if ($user->status == User::STATUS_BAN) {
            $user->update(['status' => User::STATUS_ACTIVE ]);
            toast('کاربر فعال شد.', 'success');
        }
        return back();
    }
}
