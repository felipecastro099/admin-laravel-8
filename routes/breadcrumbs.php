<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;


// Home
Breadcrumbs::for('admin.dashboard.index', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('admin.dashboard.index'));
});

// Permissions
Breadcrumbs::for('admin.permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.index');
    $trail->push('Permissões', route('admin.permissions.index'));
});

// Create Permission
Breadcrumbs::for('admin.permissions.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.permissions.index');
    $trail->push('Nova Permissão', route('admin.permissions.create'));
});
