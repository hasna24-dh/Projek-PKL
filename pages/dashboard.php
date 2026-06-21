<main class="app-main">
<div class="app-content-header py-4 mb-3 border-bottom bg-white">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-sm-8">
                <h2 class="fw-bold text-dark mb-1">
                    PORTAL MONITORING SATUPINTU
                </h2>
                <p class="mb-0 text-muted small">Silakan pilih menu pada panel sebelah kiri untuk mengatur konten, memantau sinkronisasi data, atau mengakses sub-aplikasi operasional: SESUK, CADIL, ELENOPEDA, dan Laporan Industri.</p>
            </div>
            <div class="col-sm-4 text-sm-end mt-2 mt-sm-0">
                <div class="bg-white px-3 py-2 shadow-sm rounded-pill d-flex align-items-center border">
                 <i class="bi bi-clock-fill text-primary me-2"></i>
                    <span id="live-clock" class="fw-bold text-dark font-monospace me-2" style="font-size: 14px;">00:00:00</span>
                    <span class="text-muted me-2">|</span>
                    <span id="live-date-sub" class="text-muted small fw-medium">Memuat tanggal...</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Konten Utama Bawaan AdminLTE -->
<div class="app-content">
    <div class="container-fluid">
        <!-- Baris 1: Rangkuman Statistik Cepat -->
       
        <!-- Baris 2: Jalur Pintas & Live Status -->
        <div class="row mt-3">
            <!-- Sisi Kiri: Jalur Pintas -->
            <div class="col-lg-8">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-transparent border-bottom py-3">
                        <h5 class="card-title fw-bold mb-0 text-dark">
                            <i class="bi bi-box-arrow-up-right text-primary me-2"></i> Jalur Pintas Aplikasi
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
<script>
function initLiveClockGlobal() {
    const clockEl = document.getElementById('live-clock');
    const dateSubEl = document.getElementById('live-date-sub');
    
    function update() {
        const now = new Date();
        
        if (clockEl) {
            clockEl.textContent = now.toLocaleTimeString('id-ID', { 
                hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' 
            });
        }
        
        if (dateSubEl) {
            dateSubEl.textContent = now.toLocaleDateString('id-ID', { 
                weekday: 'long', day: 'numeric', month: 'long', year: 'numeric' 
            });
        }
    }
    
    setInterval(update, 1000);
    update();
}

document.addEventListener('DOMContentLoaded', initLiveClockGlobal);
</script>