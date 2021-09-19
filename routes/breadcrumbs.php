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

// Edit Permissions
Breadcrumbs::for('admin.permissions.edit', function ($trail, $id) {
    $trail->parent('admin.permissions.index');
    $trail->push('Editar Permissão', route('admin.permissions.edit', ['id' => $id]));
});

// Roles
Breadcrumbs::for('admin.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.dashboard.index');
    $trail->push('Grupos', route('admin.roles.index'));
});

// Create Role
Breadcrumbs::for('admin.roles.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.roles.index');
    $trail->push('Novo Grupo', route('admin.roles.create'));
});

// Edit Roles
Breadcrumbs::for('admin.roles.edit', function ($trail, $id) {
    $trail->parent('admin.roles.index');
    $trail->push('Editar Grupo', route('admin.roles.edit', ['id' => $id]));
});
