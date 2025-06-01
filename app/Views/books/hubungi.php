<?= $this->extend('layout/template'); ?>

<?= $this->section('style'); ?>
<link rel="stylesheet" href="<?= base_url('css/hubungi.css') ?>">
<?= $this->endSection(); ?>

<?= $this->section('content'); ?>

<div class="contact text-center my-5">
    <h2>Hubungi Kami</h2>
    <p class="mt-3">Punya pertanyaan atau saran? Kami siap mendengarkan!</p>
    <ul class="list-unstyled mt-4">
        <li>Email: <a href="mailto:tokooliv@gmail.com">tokooliv@gmail.com</a></li>
        <li>Instagram: <a href="https://instagram.com/tokooliv" target="_blank">@tokooliv</a></li>
    </ul>
</div>

<?= $this->endSection(); ?>