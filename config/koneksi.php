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

// // ========================================================
// // KONEKSI KE DATABASE KEDUA (Misal: Database IKM / Eksternal)
// // ========================================================
// $host_2 = "localhost"; // Bisa diganti IP Server lain jika terpisah
// $user_2 = "root";
// $pass_2 = "";
// $db_2   = "db_dinas_ikm";

// $koneksi_ikm = mysqli_connect($host_2, $user_2, $pass_2, $db_2);

// if (!$koneksi_ikm) {
//     die("Koneksi Database IKM Gagal: " . mysqli_connect_error());
// }

// ========================================================
// FUNGSI HELPER UNTUK PENGAMBILAN DATA API DENGAN CACHING
// ========================================================

/**
 * Fungsi utama untuk mendapatkan data.
 * Mencoba mengambil dari API, jika gagal, mengambil dari cache database lokal.
 *
 * @param mysqli $koneksi Koneksi database.
 * @param string $api_url URL API.
 * @param string $cache_key Kunci unik untuk data ini di cache.
 * @return array ['data' => ..., 'source' => 'api'|'cache', 'last_updated' => ...].
 */
function get_data_with_cache($koneksi, $api_url, $cache_key) {
    // Konfigurasi stream context untuk timeout
    $options = ['http' => ['timeout' => 5]]; // Timeout dalam 5 detik
    $context = stream_context_create($options);

    // Coba ambil data dari API, @ menekan warning jika URL tidak valid/timeout
    $response = @file_get_contents($api_url, false, $context);

    // Jika berhasil mengambil data dari API
    if ($response !== false && !empty($response)) {
        $data = json_decode($response, true);
        
        // Jika JSON valid, update cache di database dan kembalikan data dari API
        if (json_last_error() === JSON_ERROR_NONE) {
            update_cache($koneksi, $cache_key, $data);
            return [
                'data' => $data,
                'source' => 'api',
                'last_updated' => date('Y-m-d H:i:s') // Waktu saat ini
            ];
        }
    }

    // Jika gagal mengambil dari API, ambil dari cache database lokal
    return get_from_cache($koneksi, $cache_key);
}

/**
 * Memperbarui data cache di database.
 *
 * @param mysqli $koneksi Koneksi database.
 * @param string $cache_key Kunci cache.
 * @param array $data Data yang akan disimpan.
 */
function update_cache($koneksi, $cache_key, $data) {
    // Khusus untuk 'cadil', simpan data tabel ke tabel terpisah
    if ($cache_key === 'cadil_data' && isset($data['tabel_sppd'])) {
        // Gunakan transaksi untuk memastikan integritas data
        mysqli_begin_transaction($koneksi);
        try {
            mysqli_query($koneksi, "TRUNCATE TABLE cache_cadil_sppd"); // Kosongkan tabel lama
            $stmt = mysqli_prepare($koneksi, "INSERT INTO cache_cadil_sppd (nama, jabatan, tempat_tujuan, tgl_brkt) VALUES (?, ?, ?, ?)");
            foreach ($data['tabel_sppd'] as $row) {
                mysqli_stmt_bind_param($stmt, "ssss", $row['nama'], $row['jabatan'], $row['tempat_tujuan'], $row['tgl_brkt']);
                mysqli_stmt_execute($stmt);
            }
            mysqli_commit($koneksi);
        } catch (Exception $e) {
            mysqli_rollback($koneksi);
            // Bisa ditambahkan log error di sini
        }
        unset($data['tabel_sppd']); // Hapus dari data utama agar tidak duplikat
    }

    // Khusus untuk 'laporan_industri', simpan data tabel ke tabel terpisah
    if ($cache_key === 'laporan_industri_data' && isset($data['tabel_laporan'])) {
        // Gunakan transaksi untuk memastikan integritas data
        mysqli_begin_transaction($koneksi);
        try {
            mysqli_query($koneksi, "TRUNCATE TABLE cache_laporan_industri"); // Kosongkan tabel lama
            $stmt = mysqli_prepare($koneksi, "INSERT INTO cache_laporan_industri (nama_industri, jenis_usaha, alamat, status) VALUES (?, ?, ?, ?)");
            foreach ($data['tabel_laporan'] as $row) {
                mysqli_stmt_bind_param($stmt, "ssss", $row['nama_industri'], $row['jenis_usaha'], $row['alamat'], $row['status']);
                mysqli_stmt_execute($stmt);
            }
            mysqli_commit($koneksi);
        } catch (Exception $e) {
            mysqli_rollback($koneksi);
            // Bisa ditambahkan log error di sini
        }
        unset($data['tabel_laporan']); // Hapus dari data utama agar tidak duplikat
    }

    $json_value = json_encode($data);
    $stmt = mysqli_prepare($koneksi, "INSERT INTO dashboard_cache (cache_key, cache_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE cache_value = ?");
    mysqli_stmt_bind_param($stmt, "sss", $cache_key, $json_value, $json_value);
    mysqli_stmt_execute($stmt);
}

/**
 * Mengambil data dari cache database.
 *
 * @param mysqli $koneksi Koneksi database.
 * @param string $cache_key Kunci cache.
 * @return array Data dari cache beserta statusnya.
 */
function get_from_cache($koneksi, $cache_key) {
    $stmt = mysqli_prepare($koneksi, "SELECT cache_value, last_updated FROM dashboard_cache WHERE cache_key = ?");
    mysqli_stmt_bind_param($stmt, "s", $cache_key);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);

    $data = $row ? json_decode($row['cache_value'], true) : [];
    $last_updated = $row ? $row['last_updated'] : null;

    // Khusus untuk 'cadil', ambil juga data tabel dari tabel terpisah
    if ($cache_key === 'cadil_data') {
        $result_sppd = mysqli_query($koneksi, "SELECT * FROM cache_cadil_sppd ORDER BY id DESC");
        $data['tabel_sppd'] = $result_sppd ? mysqli_fetch_all($result_sppd, MYSQLI_ASSOC) : [];
    }

    // Khusus untuk 'laporan_industri', ambil juga data tabel dari tabel terpisah
    if ($cache_key === 'laporan_industri_data') {
        $result_laporan = mysqli_query($koneksi, "SELECT * FROM cache_laporan_industri ORDER BY id DESC");
        $data['tabel_laporan'] = $result_laporan ? mysqli_fetch_all($result_laporan, MYSQLI_ASSOC) : [];
    }

    // Jika tidak ada data sama sekali, kembalikan struktur kosong
    return [
        'data' => $data,
        'source' => 'cache',
        'last_updated' => $last_updated
    ];
}

?>
