      <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0 fw-bold">SESUK</h3>
              </div>
              <div class="col-sm-6 text-end">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">SESUK</li>
                </ol>
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
                    <h3 class="fw-bold">500</h3>
                    <p>Total Surat Masuk</p>
                  </div>
                  <i class="small-box-icon bi bi-inbox-fill"></i>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold">210</h3>
                    <p>Total Surat Keluar</p>
                  </div>
                  <i class="small-box-icon bi bi-box-arrow-up-right"></i>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-warning h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold">320</h3>
                    <p>Terdisposisi</p>
                  </div>
                  <i class="small-box-icon bi bi-person-check-fill"></i>
                </div>
              </div>

              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-danger h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold">180</h3>
                    <p>Belum Terdisposisi</p>
                  </div>
                  <i class="small-box-icon bi bi-person-dash-fill"></i>
                </div>
              </div>
            </div>

            <!-- Row: Charts -->
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

            

          </div>
        </div>
      </main>

<?php
// Menyuntikkan script chart (ApexCharts) spesifik hanya untuk file SESUK ini ke footer
ob_start();
?>
<script>
  // Total Surat Masuk vs Keluar
  const chartSuratMasukKeluarOptions = {
    series: [{ name: 'Jumlah Surat', data: [500, 210] }],
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
    series: [320, 180],
   chart: { 
    type: 'pie', 
    height: 320,
    events: {
      dataPointSelection: function(event, chartContext, config) {
        // Mengambil nama label ('Terdisposisi' atau 'Belum Terdisposisi')
        let label = config.w.config.labels[config.dataPointIndex];
        // Mengambil jumlah angka asli (320 atau 180)
        let value = config.w.config.series[config.dataPointIndex];
        // Mengambil total seluruh data (500)
        let total = config.w.config.series.reduce((a, b) => a + b, 0);
        // Menghitung persen
        let percent = ((value / total) * 100).toFixed(0);
        
        // Memunculkan pesan pop-up keterangan saat diklik
        alert(`Keterangan Surat:\nStatus: ${label}\nJumlah: ${value} surat (${percent}%)`);
      }
    }
  },
    labels: ['Terdisposisi', 'Belum Terdisposisi'],
    colors: ['#ffc107', '#dc3545'],
    dataLabels: { enabled: true },
    legend: { position: 'bottom' },
    tooltip: {
    enabled: true,
    theme: 'light',
    fillSeriesColor: false, // Wajib ditambahkan agar latar belakang kotak tetap putih, tidak mengikuti warna diagram
    style: {
      fontSize: '12px',
      fontFamily: undefined
    },
    y: {
      formatter: function(val, opts) {
        let total = opts.globals.series.reduce((a, b) => a + b, 0);
        let percent = ((val / total) * 100).toFixed(0);
        return `${val} surat (${percent}%)`;
      },
      title: {
        formatter: function() {
          return 'Jumlah Surat:';
        }
      }
    }
  }
  };
  new ApexCharts(document.querySelector('#chart-terdisposisi'), chartTerdisposisiOptions).render();
</script>
<?php
$extra_scripts = ob_get_clean();
?>