<?php

Breadcrumbs::for('payments', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Payments', route('admin.payments'));
});