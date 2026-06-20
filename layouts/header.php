<!doctype html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE 4 | Dashboard - <?= htmlspecialchars($title ?? 'Beranda') ?></title>

    <!--begin::Theme Init-->
    <script>
      (() => {
        'use strict';
        const STORAGE_KEY = 'lte-theme';
        let stored = null;
        try { stored = localStorage.getItem(STORAGE_KEY); } catch {}
        const prefersDark = globalThis.matchMedia('(prefers-color-scheme: dark)').matches;
        let resolved = 'light';
        if (stored === 'dark' || stored === 'light') {
          resolved = stored;
        } else if (prefersDark) {
          resolved = 'dark';
        }
        document.documentElement.setAttribute('data-bs-theme', resolved);
        document.documentElement.style.colorScheme = resolved;
      })();
    </script>
    <!--end::Theme Init-->

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css" crossorigin="anonymous" />
    <!-- Pastikan path aset CSS ini mengarah ke folder assets/css/ Anda -->
    <link rel="stylesheet" href="assets/css/adminlte.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css" crossorigin="anonymous" />

    <style>
    /* Mengunci posisi pembungkus sidebar */
    .sidebar-wrapper {
        position: relative !important;
        height: calc(100vh - 60px) !important;
        padding-bottom: 70px !important;
        overflow-y: auto !important;
    }

    /* Memaksa kotak tombol dokumentasi menempel pas di pojok bawah */
    .sidebar-wrapper div.p-3.border-top {
        position: absolute !important;
        bottom: 0 !important;
        left: 0 !important;
        width: 100% !important;
        margin-top: 0 !important;
        background-color: var(--bs-secondary-bg) !important;
        z-index: 10;
    }
    /* 1. Menghilangkan background abu-abu saat halaman aktif / setelah diklik (tanpa kursor) */
    .sidebar-wrapper .nav-treeview .nav-item .nav-link.active,
    .sidebar-wrapper .nav-treeview .nav-item .nav-link:focus,
    .sidebar-wrapper .nav-treeview .nav-item .nav-link:active {
        background-color: transparent !important;
        box-shadow: none !important;
        outline: none !important;
        color: #ffffff !important;
    }

    /* 2. TETAP MEMUNCULKAN bayangan abu-abu HANYA saat kursor mouse menempel (HOVER) */
    .sidebar-wrapper .nav-treeview .nav-item .nav-link:hover,
    .sidebar-wrapper .nav-treeview .nav-item .nav-link.active:hover {
        background-color: rgba(255, 255, 255, 0.1) !important; /* Warna abu-abu transparan hover bawaan */
        color: #ffffff !important;
    }

   /* 3. Memastikan teks & ikon submenu selalu putih terang */
    .sidebar-wrapper .nav-treeview .nav-item .nav-link i,
    .sidebar-wrapper .nav-treeview .nav-item .nav-link p {
        color: #ffffff !important;
    }

    /* === TAMBAHKAN KODE BARU INI DI BAWAH SINI === */
   /* Menghapus background abu-abu aktif secara paksa pada menu utama tingkat teratas (Beranda) */
    .sidebar-wrapper .nav-sidebar > .nav-item > .nav-link.active,
    .sidebar-wrapper .nav-sidebar > .nav-item > .nav-link[class*="active"],
    .sidebar-wrapper .nav-sidebar > .nav-item > .nav-link:focus,
    .sidebar-wrapper .nav-sidebar > .nav-item > .nav-link:active {
        background-color: transparent !important;
        box-shadow: none !important;
        outline: none !important;
        color: #ffffff !important;
    }

    /* Efek hover abu-abu hanya boleh muncul saat kursor mouse benar-benar menempel di atas menu */
    .sidebar-wrapper .nav-sidebar > .nav-item > .nav-link:hover,
    .sidebar-wrapper .nav-sidebar > .nav-item > .nav-link.active:hover {
        background-color: rgba(255, 255, 255, 0.1) !important;
        color: #ffffff !important;
    }

 /* ==================== KUSTOMISASI MINIMALIS GLOBAL MODERN ==================== */

/* 1. Mengubah Info Box & Small Box menjadi putih bersih dengan sudut melengkung modern */
.info-box, .small-box {
    background-color: #ffffff !important;
    color: #2d3748 !important; /* Warna teks abu-abu gelap profesional */
    border: 1px solid #e2e8f0 !important; /* Batas border tipis */
    border-radius: 12px !important; /* Sudut kotak membulat modern */
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03) !important;
    padding: 20px !important;
    overflow: hidden;
    position: relative;
    display: flex;
    align-items: center;
    min-height: 100px;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

/* Efek interaktif saat kursor mendekat (hover) */
.info-box:hover, .small-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05) !important;
}

/* 2. Merapikan struktur teks di dalam kotak (Membalik posisi Judul ke atas Angka) */
.info-box-content, .small-box .inner {
    display: flex;
    flex-direction: column;
    padding: 0 !important;
    margin: 0 !important;
    flex-grow: 1;
}

/* Judul kecil (misal: 'Total Data SESUK') */
.info-box-text, .small-box .inner p {
    font-size: 0.85rem !important;
    color: #718096 !important; /* Abu-abu redup minimalis */
    font-weight: 500 !important;
    margin-bottom: 4px !important;
    order: -1; /* Memaksa teks judul naik ke atas angka */
    text-transform: none !important;
}

/* Angka besar (misal: '1,250') */
.info-box-number, .small-box .inner h3 {
    font-size: 1.75rem !important;
    font-weight: 700 !important;
    color: #1a202c !important;
    margin: 0 !important;
}

/* 3. Mengubah ikon besar di kanan menjadi ikon lingkaran kecil berlatar pastel */
.info-box-icon, .small-box .small-box-icon, .small-box-icon i {
    font-size: 1.25rem !important;
    opacity: 1 !important;
    position: absolute !important;
    top: 20px !important;
    right: 20px !important;
    transform: none !important;
    width: 42px !important;
    height: 42px !important;
    display: flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 50% !important;
}

/* 4. Sentuhan aksen warna minimalis pada ikon lingkaran di pojok kanan */
.info-box.text-bg-primary, .small-box.text-bg-primary { border-left: 4px solid #3182ce !important; }
.info-box.text-bg-primary .info-box-icon, .small-box.text-bg-primary .small-box-icon { background-color: #ebf8ff !important; color: #3182ce !important; }

.info-box.text-bg-success, .small-box.text-bg-success { border-left: 4px solid #38a169 !important; }
.info-box.text-bg-success .info-box-icon, .small-box.text-bg-success .small-box-icon { background-color: #f0fff4 !important; color: #38a169 !important; }

.info-box.text-bg-warning, .small-box.text-bg-warning { border-left: 4px solid #dd6b20 !important; }
.info-box.text-bg-warning .info-box-icon, .small-box.text-bg-warning .small-box-icon { background-color: #fffaf0 !important; color: #dd6b20 !important; }

.info-box.text-bg-danger, .small-box.text-bg-danger { border-left: 4px solid #e53e3e !important; }
.info-box.text-bg-danger .info-box-icon, .small-box.text-bg-danger .small-box-icon { background-color: #fff5f5 !important; color: #e53e3e !important; }

/* Menghapus link bawaan di bagian bawah agar tetap bersih */
.small-box .small-box-footer { display: none !important; }
 
</style>

</head>
<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <div class="app-wrapper">
