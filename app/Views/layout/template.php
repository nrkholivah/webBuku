<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('/css/style.css') ?>">
    <?= $this->renderSection('style'); ?>
    <title><?= $title ?? 'Website Buku' ?></title>
</head>


<body>
    <header>
        <h1 class="text-center mt-3">Toko Buku</h1>
        <nav class="nav justify-content-center mb-4">
            <a class="nav-link" href="/beranda">Beranda</a>
            <a class="nav-link" href="/tentang">Tentang</a>
            <a class="nav-link" href="/books">Daftar Buku</a>
            <a class="nav-link" href="/hubungi">Hubungi Kami</a>
        </nav>
    </header>

    <?= $this->renderSection('content'); ?>
    <script>
        function previewImage() {
            const sampul = document.querySelector('#sampul');
            const sampulLabel = document.querySelector('.input-group-text');
            const imgPreview = document.querySelector('.img-preview');

            sampulLabel.textContent = sampul.files[0].name;

            const fileSampul = new FileReader();
            fileSampul.readAsDataURL(sampul.files[0]);

            fileSampul.onload = function(e) {
                imgPreview.src = e.target.result;
            }
        }
    </script>
</body>

</html>