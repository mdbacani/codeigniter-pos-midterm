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
public function store() {
    $rules = [
        'name'           => 'required|min_length[2]|max_length[100]',
        'price'          => 'required|decimal',
        'stock_quantity' => 'required|integer',
        'image'          => 'uploaded[image]|max_size[image,2048]|is_image[image]|mime_in[image,image/png,image/jpg,image/jpeg]'
    ];

    if (!$this->validate($rules)) {
        return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
    }

    // Handle safe file upload storage and display preparation
    $file = $this->request->getFile('image');
    $imageName = $file->getRandomName();
    $file->move(FCPATH . 'uploads/products', $imageName);

    // Save data to database...
}
