<?= $this->extend('layout/template'); ?>

<?= $this->section('style'); ?>
<link rel="stylesheet" href="<?= base_url('css/index') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2 class="my-3">Form Edit Data Buku</h2>
    <form action="/books/update/<?= $book['id']; ?>" method="post">
        <?= csrf_field(); ?>
        <div class="row mb-3">
            <label for="judul" class="col-sm-2 col-form-label">Judul</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="judul" name="judul" value="<?= $book['judul']; ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="penulis" name="penulis" value="<?= $book['penulis']; ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="penerbit" name="penerbit" value="<?= $book['penerbit']; ?>" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="sampul" name="sampul" value="<?= $book['sampul']; ?>" required>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Update Data</button>
    </form>
</div>
<?= $this->endSection(); ?>