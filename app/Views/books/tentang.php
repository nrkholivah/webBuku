<?= $this->extend('layout/template') ?>

<?= $this->section('style'); ?>
<link rel="stylesheet" href="<?= base_url('css/tentang.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<h2>Tentang Kami</h2>
<p>Toko Buku adalah platform penyedia buku dan komik dari berbagai penerbit.</p>
<?= $this->endSection() ?>