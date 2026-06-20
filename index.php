<?php
// Uncomment jika database dibutuhkan dari awal di setiap halaman
// require_once 'config/koneksi.php'; 

// Cek parameter page, defaultnya 'dashboard'
$page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

// Daftar Title halaman otomatis
$titles = [
    'dashboard' => 'Beranda',
    'sesuk' => 'SESUK',
    'cadil' => 'CADIL',
    'elenopeda' => 'ELENOPEDA',
    'laporan_industri' => 'Laporan Industri'
];
$title = $titles[$page] ?? 'Halaman Tidak Ditemukan';

// Memanggil Layouts Atas
include 'layouts/header.php';
include 'layouts/navbar.php';
include 'layouts/sidebar.php';

// Memanggil Konten
$file = 'pages/' . $page . '.php';
if (file_exists($file)) {
    include $file;
} else {
    // 404 Fallback
    echo "
    <main class='app-main'>
        <div class='app-content-header'>
            <div class='container-fluid text-center mt-5'>
                <h1>404 - Halaman Tidak Ditemukan</h1>
                <p>Halaman '{$page}' tidak tersedia.</p>
            </div>
        </div>
    </main>";
}

// Memanggil Layouts Bawah
include 'layouts/footer.php';
?>
