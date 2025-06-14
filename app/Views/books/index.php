<?= $this->extend('layout/template'); ?>

<?= $this->section('style'); ?>
<link rel="stylesheet" href="<?= base_url('css/index') ?>">

<?= $this->endSection(); ?>

<?= $this->section('content'); ?>
<div class="container">

    <a href="/books/tambah" class="btn btn-primary mt-3">Tambah Data Buku</a>
    <?php if (session()->getFlashdata('pesan')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= session()->getFlashdata('pesan'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>
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
                        <td><img src="<?= base_url('img/sampul/' . $b['sampul']); ?>" alt="Sampul Buku" class="gambar-sampul" width="60"></td>
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