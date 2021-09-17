<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Traits\SEOTools;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    use SEOTools;

    public function index()
    {
        // Set meta tags
        $this->seo()->setTitle('Dashboard');

        return view('admin.dashboard.index');
    }
}
