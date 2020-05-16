<?php

Breadcrumbs::for('customers', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Customers', route('admin.customers'));
});

Breadcrumbs::for('customers.create', function ($trail) {
  $trail->parent('customers');
  $trail->push('Create', route('admin.customers.create'));
});

