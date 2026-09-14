<label for="name">Product Name</label>
<input
    type="text"
    id="name"
    name="name"
    value="<?= old('name', $product['name'] ?? '') ?>"
    required
>

<label for="price">Price</label>
<input
    type="number"
    id="price"
    name="price"
    step="0.01"
    min="0"
    value="<?= old('price', $product['price'] ?? '') ?>"
    required
>

<label for="stock_quantity">Stock Quantity</label>
<input
    type="number"
    id="stock_quantity"
    name="stock_quantity"
    min="0"
    value="<?= old('stock_quantity', $product['stock_quantity'] ?? 0) ?>"
    required
>

<label for="image">Product Image</label>
<input
    type="file"
    id="image"
    name="image"
    accept=".jpg,.jpeg,.png"
>

<?php if (!empty($product['image'])): ?>
    <p>Current image:</p>

    <img
        class="product-image"
        src="<?= base_url('uploads/products/' . $product['image']) ?>"
        alt="<?= esc($product['name']) ?>"
    >
<?php endif; ?>