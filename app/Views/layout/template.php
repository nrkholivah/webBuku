<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/index.css">
    <link rel="stylesheet" href="/css/detail.css">
    <title><?= $title ?? 'Website Buku' ?></title>
</head>

<body>
    <header>
        <h1 class="text-center mt-3">Toko Buku</h1>
        <nav class="nav justify-content-center mb-4">
            <a class="nav-link" href="/halaman/beranda">Beranda</a>
            <a class="nav-link" href="/halaman/tentang">Tentang</a>
            <a class="nav-link" href="/books">Daftar Buku</a>
            <a class="nav-link" href="/halaman/hubungi">Hubungi Kami</a>
        </nav>
    </header>

    <?= $this->renderSection('content'); ?>

</body>

</html>