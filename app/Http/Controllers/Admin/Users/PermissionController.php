<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Auth;
use App\Models\Permission;
use App\Models\Role;

class PermissionController extends Controller
{
  use SEOToolsTrait;

  private $permissions;
  private $roles;

  /**
   * Constructor
   */
  public function __construct(Permission $permissions, Role $roles)
  {
    // Middlewares
    $this->middleware('permission:view_permissions', ['only' => ['index']]);
    $this->middleware('permission:add_permissions', ['only' => ['create', 'store']]);
    $this->middleware('permission:edit_permissions', ['only' => ['edit', 'update']]);
    $this->middleware('permission:delete_permissions', ['only' => ['destroy']]);

    // Dependency Injection
    $this->permissions = $permissions;
    $this->roles = $roles;
  }

  /**
   * Display a listing of the resource.
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
   */
  public function index(Request $request)
  {
    // Fetch all results
    $results = $this->permissions->orderBy('details', 'ASC')
                    ->paginate(10);

    // Set meta tags
    $this->seo()->setTitle('Permissões');

    // Return view
    return view('admin.permissions.index', compact('results'));
  }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        // Fetch all roles
        $roles = $this->roles->byUser(Auth::user())->get();

        // Set meta tags
        $this->seo()->setTitle('Nova Permissão');

        // Return view
        return view('admin.permissions.create', compact('roles'));
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
            'roles' => ['required']
        ]);

        // Create result
        $result = $this->permissions->create($request->only('name', 'details'));

        // Get roles
        $roles = $request->get('roles', []);

        // Fetch all user roles
        $userRoles = $this->roles->byUser(Auth::user())->get();

        // Assign permission to roles
        foreach($userRoles as $role):
            if(in_array($role->name, $roles)):
                if(!$role->hasPermissionTo($result->name)):
                    $result->assignRole($role);
                endif;
            else:
                $result->removeRole($role);
            endif;
        endforeach;

        // Redirect to list
        return redirect()->route('admin.permissions.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        // Fetch result by id
        $result = $this->permissions->findOrFail($id);

        // Fetch all roles
        $roles = $this->roles->byUser(Auth::user())->get();

        // Set meta tags
        $this->seo()->setTitle('Editar Permissão');

        // Return view
        return view('admin.permissions.edit', compact('result', 'roles'));
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
        ]);

        // Fetch result
        $result = $this->permissions->findOrFail($id);

        // Fill data
        $result->fill($request->only('details'));

        // Save result
        $result->save();

        // Redirect to list
        return redirect()->route('admin.permissions.index');
    }

    /**
     * Remove the specified resource from storage.
     * @param  Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()):
            // If result exist
            if($result = $this->permissions->find($id)):
                // Fetch all roles
                $roles = $this->roles->get();

                // Remove permission from roles
                foreach($roles as $role):
                    $role->revokePermissionTo($result);
                endforeach;

                // Remove result
                $result->delete();

                // Return success response
                return response()->json(['success' => true, 'message' => 'Permissão removida com sucesso.'], 200);
            else:
                // Return error response
                return response()->json(['success' => false, 'message' => 'Permissão não encontrada.'], 400);
            endif;
        endif;

        // Error message
        flash('Falha ao remover permissão.')->error();

        // Redirect to back page
        return redirect()->back();
    }
}
