<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');
$routes->get('customer-accounts', 'CustomerAccounts::index');
$routes->get('user-accounts', 'UserAccounts::index');
public $aliases = [
    'auth' => \App\Filters\AuthFilter::class,
];

public $filters = [
    'auth' => ['before' => ['products*', 'customers*', 'users*', 'sales*']]
];
