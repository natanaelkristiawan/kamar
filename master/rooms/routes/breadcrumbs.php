<?php

Breadcrumbs::for('ameneties', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Ameneties', route('admin.ameneties'));
});

Breadcrumbs::for('ameneties.create', function ($trail) {
  $trail->parent('ameneties');
  $trail->push('Create', route('admin.ameneties.create'));
});

Breadcrumbs::for('types', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Types', route('admin.types'));
});

Breadcrumbs::for('types.create', function ($trail) {
  $trail->parent('types');
  $trail->push('Create', route('admin.types.create'));
});