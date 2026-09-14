<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h1>Edit Product</h1>

<form
    method="post"
    action="<?= site_url('products/update/' . $product['id']) ?>"
    enctype="multipart/form-data"
>
    <?= csrf_field() ?>

    <?= $this->include('products/_form') ?>

    <button type="submit">Update Product</button>

    <a class="button secondary" href="<?= site_url('products') ?>">
        Cancel
    </a>
</form>

<?= $this->endSection() ?>