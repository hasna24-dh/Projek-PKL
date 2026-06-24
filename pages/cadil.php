<?php
// Mengakuisisi data dari REST API
$url="http://192.168.34.169/satukan.jiwa/cadil/index.php/api_dashboard"; //diganti dengan .../cadil
$response=@file_get_contents($url);
$data=json_decode($response,true);

// Ekstraksi data API dengan penanganan nilai bawaan (fallback)
$total_sppd  = isset($data['total_sppd']) ? $data['total_sppd'] : 0;
$tabel_sppd  = isset($data['tabel_sppd']) ? $data['tabel_sppd'] : array();
$grafik_sppd = isset($data['grafik_sppd']) ? json_encode($data['grafik_sppd']) : json_encode(array_fill(0, 12, 0));
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
            </div>
        </div>
    </div>

    <div class="app-content px-3">
        <div class="row mt-1">
            <div class="col-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header">
                        <h5 class="card-title fw-bold mb-0">Grafik SPPD</h5>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3 flex-wrap gap-3">
                            <div class="d-flex align-items-center gap-3">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="rounded-circle" style="width: 12px; height: 12px; background-color: #019875; display: inline-block;"></span>
                                    <span style="font-size: 13px; color: #475569;" class="fw-medium">SPPD (Perjalanan)</span>
                                </div>
                            </div>
                            <div class="d-flex gap-2">
                                <div class="px-3 py-1 bg-light rounded border-start border-success border-3 text-center shadow-sm">
                                    <span style="font-size: 11px;" class="text-muted">TOTAL SPPD: </span>
                                    <strong style="font-size: 14px;"><?php echo $data['total_sppd']; ?></strong>
                                </div>
                            </div>
                        </div>
                        <div id="cadil-chart-gabungan"></div>
                    </div>
                </div>        
            </div>
        </div>

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
                                        <th>Tempat Tujuan</th>
                                        <th>Jenis Surat</th>
                                        <th>Tanggal</th>
                                        <th style="width: 120px;">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($tabel_sppd)): ?>
                                        <?php $no = 1; foreach ($tabel_sppd as $row): ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo htmlspecialchars($row['nama']); ?></td>
                                                <td><?php echo htmlspecialchars($row['jabatan']); ?></td>
                                                <td><?php echo htmlspecialchars($row['tempat_tujuan']); ?></td>
                                                <td>SPPD</td>
                                                <td><?php echo htmlspecialchars($row['tgl_berangkat']); ?></td>
                                                <td><span class="badge text-bg-success">Terbit</span></td>
                                            </tr> 
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="7" class="text-center text-muted">Belum ada data perjalanan dinas yang tercatat.</td>
                                        </tr> 
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
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
      // Konfigurasi SPT dibiarkan terkomentar sesuai instruksi
      // { name: 'SPT (Tugas)', data: [8, 12, 10, 14, 18, 16, 0, 0, 0, 0, 0, 0] },
      // Data SPPD diinjeksi secara dinamis
      { name: 'SPPD (Perjalanan)', data: <?php echo $data['grafik_sppd']; ?> },
    ],
    chart: { type: 'line', height: 340, toolbar: { show: false } },
    colors: ['#00d6fd', '#198754'], // Skema warna asli dipertahankan
    stroke: { curve: 'smooth', width: 3 },
    markers: { size: 4 },
    xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'] },
    legend: { show: false, position: 'top',  horizontalAlign: 'left', offsetY: -10  },
    grid: { padding: {  top: 0 } },
    yaxis: {  max: 19,  tickAmount: 4,  }, // Properti orisinal dipertahankan
    dataLabels: { enabled: false },
    tooltip: { y: { formatter: (val) => `${val} Surat` } }
  };
  new ApexCharts(document.querySelector('#cadil-chart-gabungan'), cadilChartOptions).render();
</script>
<?php
$extra_scripts = ob_get_clean();
?>