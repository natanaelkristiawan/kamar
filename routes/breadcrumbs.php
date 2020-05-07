<?php

// Home
Breadcrumbs::for('dashboard', function ($trail) {
  $trail->push('Dashboard', route('admin.dashboard'));
});

Breadcrumbs::for('profile', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Profile', '');
});