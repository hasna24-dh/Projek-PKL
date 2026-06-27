<?php
// Menggunakan fungsi baru untuk mengambil data dengan fallback cache
$api_url = "http://192.168.34.169/satukan.jiwa/sesuk/index.php/api_dashboard";
$result = get_data_with_cache($koneksi_utama, $api_url, 'sesuk_data');

$data = $result['data'];
$is_offline = $result['source'] === 'cache';
$last_updated = $result['last_updated'] ? date('d M Y, H:i', strtotime($result['last_updated'])) : 'N/A';

// Memberikan nilai default untuk mencegah error jika data benar-benar kosong
$jml_surat_masuk = $data['jml_surat_masuk'] ?? 0;
$jml_surat_keluar = $data['jml_surat_keluar'] ?? 0;
$jml_disposisi = $data['jml_disposisi'] ?? 0;
$belum_disposisi = $jml_surat_masuk - $jml_disposisi;
?>
<main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0 fw-bold">SESUK</h3>
              </div>
              <div class="col-sm-6 d-flex align-items-center justify-content-end">
                <?php if ($is_offline): ?>
                  <span class="badge text-bg-warning me-2" data-bs-toggle="tooltip" title="Menampilkan data offline yang tersimpan.">
                    <i class="bi bi-wifi-off"></i> OFFLINE
                  </span>
                <?php endif; ?>
                <small class="text-muted">
                  Update Terakhir: <?php echo $last_updated; ?>
                </small>
              </div>
            </div>
          </div> 
        </div>

        <div class="app-content">
          <div class="container-fluid">
            
            <!-- Row: Key summary -->
            <div class="row d-flex align-items-stretch">
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-primary h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold"><?php echo $jml_surat_masuk;?></h3>
                    <p>Total Surat Masuk</p>
                  </div>
                  <i class="small-box-icon bi bi-inbox-fill"></i>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold"><?php echo $jml_surat_keluar;?></h3>
                    <p>Total Surat Keluar</p>
                  </div>
                  <i class="small-box-icon bi bi-box-arrow-up-right"></i>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-warning h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold"><?php echo $jml_disposisi;?></h3>
                    <p>Terdisposisi</p>
                  </div>
                  <i class="small-box-icon bi bi-person-check-fill"></i>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-danger h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold"><?php echo $belum_disposisi;?></h3>
                    <p>Belum Terdisposisi</p>
                  </div>
                  <i class="small-box-icon bi bi-person-dash-fill"></i>
                </div>
              </div>
            </div>

            <!-- Row: Charts -->
          <div class="row mt-4 d-flex align-items-stretch">
              <div class="col-lg-6">
                  <!-- Tambahkan h-100 di bawah ini -->
                  <div class="card mb-4 shadow-sm h-100">
                      <div class="card-header">
                          <h5 class="card-title fw-bold">Total Surat Masuk & Keluar</h5>
                      </div>
                      <div class="card-body">
                          <div id="chart-surat-masuk-keluar"></div>
                      </div>
                  </div>
              </div>

              <div class="col-lg-6">
                  <!-- Tambahkan h-100 di bawah ini -->
                  <div class="card mb-4 shadow-sm h-100">
                      <div class="card-header">
                          <h5 class="card-title fw-bold">Surat Masuk yang Terdisposisi & Belum</h5>
                      </div>
                          <div class="card-body d-flex flex-column justify-content-center">
                          <div id="chart-terdisposisi" class="w-100"></div>
                      </div>
                  </div>
              </div>
          </div>
      </main>

<?php
ob_start();
?>
<script>
  // Total Surat Masuk vs Keluar
  const chartSuratMasukKeluarOptions = {
    series: [{ name: 'Jumlah Surat', data: [<?php echo $jml_surat_masuk;?>, <?php echo $jml_surat_keluar;?>] }],
    chart: { type: 'bar', height: 320, toolbar: { show: false } },
    plotOptions: { bar: { borderRadius: 6, horizontal: true } },
    colors: ['#0d6efd', '#198754'],
    dataLabels: { enabled: true, style: { colors: ['#fff'] } },
    xaxis: { categories: ['Total Surat Masuk', 'Total Surat Keluar'] },
    legend: { show: false },
    tooltip: { y: { formatter: (val) => `${val} surat` } }
  };
  new ApexCharts(document.querySelector('#chart-surat-masuk-keluar'), chartSuratMasukKeluarOptions).render();

  // Terdisposisi vs Belum
  const chartTerdisposisiOptions = {
    series: [<?php echo $jml_disposisi;?>, <?php echo $belum_disposisi;?>], chart: { type: 'pie',  height: 320, },
    labels: ['Terdisposisi', 'Belum Terdisposisi'],
    colors: ['#ffc107', '#dc3545'],
    dataLabels: { enabled: true },
    legend: { position: 'bottom' },
    tooltip: { enabled: true, theme: 'light',  fillSeriesColor: false, 
        style: {  fontSize: '12px', fontFamily: undefined },
        y: {
          formatter: function(val, opts) {
            let total = opts.globals.series.reduce((a, b) => a + b, 0);
            let percent = ((val / total) * 100).toFixed(0);
            return `${val} surat (${percent}%)`; },
          title: {  formatter: function() {  return 'Jumlah Surat:'; } }
        }
     }
  };
  new ApexCharts(document.querySelector('#chart-terdisposisi'), chartTerdisposisiOptions).render();
</script>
<?php
$extra_scripts = ob_get_clean();
?>