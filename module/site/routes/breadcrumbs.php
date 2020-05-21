<?php

Breadcrumbs::for('site', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Site', route('admin.site'));
});


Breadcrumbs::for('faqcategories', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Faq Categories', route('admin.faqcategories'));
});

Breadcrumbs::for('faqcategories.create', function ($trail) {
  $trail->parent('faqcategories');
  $trail->push('Create', route('admin.faqcategories.create'));
});

Breadcrumbs::for('faq', function ($trail) {
  $trail->parent('dashboard');
  $trail->push('Faq', route('admin.faq'));
});

Breadcrumbs::for('faq.create', function ($trail) {
  $trail->parent('faq');
  $trail->push('Create', route('admin.faq.create'));
});