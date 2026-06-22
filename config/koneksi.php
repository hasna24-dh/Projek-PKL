<?php
// ========================================================
// KONEKSI KE DATABASE PERTAMA (Misal: Database Utama/Surat)
// ========================================================
$host_1 = "localhost";
$user_1 = "root";
$pass_1 = "";
$db_1   = "db_dinas_utama";

$koneksi_utama = mysqli_connect($host_1, $user_1, $pass_1, $db_1);

if (!$koneksi_utama) {
    die("Koneksi Database Utama Gagal: " . mysqli_connect_error());
}

// ========================================================
// KONEKSI KE DATABASE KEDUA (Misal: Database IKM / Eksternal)
// ========================================================
$host_2 = "localhost"; // Bisa diganti IP Server lain jika terpisah
$user_2 = "root";
$pass_2 = "";
$db_2   = "db_dinas_ikm";

$koneksi_ikm = mysqli_connect($host_2, $user_2, $pass_2, $db_2);

if (!$koneksi_ikm) {
    die("Koneksi Database IKM Gagal: " . mysqli_connect_error());
}
?>
