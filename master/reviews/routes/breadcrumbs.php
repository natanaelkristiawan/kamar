<?php 


Breadcrumbs::for('reviews', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Reviews', route('admin.reviews'));
});

Breadcrumbs::for('reviews.create', function ($trail) {
  $trail->parent('reviews');
  $trail->push('Create', route('admin.reviews.create'));
});

Breadcrumbs::for('reviews.edit', function ($trail) {
  $trail->parent('reviews');
  $trail->push('Edit', route('admin.reviews.create'));
});