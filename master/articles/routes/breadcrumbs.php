<?php

Breadcrumbs::for('articles', function ($trail) {
  $trail->push('Articles', route('admin.articles'));
});

Breadcrumbs::for('articles.create', function ($trail) {
  $trail->parent('articles');
  $trail->push('Create', route('admin.articles.create'));
});

Breadcrumbs::for('articles.edit', function ($trail) {
  $trail->parent('articles');
  $trail->push('Edit', route('admin.articles.create'));
});

Breadcrumbs::for('categories', function ($trail) {
  $trail->push('Categories', route('admin.categories'));
});

Breadcrumbs::for('categories.create', function ($trail) {
  $trail->parent('categories');
  $trail->push('Edit', route('admin.categories.create'));
});

Breadcrumbs::for('categories.edit', function ($trail) {
  $trail->parent('categories');
  $trail->push('Create', route('admin.categories.create'));
});