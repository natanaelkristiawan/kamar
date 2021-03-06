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


Breadcrumbs::for('locations', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Locations', route('admin.locations'));
});

Breadcrumbs::for('locations.create', function ($trail) {
  $trail->parent('locations');
  $trail->push('Create', route('admin.locations.create'));
});


Breadcrumbs::for('owners', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Owners', route('admin.owners'));
});

Breadcrumbs::for('owners.create', function ($trail) {
  $trail->parent('owners');
  $trail->push('Create', route('admin.owners.create'));
});

Breadcrumbs::for('rooms', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Rooms', route('admin.rooms'));
});

Breadcrumbs::for('rooms.create', function ($trail) {
  $trail->parent('rooms');
  $trail->push('Create', route('admin.rooms.create'));
});