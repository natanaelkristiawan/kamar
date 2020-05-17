<?php

Breadcrumbs::for('site', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Site', route('admin.site'));
});