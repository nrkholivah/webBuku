<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
    <h2><?= esc($book['judul']) ?></h2>
    <img src="/img/<?= esc($book['sampul']) ?>" width="120" alt="Sampul buku <?= esc($book['judul']) ?>" class="mb-3">
    <p><strong>Penulis:</strong> <?= esc($book['penulis']) ?></p>
    <p><strong>Penerbit:</strong> <?= esc($book['penerbit']) ?></p>

    <a href="/books/edit/<?= esc($book['slug']) ?>" class="btn btn-warning">Ubah</a>

    <form action="/books/<?= esc($book['id']) ?>" method="post" class="d-inline" onsubmit="return confirm('Yakin mau hapus buku ini? 😱');">
        <?= csrf_field(); ?>
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn btn-danger">Hapus</button>
    </form>

    <p class="mt-3">
        <a href="/" class="btn btn-link">⬅ Kembali ke daftar</a>
    </p>
</div>
<?= $this->endSection(); ?>