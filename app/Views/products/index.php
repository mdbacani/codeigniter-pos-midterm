<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h1>Product Management</h1>

<a class="button" href="<?= site_url('products/create') ?>">
    Add Product
</a>

<table>
    <thead>
        <tr>
            <th>Image</th>
            <th>Name</th>
            <th>Price</th>
            <th>Stock</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php if (!empty($products)): ?>
            <?php foreach ($products as $product): ?>
                <tr>
                    <td>
                        <?php if (!empty($product['image'])): ?>
                            <img
                                class="product-image"
                                src="<?= base_url('uploads/products/' . $product['image']) ?>"
                                alt="<?= esc($product['name']) ?>"
                            >
                        <?php else: ?>
                            No image
                        <?php endif; ?>
                    </td>

                    <td><?= esc($product['name']) ?></td>
                    <td>₱<?= number_format((float) $product['price'], 2) ?></td>
                    <td><?= esc($product['stock_quantity']) ?></td>
                    <td><?= esc($product['created_at']) ?></td>

                    <td>
                        <div class="actions">
                            <a
                                class="button secondary"
                                href="<?= site_url('products/edit/' . $product['id']) ?>"
                            >
                                Edit
                            </a>

                            <form
                                method="post"
                                action="<?= site_url('products/delete/' . $product['id']) ?>"
                                onsubmit="return confirm('Delete this product?')"
                            >
                                <?= csrf_field() ?>
                                <button class="danger" type="submit">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6">No products found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

<?= $this->endSection() ?>