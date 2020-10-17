<?php

Breadcrumbs::for('packages', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Packages', route('admin.packages'));
});

Breadcrumbs::for('packages.create', function ($trail) {
  $trail->parent('packages');
  $trail->push('Create', route('admin.packages.create'));
});