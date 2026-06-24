<?php
$url="http://192.168.34.169/satukan.jiwa/cadil/index.php/api_dashboard";
$response=file_get_contents($url);
$data=json_decode($response,true);
?>
<style>
    .app-main, .app-content {
        overflow-x: hidden !important;
        width: 100% !important;
        max-width: 100% !important;}
    .table {
        table-layout: fixed !important;
        width: 100% !important;}
    .table td, .table th {
        white-space: normal !important; 
        word-wrap: break-word !important;}
</style> 
     <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0 fw-bold">CATATAN DINAS LUAR</h3>
              </div>
              <div class="col-sm-6 text-end">
                <div class="col-12 d-flex justify-content-end align-items-center gap-2">
                <!-- Input Group Kalender -->
                <!-- <div class="input-group input-group-sm" style="max-width: 180px;">
                    <span class="input-group-text bg-white border-end-0" id="date-filter-icon">
                        <i class="bi bi-calendar-event text-muted"></i>
                    </span>
                    <input type="date" id="elenopeda-date-filter" class="form-control border-start-0 ps-0 text-muted" value="<?= date('Y-m-d') ?>" aria-describedby="date-filter-icon">
                </div> -->
                <!-- Tombol Filter Utama -->
                <!-- <button class="btn btn-sm btn-primary px-3 d-flex align-items-center gap-1" type="button" style="height: 31px;">
                    <span>Filter</span>
                </button> -->
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="app-content px-3">
            <!-- Row: Chart -->
            <div class="row mt-1">
              <div class="col-12">
                <div class="card mb-4 shadow-sm">
                <div class="card-header">
                  <h5 class="card-title fw-bold mb-0">Grafik SPPD</h5>
              </div>
              <div class="card-body">
                  <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
                      <div class="d-flex align-items-center gap-3">
                        <!-- sppt tidak digunakan -->
                          <!-- <div class="d-flex align-items-center gap-2">
                              <span class="rounded-circle" style="width: 12px; height: 12px; background-color: #00ddfd; display: inline-block;"></span>
                              <span style="font-size: 13px; color: #475569;" class="fw-medium">SPT (Tugas)</span>
                          </div> -->
                          <div class="d-flex align-items-center gap-2">
                              <span class="rounded-circle" style="width: 12px; height: 12px; background-color: #019875; display: inline-block;"></span>
                              <span style="font-size: 13px; color: #475569;" class="fw-medium">SPPD (Perjalanan)</span>
                          </div>
                      </div>
                      <!-- Sisi Kanan: Kotak Total Dinamis -->
                      <div class="d-flex gap-2">
                          <!-- Kotak Total SPT -->
                          <!-- <div class="px-3 py-1 bg-light rounded border-start border-info border-3 text-center shadow-sm">
                              <span style="font-size: 11px;" class="text-muted">TOTAL SPT: </span>
                              <strong style="font-size: 14px;"><?php //echo $data['total_spt'];?></strong>
                          </div> -->
                          <!-- Kotak Total SPPD -->
                          <div class="px-3 py-1 bg-light rounded border-start border-success border-3 text-center shadow-sm">
                              <span style="font-size: 11px;" class="text-muted">TOTAL SPPD: </span>
                              <strong style="font-size: 14px;"><?php //echo $data['total_sppd'];?></strong>
                              </div>
                          </div>
                      </div>
                      <!-- Area Render Grafik Utama -->
                      <div id="cadil-chart-gabungan"></div>
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
                            </tbody>
                        </table>
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
  const cadilChartOptions = {
    series: [
      // { name: 'SPT (Tugas)', data: [8, 12, 10, 14, 18, 16, 0, 0, 0, 0, 0, 0] },
      { name: 'SPPD (Perjalanan)', data: [6, 9, 8, 11, 13, 10, 0, 0, 0, 0, 0, 0] },
    ],
    chart: { type: 'line', height: 340, toolbar: { show: false } },
    colors: ['#00d6fd', '#198754'],
    stroke: { curve: 'smooth', width: 3 },
    markers: { size: 4 },
    xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'] },
    legend: { show: false, position: 'top',  horizontalAlign: 'left', offsetY: -10  },
    grid: { padding: {  top: 0 } },
    yaxis: {   max: 19,  tickAmount: 4,  },
    dataLabels: { enabled: false },
    tooltip: { y: { formatter: (val) => `${val} Surat` } }
  };
  new ApexCharts(document.querySelector('#cadil-chart-gabungan'), cadilChartOptions).render();
</script>
<?php
$extra_scripts = ob_get_clean();
?>
