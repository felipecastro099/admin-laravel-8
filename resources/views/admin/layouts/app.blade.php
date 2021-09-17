<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! SeoTools::generate() !!}
    <link rel="shortcut icon" href="{{ URL::asset('/admin/images/favicon.ico') }}">
    @include('admin.partials._styles')
</head>

@section('body')
    <body data-sidebar="colored">
    @show
    <div id="layout-wrapper">
        @include('admin.partials._topbar')
        @include('admin.partials._sidebar')
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    {{ \Diglactic\Breadcrumbs\Breadcrumbs::view('admin.partials._breadcrumbs') }}
                    @yield('content')
                </div>
            </div>
            @include('admin.partials._footer')
        </div>
    </div>
    @include('admin.partials._scripts')
    </body>
</html>
