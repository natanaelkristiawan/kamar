<?php

Breadcrumbs::for('ameneties', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Ameneties', route('admin.ameneties'));
});

Breadcrumbs::for('ameneties.create', function ($trail) {
  $trail->parent('ameneties');
  $trail->push('Create', route('admin.ameneties.create'));
});