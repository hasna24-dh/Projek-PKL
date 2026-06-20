<main class="app-main">
    <!-- Header Hero: Identitas Portal Kantor -->
    

    <!-- Konten Header Bawaan AdminLTE -->
<div class="app-content-header py-4 mb-3 border-bottom bg-white">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-8">
                <h3 class="fw-bold text-dark mb-1">
                    <i class="bi bi-shield-shaded text-primary me-2"></i> PORTAL MONITORING SISTEM TERPADU
                </h3>
                <p class="mb-0 text-muted small">Pusat integrasi, pemantauan data, dan akses cepat seluruh aplikasi operasional kantor.</p>
            </div>
            <div class="col-sm-4 text-sm-end mt-2 mt-sm-0">
                <span class="badge text-bg-dark p-2">
                    <i class="bi bi-calendar3 me-2"></i><?= date('d M Y') ?>
                </span>
            </div>
        </div>
    </div>
</div>

<!-- Konten Utama Bawaan AdminLTE -->
<div class="app-content">
    <div class="container-fluid">
        
        <!-- Baris 1: Rangkuman Statistik Cepat -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box text-bg-primary mb-3 shadow-sm border-0">
                    <span class="info-box-icon"><i class="bi bi-people-fill"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Data SESUK</span>
                        <span class="info-box-number">1,250</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box text-bg-success mb-3 shadow-sm border-0">
                    <span class="info-box-icon"><i class="bi bi-graph-up-arrow"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total Data CADIL</span>
                        <span class="info-box-number">840</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box text-bg-warning text-white mb-3 shadow-sm border-0">
                    <span class="info-box-icon"><i class="bi bi-file-earmark-text"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Data ELENOPEDA</span>
                        <span class="info-box-number">420</span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box text-bg-danger mb-3 shadow-sm border-0">
                    <span class="info-box-icon"><i class="bi bi-building-fill"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Laporan Industri</span>
                        <span class="info-box-number">150</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Baris 2: Jalur Pintas & Live Status -->
        <div class="row mt-3">
            <!-- Sisi Kiri: Jalur Pintas -->
            <div class="col-lg-8">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-transparent border-bottom py-3">
                        <h5 class="card-title fw-bold mb-0 text-dark">
                            <i class="bi bi-box-arrow-up-right text-primary me-2"></i> Jalur Pintas Aplikasi Luar
                        </h5>
                    </div>
                    <div class="card-body bg-light-50">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="card h-100 border shadow-sm">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h6 class="fw-bold text-primary"><i class="bi bi-cpu-fill me-2"></i> Sistem SATUKAN JIWA</h6>
                                            <p class="small text-muted mb-0">Akses ke sistem manajemen data sosial internal untuk pengisian database SESUK, CADIL, dan ELENOPEDA.</p>
                                        </div>
                                        <!-- <a href="http://192.168.34.169/satukan.jiwa/ " class="btn btn-outline-primary btn-sm w-100 mt-3">
                                            Hubungkan ke Aplikasi <i class="bi bi-arrow-right-short"></i>
                                        </a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card h-100 border shadow-sm">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h6 class="fw-bold text-success"><i class="bi bi-diagram-3-fill me-2"></i> Sistem DBES-IKM</h6>
                                            <p class="small text-muted mb-0">Buka aplikasi pelaporan berkala industri mikro untuk monitoring IKM wilayah secara berkala.</p>
                                        </div>
                                        <!-- <a href="http://192.168.34.169/dbes-ikm/" class="btn btn-outline-success btn-sm w-100 mt-3">
                                            Hubungkan ke Aplikasi <i class="bi bi-arrow-right-short"></i>
                                        </a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sisi Rangan: Live Status -->
            <div class="col-lg-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-transparent border-bottom py-3">
                        <h5 class="card-title fw-bold mb-0 text-dark">
                            <i class="bi bi-activity text-danger me-2"></i> Live Status Aplikasi
                        </h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush small">
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <div>
                                    <span class="fw-bold d-block">Server SATUKAN JIWA</span>
                                    <small class="text-muted">Koneksi Database Utama</small>
                                </div>
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Aktif</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-3">
                                <div>
                                    <span class="fw-bold d-block">Server DBES-IKM</span>
                                    <small class="text-muted">Penyimpanan Laporan Industri</small>
                                </div>
                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-3">Aktif</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
</main>