<?php

Breadcrumbs::for('bookPending', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Book Pending', route('admin.bookPending'));
});

Breadcrumbs::for('bookSuccess', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Book Success', route('admin.bookSuccess'));
});

