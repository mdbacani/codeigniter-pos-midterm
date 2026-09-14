<?php

namespace App\Controllers;

use App\Models\ProductModel;

class Products extends BaseController
{
    protected ProductModel $productModel;

    public function __construct()
    {
        $this->productModel = new ProductModel();
    }

    public function index()
    {
        return view('products/index', [
            'products' => $this->productModel
                ->orderBy('id', 'DESC')
                ->findAll(),
        ]);
    }

    public function create()
    {
        return view('products/create');
    }

    public function store()
    {
        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'price' => 'required|decimal|greater_than_equal_to[0]',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
            'image' => [
                'label' => 'Product Image',
                'rules' => [
                    'permit_empty',
                    'is_image[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/png]',
                    'max_size[image,2048]',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $imageName = null;
        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/products', $imageName);
        }

        $this->productModel->insert([
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image' => $imageName,
            'created_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()
            ->to('/products')
            ->with('success', 'Product added successfully.');
    }

    public function edit(int $id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return view('products/edit', [
            'product' => $product,
        ]);
    }

    public function update(int $id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        $rules = [
            'name' => 'required|min_length[2]|max_length[100]',
            'price' => 'required|decimal|greater_than_equal_to[0]',
            'stock_quantity' => 'required|integer|greater_than_equal_to[0]',
            'image' => [
                'label' => 'Product Image',
                'rules' => [
                    'permit_empty',
                    'is_image[image]',
                    'mime_in[image,image/jpg,image/jpeg,image/png]',
                    'max_size[image,2048]',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $imageName = $product['image'];
        $image = $this->request->getFile('image');

        if ($image && $image->isValid() && !$image->hasMoved()) {
            $imageName = $image->getRandomName();
            $image->move(FCPATH . 'uploads/products', $imageName);

            if (!empty($product['image'])) {
                $oldImage = FCPATH . 'uploads/products/' . $product['image'];

                if (is_file($oldImage)) {
                    unlink($oldImage);
                }
            }
        }

        $this->productModel->update($id, [
            'name' => $this->request->getPost('name'),
            'price' => $this->request->getPost('price'),
            'stock_quantity' => $this->request->getPost('stock_quantity'),
            'image' => $imageName,
        ]);

        return redirect()
            ->to('/products')
            ->with('success', 'Product updated successfully.');
    }

    public function delete(int $id)
    {
        $product = $this->productModel->find($id);

        if (!$product) {
            return redirect()
                ->to('/products')
                ->with('error', 'Product not found.');
        }

        try {
            $this->productModel->delete($id);

            if (!empty($product['image'])) {
                $imagePath = FCPATH . 'uploads/products/' . $product['image'];

                if (is_file($imagePath)) {
                    unlink($imagePath);
                }
            }

            return redirect()
                ->to('/products')
                ->with('success', 'Product deleted successfully.');
        } catch (\Throwable $exception) {
            return redirect()
                ->to('/products')
                ->with('error', 'This product cannot be deleted because it has sales records.');
        }
    }
}