<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    use SEOToolsTrait;

    private $roles;
    private $permissions;

    /**
     * Constructor
     */
    public function __construct(Role $roles, Permission $permissions)
    {
        // Middlewares
        $this->middleware('permission:view_roles', ['only' => ['index']]);
        $this->middleware('permission:add_roles', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_roles', ['only' => ['edit', 'update']]);

        // Dependency Injection
        $this->roles = $roles;
        $this->permissions = $permissions;
    }

    /**
     * Display a listing of the resource.
     * @return Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Fetch all results
        $results = $this->roles->byUser(auth()->user())
            ->orderBy('details', 'ASC')
            ->paginate(10);

        // Set meta tags
        $this->seo()->setTitle('Grupos');

        // Return view
        return view('admin.roles.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        // Fetch all permissions
        $permissions = $this->permissions->get();

        // Set meta tags
        $this->seo()->setTitle('Novo Grupo');

        // Return view
        return view('admin.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:60', 'unique:permissions,name'],
            'details' => ['required', 'max:60'],
            'permissions' => ['required']
        ]);

        // Create result
        $result = $this->roles->create($request->only('name', 'details'));

        // Assign permissions to role
        $result->syncPermissions($request->get('permissions', []));

        // Redirect to list
        return redirect()->route('admin.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        // Fetch result by id
        $result = $this->roles->byUser(auth()->user())->findOrFail($id);

        // Fetch all permissions
        $permissions = $this->permissions->get();

        // Set meta tags
        $this->seo()->setTitle('Editar Grupo');

        // Return view
        return view('admin.roles.edit', compact('result', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'details' => ['required', 'max:60'],
            'permissions' => ['required']
        ]);

        // Fetch result
        $result = $this->roles->byUser(auth()->user())->findOrFail($id);

        // Fill data
        $result->fill($request->only('details'))->save();

        // Assign permissions to role
        $result->syncPermissions($request->get('permissions', []));

        // Redirect to list
        return redirect()->route('admin.roles.index');
    }
}
