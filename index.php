<?php
require_once 'config/koneksi.php';

$page = (isset($_GET['page']) && trim($_GET['page']) !== '') ? $_GET['page'] : 'dashboard';

$titles = [
    'dashboard' => 'Beranda',
    'sesuk'     => 'SESUK',
    'cadil'     => 'CADIL',
    'elenopeda' => 'ELENOPEDA',
    'laporan_industri' => 'Laporan Industri'
];

$title = $titles[$page] ?? 'Halaman Tidak Ditemukan';

// Include struktur template atas
include 'layouts/header.php';
include 'layouts/navbar.php';
include 'layouts/sidebar.php';

// 2. Tentukan jalur file konten di dalam folder pages/
$file = 'pages/' . $page . '.php';
if (file_exists($file) && $page !== '') {
    include $file;
} else {
    include 'pages/dashboard.php';
}

include 'layouts/footer.php';
?>