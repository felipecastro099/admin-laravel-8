<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use SEOToolsTrait;

    private $users;

    /**
     * Constructor
     */
    public function __construct(User $users)
    {
        // Middlewares
        $this->middleware('permission:view_users', ['only' => ['index']]);
        $this->middleware('permission:add_users', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_users', ['only' => ['edit', 'update']]);

        // Dependency Injection
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     * @return Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Fetch all results
        $results = $this->users->paginate(10);

        // Set meta tags
        $this->seo()->setTitle('Usuários');

        // Return view
        return view('admin.users.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     * @return Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        // Set meta tags
        $this->seo()->setTitle('Usuários');

        // Return view
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:60'],
            'email' => ['required', 'email', 'unique:users,email'],
            'phone' => ['nullable']
        ]);

        $request->merge(['password' => bcrypt(config('admin.user.password'))]);

        // Create result
        $result = $this->users->create($request->all());

        // Redirect to list
        return redirect()->route('admin.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        // Fetch result by id
        $result = $this->users->findOrFail($id);

        // Set meta tags
        $this->seo()->setTitle('Editar Usuário');

        // Return view
        return view('admin.users.edit', compact('result'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'max:60'],
            'email' => ['required', 'email', "unique:users,email,{$id}"],
            'phone' => ['nullable']
        ]);

        // Fetch result
        $result = $this->users->findOrFail($id);

        // Fill data
        $result->fill($request->all())->save();

        // Redirect to list
        return redirect()->route('admin.users.index');
    }

}
