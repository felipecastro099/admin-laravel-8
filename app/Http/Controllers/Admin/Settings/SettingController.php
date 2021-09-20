<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use SEOToolsTrait;

    private $settings;

    /**
     * Constructor
     */
    public function __construct(Setting $settings)
    {
        // Middlewares
        $this->middleware('permission:view_settings', ['only' => ['index']]);
        $this->middleware('permission:add_settings', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit_settings', ['only' => ['edit', 'update']]);
        $this->middleware('permission:delete_settings', ['only' => ['destroy']]);

        // Dependency Injection
        $this->settings = $settings;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Fetch all results
        $results = $this->settings->orderBy('title', 'ASC')
            ->paginate(10);

        // Set meta tags
        $this->seo()->setTitle('Configurações');

        // Return view
        return view('admin.settings.index', compact('results'));
    }

    /**
     * Show the form for creating a new resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        // Set meta tags
        $this->seo()->setTitle('Nova Configuração');

        // Return view
        return view('admin.settings.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'key' => ['required', 'max:255', 'unique:settings,key'],
            'title' => ['required', 'max:255'],
            'value' => ['nullable', 'max:255'],
        ]);

        // Create result
        $result = $this->settings->create($request->all());

        // Redirect to list
        return redirect()->route('admin.settings.index');
    }

    /**
     * Show the form for editing the specified resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        // Fetch result by id
        $result = $this->settings->findOrFail($id);

        // Set meta tags
        $this->seo()->setTitle('Editar Configuração');

        // Return view
        return view('admin.settings.edit', compact('result'));
    }

    /**
     * Update the specified resource in storage.
     * @param  Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'max:255'],
            'value' => ['nullable', 'max:255'],
        ]);

        // Fetch result
        $result = $this->settings->findOrFail($id);

        // Fill data and save
        $result->fill($request->except('key'))->save();

        // Redirect to list
        return redirect()->route('admin.settings.index');
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
            if($result = $this->settings->find($id)):
                // Remove result
                $result->delete();

                // Return success response
                return response()->json(['success' => true, 'message' => 'Configuração removida com sucesso . '], 200);
            else:
                // Return error response
                return response()->json(['success' => false, 'message' => 'Configuração não encontrada . '], 400);
            endif;
        endif;

        // Redirect to back page
        return redirect()->back();
    }
}
