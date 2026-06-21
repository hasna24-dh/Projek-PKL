      <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0 fw-bold">DBES-IKM</h3>
              </div>
              <div class="col-sm-6 text-end">
                <div class="col-12 d-flex justify-content-end align-items-center gap-2">
                <!-- Input Group Kalender -->
                <div class="input-group input-group-sm" style="max-width: 180px;">
                    <span class="input-group-text bg-white border-end-0" id="date-filter-icon">
                        <i class="bi bi-calendar-event text-muted"></i>
                    </span>
                    <input type="date" id="elenopeda-date-filter" class="form-control border-start-0 ps-0 text-muted" value="<?= date('Y-m-d') ?>" aria-describedby="date-filter-icon">
                </div>
                <!-- Tombol Filter Utama -->
                <button class="btn btn-sm btn-primary px-3 d-flex align-items-center gap-1" type="button" style="height: 31px;">
                    <span>Filter</span>
                </button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">
            <!-- Row: Key summary -->
            <div class="row d-flex align-items-stretch">
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-danger h-100 mb-0 shadow-sm">
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
                <div class="small-box text-bg-primary h-100 mb-0 shadow-sm">
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
                 <div class="card mb-4 shadow-sm" style="height: 380px;"> 
                  <div class="card-header">
                    <h5 class="card-title fw-bold">Skala Industri (Kecil, Menengah, Besar)</h5>
                  </div>
                  <div class="card-body">
                    <div style="overflow-x: auto; overflow-y: hidden;">
                      <div id="skala-industri-chart" ></div>
                    </div>
                  </div>
                </div>
              </div>

             <!-- KOTAK KANAN: JUMLAH IKM (RINGKAS) -->
            <div class="col-lg-6">
                <div class="card mb-4 shadow-sm" style="height: 380px;"> 
                    <div class="card-header">
                        <h5 class="card-title fw-bold">Jumlah IKM (Ringkas)</h5>
                    </div>
                    <div class="card-body">
                        <div id="jumlah-ikm-chart"></div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
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
ob_start();
?>
<script>
  // Skala Industri chart (donut)
  const skalaIndustriOptions = {
    series: [62, 24, 14],
    chart: { type: 'donut', height: 320 },
    labels: ['Kecil', 'Menengah', 'Besar'],
    colors: ['#0d6efd', '#198754', '#ffc107'],
    dataLabels: { enabled: true, style: { fontSize: '10px', fontWeight: 'bold', colors: ['#ffffff'] }, },
    legend: { position: 'bottom', horizontalAlign: 'center',  itemMargin: { horizontal: 10, vertical: 5 } },
    plotOptions: { pie: { offsetY: 10, donut: { labels: { show: false } } } },
    tooltip: { enabled: true, theme: 'light', fillSeriesColor: false, style: { fontSize: '12px' },
    y: { formatter: function(val, opts) {
        let total = opts.globals.series.reduce((a, b) => a + b, 0);
        let percent = ((val / total) * 100).toFixed(0);
        return val + " (" + percent + "%)"; },
        title: { formatter: function(seriesName) { return seriesName + ':'; } }
      }
    },
  };
  new ApexCharts(document.querySelector('#skala-industri-chart'), skalaIndustriOptions).render();

  // Jumlah IKM chart (bar)
  const jumlahIkmOptions = {
    series: [{ name: 'Jumlah IKM', data: [775, 300, 175] }],
    chart: { type: 'bar', height: 280, toolbar: { show: false } },
    plotOptions: { bar: { horizontal: true, borderRadius: 6, dataLabels: { position: 'center' }, offsetY:45, offsetX: -15 } },
    dataLabels: { enabled: true, formatter: function (val) { return val; }, style: { colors: ['#ffffff'] }},
    colors: ['#0d6efd', '#198754', '#ffc107'],
    xaxis: { categories: ['Kecil', 'Menengah', 'Besar'] },
    tooltip: { y: { formatter: (val) => `${val} IKM` } }
  };
  new ApexCharts(document.querySelector('#jumlah-ikm-chart'), jumlahIkmOptions).render();

  // Per Jenis KBLI (bar)
  const perJenisKbliOptions = {
    series: [{ name: 'Jumlah IKM', data: [120, 95, 180, 70, 140, 60] }],
    chart: { type: 'bar', height: 320, toolbar: { show: false } },
    plotOptions: { bar: { horizontal: false, columnWidth: '50%', borderRadius: 4 } },
    dataLabels: { enabled: true },
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