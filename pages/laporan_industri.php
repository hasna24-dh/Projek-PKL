      <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0 fw-bold">DBES-IKM</h3>
              </div>
              <div class="col-sm-6 text-end">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">DBES-IKM</li>
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
                    <h3 class="fw-bold">1250</h3>
                    <p>Jumlah IKM</p>
                  </div>
                  <i class="small-box-icon bi bi-buildings-fill"></i>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold">62%</h3>
                    <p>Skala Industri Kecil</p>
                  </div>
                  <i class="small-box-icon bi bi-person-workspace"></i>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-info h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold">24%</h3>
                    <p>Skala Industri Menengah</p>
                  </div>
                  <i class="small-box-icon bi bi-graph-up-arrow"></i>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-warning h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold">14%</h3>
                    <p>Skala Industri Besar</p>
                  </div>
                  <i class="small-box-icon bi bi-building"></i>
                </div>
              </div>
            </div>

            <!-- Row: Charts -->
            <div class="row mt-4 d-flex align-items-stretch">
              <div class="col-lg-6">
                <div class="card mb-4 shadow-sm">
                  <div class="card-header">
                    <h5 class="card-title fw-bold">Skala Industri (Kecil, Menengah, Besar)</h5>
                  </div>
                  <div class="card-body">
                    <div style="overflow-x: auto; overflow-y: hidden;">
                      <div id="skala-industri-chart" style="min-width: 500px;"></div>
                    </div>
                  </div>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="card mb-4 shadow-sm">
                  <div class="card-header">
                    <h5 class="card-title fw-bold">Jumlah IKM (Ringkas)</h5>
                  </div>
                  <div class="card-body">
                    <div id="jumlah-ikm-chart"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-0">
              <div class="col-12">
                <div class="card mb-4 shadow-sm">
                  <div class="card-header">
                    <h5 class="card-title fw-bold">Per Jenis KBLI</h5>
                  </div>
                  <div class="card-body">
                    <div style="overflow-x: auto; overflow-y: hidden;">
                      <div id="per-jenis-kbli-chart" style="min-width: 900px;"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-2">
              <div class="col-12">
                <div class="alert alert-primary mb-0" role="alert">
                  Data pada grafik menggunakan contoh (placeholder). Hubungkan ke sumber data DBES-IKM untuk angka real.
                </div>
              </div>
            </div>

          </div>
        </div>
      </main>

<?php
// Menyuntikkan script chart (ApexCharts) spesifik hanya untuk file laporan_industri ini ke footer
ob_start();
?>
<script>
  // Skala Industri chart (donut)
  const skalaIndustriOptions = {
    series: [62, 24, 14],
    chart: { type: 'donut', height: 320 },
    labels: ['Kecil', 'Menengah', 'Besar'],
    colors: ['#0d6efd', '#198754', '#ffc107'],
    dataLabels: { enabled: false },
    legend: { position: 'bottom' },
    tooltip: {
      y: { formatter: (val) => `${val}%` }
    }
  };
  new ApexCharts(document.querySelector('#skala-industri-chart'), skalaIndustriOptions).render();

  // Jumlah IKM chart (bar)
  const jumlahIkmOptions = {
    series: [{ name: 'Jumlah IKM', data: [775, 300, 175] }],
    chart: { type: 'bar', height: 280, toolbar: { show: false } },
    plotOptions: {
        bar: { horizontal: true, borderRadius: 6, dataLabels: { position: 'center' } }
    },
    dataLabels: {
        enabled: true,
        formatter: function (val) { return val; },
        style: { colors: ['#ffffff'] }
    },
    colors: ['#0d6efd', '#198754', '#ffc107'], // Kode warna Bootstrap standar yang valid (Biru, Hijau, Kuning)
    xaxis: { categories: ['Kecil', 'Menengah', 'Besar'] },
    tooltip: { y: { formatter: (val) => `${val} IKM` } }
  };
  new ApexCharts(document.querySelector('#jumlah-ikm-chart'), jumlahIkmOptions).render();

  // Per Jenis KBLI (bar)
  const perJenisKbliOptions = {
    series: [{ name: 'Jumlah IKM', data: [120, 95, 180, 70, 140, 60] }],
    chart: { type: 'bar', height: 320, toolbar: { show: false } },
    plotOptions: { bar: { horizontal: false, columnWidth: '50%', borderRadius: 4 } },
    dataLabels: { enabled: false },
    colors: ['#198754'],
    xaxis: { categories: ['KBLI A', 'KBLI B', 'KBLI C', 'KBLI D', 'KBLI E', 'KBLI F'], tickPlacement: 'on' },
    yaxis: { labels: { formatter: (val) => val } },
    tooltip: { y: { formatter: (val) => `${val} IKM` } }
  };
  new ApexCharts(document.querySelector('#per-jenis-kbli-chart'), perJenisKbliOptions).render();
</script>
<?php
$extra_scripts = ob_get_clean();
?>