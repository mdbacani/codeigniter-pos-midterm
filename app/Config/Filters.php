<?php 
public $aliases = [
    'auth' => \App\Filters\AuthFilter::class,
];

public $filters = [
    'auth' => ['before' => ['products*', 'customers*', 'users*', 'sales*']]
];
