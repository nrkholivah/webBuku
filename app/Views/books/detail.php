<?= $this->extend('layout/template'); ?>

<?= $this->section('style'); ?>
<link rel="stylesheet" href="<?= base_url('css/detail') ?>">
<?= $this->endSection(); ?>
<?= $this->section('content'); ?>
<div class="container">
    <h2 class="mt-2">Detail Buku</h2>
    <div class="card mb-3" style="max-width: 540px;">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="/img/sampul/<?= $book['sampul']; ?>" class="img-fluid rounded-start" alt="...">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title"><?= $book['judul']; ?></h5>
                    <p class="card-text"><b>Penulis :</b> <?= $book['penulis']; ?></p>
                    <p class="card-text"><small class="text-body-secondary"><b>Penerbit :</b> <?= $book['penerbit']; ?></small></p>
                    <a href="/books/edit/<?= $book['slug']; ?>" class="btn btn-warning">Edit</a>
                    <form action="/books/<?= $book['slug']; ?>" method="post" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus buku ini?');">
                        <?= csrf_field(); ?>
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>

                    <br><br>
                    <a href="/books" class="btn btn-secondary">Kembali ke Daftar Buku</a>

                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>