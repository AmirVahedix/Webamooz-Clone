<?php


namespace AmirVahedix\Authorization\Http\Controllers;


use AmirVahedix\Authorization\Http\Requests\CreateRoleRequest;
use AmirVahedix\Authorization\Repositories\AuthorizationRepo;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class AuthorizationController extends Controller
{
    /**
     * @var AuthorizationRepo
     */
    private $authorizationRepo;

    public function __construct(AuthorizationRepo $authorizationRepo)
    {
        $this->authorizationRepo = $authorizationRepo;
    }

    public function index()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        return view('Authorization::index', compact('roles', 'permissions'));
    }

    public function store(CreateRoleRequest $request)
    {
        $this->authorizationRepo->createRole($request->get('name'), $request->get('permissions'));

        toast('نقش کاربری باموفقیت ایجاد شد.', 'success');
        return back();
    }
}
