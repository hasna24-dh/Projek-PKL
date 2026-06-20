      <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0 fw-bold">CATATAN DINAS LUAR</h3>
              </div>
              <div class="col-sm-6 text-end">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">CADIL</li>
                </ol>
              </div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">
            <!-- Row: Stats -->
            <div class="row d-flex align-items-stretch">
              <div class="col-lg-3 col-md-6 col-12">
                <div class="small-box text-bg-primary h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold">120</h3>
                    <p>SPT (Tugas)</p>
                  </div>
                  <i class="small-box-icon bi bi-file-earmark-text"></i>
                </div>
              </div>

              <div class="col-lg-3 col-md-6 col-12">
                <div class="small-box text-bg-success h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold">85</h3>
                    <p>SPPD (Perjalanan)</p>
                  </div>
                  <i class="small-box-icon bi bi-geo-alt"></i>
                </div>
              </div>
            </div>

            <!-- Row: Chart -->
            <div class="row mt-4">
              <div class="col-12">
                <div class="card mb-4 shadow-sm">
                  <div class="card-header">
                    <h5 class="card-title fw-bold">Grafik SPT vs SPPD (Gabungan)</h5>
                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" onclick="window.location.reload();" title="Refresh">
                        <i class="bi bi-arrow-clockwise"></i>
                      </button>
                    </div>
                  </div>
                  <div class="card-body">
                    <div id="cadil-chart-gabungan"></div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Row: Table Karyawan Dinas Luar -->
            <div class="row">
              <div class="col-12">
                <div class="card mb-4 shadow-sm">
                  <div class="card-header">
                    <h5 class="card-title fw-bold">Tabel Data Karyawan Dinas Luar</h5>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-bordered table-striped align-middle mb-0">
                        <thead class="table-light">
                          <tr>
                            <th style="width: 40px;">#</th>
                            <th>Nama</th>
                            <th>Jabatan</th>
                            <th>Unit</th>
                            <th>Jenis Surat</th>
                            <th>Tanggal</th>
                            <th style="width: 120px;">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>1</td>
                            <td>Agus Pratama</td>
                            <td>Staf Administrasi</td>
                            <td>Subbag Umum</td>
                            <td>SPPD</td>
                            <td>2026-06-01</td>
                            <td><span class="badge text-bg-success">Terbit</span></td>
                          </tr>
                          <!-- Baris data lainnya... -->
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </main>

<?php
// Menyuntikkan script chart (ApexCharts) spesifik hanya untuk file CADIL ini ke footer
ob_start();
?>
<script>
  const cadilChartOptions = {
    series: [
      { name: 'SPT (Tugas)', data: [8, 12, 10, 14, 18, 16] },
      { name: 'SPPD (Perjalanan)', data: [6, 9, 8, 11, 13, 10] },
    ],
    chart: { type: 'line', height: 340, toolbar: { show: false } },
    colors: ['#0d6efd', '#198754'],
    stroke: { curve: 'smooth', width: 3 },
    markers: { size: 4 },
    xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun'] },
    legend: { position: 'top' },
    dataLabels: { enabled: false },
    tooltip: { y: { formatter: (val) => `${val} Surat` } }
  };
  new ApexCharts(document.querySelector('#cadil-chart-gabungan'), cadilChartOptions).render();
</script>
<?php
$extra_scripts = ob_get_clean();
?>
