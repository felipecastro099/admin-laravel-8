<?php

namespace App\Http\Controllers\Admin\Audit;

use App\Http\Controllers\Controller;
use App\Models\Audit;
use App\Models\User;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    use SEOToolsTrait;

    private $audits;
    private $users;

    public function __construct(Audit $audits, User $users)
    {
        // Middlewares
        $this->middleware('permission:view_audits', ['only' => ['index', 'show']]);

        // Dependency Injection
        $this->audits = $audits;
        $this->users = $users;
    }

    /**
     * Display a listing of the resource.
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        // Start query
        $query = $this->audits->latest();

        // Fetch all results
        $results = $query->paginate(10)
            ->appends($request->except('page'));

        // Set meta tags
        $this->seo()->setTitle('Auditoria');

        // Return view
        return view('admin.audits.index', compact('results'));
    }
}
