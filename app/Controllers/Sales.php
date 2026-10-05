<?php namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CustomerModel;
use App\Models\SaleModel;

class Sales extends BaseController {

    public function create() {
        $productModel = new ProductModel();
        $customerModel = new CustomerModel();

        $data['products'] = $productModel->findAll();
        $data['customers'] = $customerModel->findAll();

        return view('sales/create', $data);
    }

    public function store() {
        $productModel = new ProductModel();
        $saleModel = new SaleModel();

        $productId  = $this->request->getPost('product_id');
        $customerId = $this->request->getPost('customer_id'); // Optional
        $quantity   = (int) $this->request->getPost('quantity');

        $product = $productModel->find($productId);

        // Validate that requested quantity does not exceed available stock
        if ($quantity > $product['stock_quantity']) {
            return redirect()->back()->withInput()->with('error', 'Sale rejected: Requested quantity exceeds available stock.');
        }

        $totalPrice = $product['price'] * $quantity;

        // Record the transaction
        $saleModel->save([
            'product_id'  => $productId,
            'customer_id' => !empty($customerId) ? $customerId : null,
            'sold_by'     => session()->get('user_id'), // Logged-in staff member ID
            'quantity'    => $quantity,
            'total_price' => $totalPrice,
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        // Decrease the product's stock quantity
        $newStock = $product['stock_quantity'] - $quantity;
        $productModel->update($productId, ['stock_quantity' => $newStock]);

        return redirect()->to('/sales/history')->with('success', 'Transaction recorded successfully.');
    }

    public function history() {
        $saleModel = new SaleModel();
        
        // Fetch past transactions with related product, customer, and staff details
        $data['sales'] = $saleModel->select('sales.*, products.name as product_name, customers.full_name as customer_name, users.full_name as staff_name')
                                   ->join('products', 'products.id = sales.product_id')
                                   ->join('customers', 'customers.id = sales.customer_id', 'left')
                                   ->join('users', 'users.id = sales.sold_by')
                                   ->findAll();

        return view('sales/history', $data);
    }
}
