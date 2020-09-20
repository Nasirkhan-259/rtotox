<?php
Breadcrumbs::for('home', function ($trail) {
    $trail->push('Home', url('/'));
});
Breadcrumbs::for('agent', function ($trail) {
    $trail->parent('home');
    $trail->push('Agent', url('agent'));
});
