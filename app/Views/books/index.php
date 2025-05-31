<?= $this->extend('layout/template'); ?>

<?= $this->section('style'); ?>
<link rel="stylesheet" href="<?= base_url('css/index.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container">
    <?php if (session()->getFlashdata('pesan')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
        </div>
    <?php endif ?>
    <a href="/books/tambah/" class="btn btn-primary mt-3">Tambah Data Buku</a>
    <h2 class="my-4 text-center">Daftar Buku</h2>

    <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Sampul</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Detail</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1 ?>
                <?php foreach ($books as $b) : ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><img src="<?= base_url('img/sampul/' . $b['sampul']) ?>" class="gambar-sampul" width="60">
                        </td>
                        <td><?= $b['judul']; ?></td>
                        <td><?= $b['penulis'] ?></td>
                        <td><?= $b['penerbit'] ?></td>
                        <td>
                            <a href="/books/<?= $b['slug']; ?>" class="btn btn-primary btn-sm">Lihat Detail</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?= $this->endSection(); ?>