<?php


namespace AmirVahedix\Authorization\Http\Controllers;


use AmirVahedix\Authorization\Http\Requests\CreateRoleRequest;
use AmirVahedix\Authorization\Http\Requests\EditRoleRequest;
use AmirVahedix\Authorization\Models\Role;
use AmirVahedix\Authorization\Repositories\AuthorizationRepo;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class AuthorizationController extends Controller
{
    private $authorizationRepo;

    public function __construct(AuthorizationRepo $authorizationRepo)
    {
        $this->authorizationRepo = $authorizationRepo;
    }

    public function index()
    {
        $this->authorize('manag_roles', Role::class);

        $roles = Role::all();
        $permissions = Permission::all();
        return view('Authorization::index', compact('roles', 'permissions'));
    }

    public function store(CreateRoleRequest $request)
    {
        $this->authorize('manag_roles', Role::class);

        $this->authorizationRepo->createRole($request->get('name'), $request->get('permissions'));

        toast('نقش کاربری باموفقیت ایجاد شد.', 'success');
        return back();
    }

    public function edit(Role $role)
    {
        $this->authorize('manag_roles', Role::class);

        $permissions = Permission::all();
        return view('Authorization::edit', compact('role', 'permissions'));
    }

    public function update(Role $role, EditRoleRequest $request)
    {
        $this->authorize('manag_roles', Role::class);

        $this->authorizationRepo
            ->update($role, $request->get('name'), $request->get('permissions'));

        toast('تغییرات باموفقیت اعمال شد.', 'success');
        return redirect()->route('admin.authorization.index');
    }

    public function delete(Role $role)
    {
        $this->authorize('manag_roles', Role::class);

        $role->delete();

        toast('نقش باموفقیت حذف شد.', 'success');
        return redirect()->route('admin.authorization.index');
    }
}
