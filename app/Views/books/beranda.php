<?= $this->extend('layout/template') ?>

<?= $this->section('style'); ?>
<link rel="stylesheet" href="<?= base_url('css/beranda.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content') ?>
<h2>Selamat datang di Toko Buku</h2>
<p>Temukan komik dan buku favoritmu dengan mudah dan cepat!</p>
<?= $this->endSection() ?>