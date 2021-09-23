<?php

namespace App\Http\Controllers\Admin\Analytics;

use App\Http\Controllers\Controller;
use Artesaos\SEOTools\Traits\SEOTools as SEOToolsTrait;
use Analytics;
use Spatie\Analytics\Period;
use Carbon\Carbon;

class AnalyticController extends Controller
{
    use SEOToolsTrait;

    public function __construct()
    {
        $this->middleware('permission:view_analytics', ['only' => ['index']]);
    }

    /**
     * Return index
     **/
    public function index()
    {
        // Get google analytics data visitors for last 7 days
        $visitorsData = Analytics::performQuery(
            Period::days(7),
            'ga:users,ga:pageviews',
            ['dimensions' => 'ga:date']
        );

        $vtDate = collect($visitorsData['rows'] ?? [])->map(function (array $dateRow) {
            return Carbon::createFromFormat('Ymd', $dateRow[0])->format('y-m-d');
        });

        $vtData = collect($visitorsData['rows'] ?? [])->map(function (array $dateRow) {
            return (int) $dateRow[1];
        });

        $vtViews = collect($visitorsData['rows'] ?? [])->map(function (array $dateRow) {
            return (int) $dateRow[2];
        });

        // Get google analytics most visited pages for last 10 days
        $pagesData = Analytics::fetchMostVisitedPages(Period::days(10), 10);

        // Get google analytics top referrers for last 10 days
        $referrerData = Analytics::fetchTopReferrers(Period::days(10), 10);

        // Get google analytics top browsers for last 10 days
        $browserData = Analytics::fetchTopBrowsers(Period::days(10), 10);

        // Set meta tags
        $this->seo()->setTitle('Acessos');

        // Return view
        return view('admin.analytics.index', compact('visitorsData', 'pagesData', 'referrerData', 'browserData', 'vtData', 'vtViews', 'vtDate'));
    }
}
