<?= $this->extend('layout') ?>

<?= $this->section('content') ?>

<h1>Add Product</h1>

<form
    method="post"
    action="<?= site_url('products/store') ?>"
    enctype="multipart/form-data"
>
    <?= csrf_field() ?>

    <?= $this->include('products/_form') ?>

    <button type="submit">Save Product</button>

    <a class="button secondary" href="<?= site_url('products') ?>">
        Cancel
    </a>
</form>

<?= $this->endSection() ?>