<style>
    /* Mengunci scroll samping HANYA pada area konten utama agar tidak merusak sidebar */
    .app-main, .app-content {
        overflow-x: hidden !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Memastikan tabel dipaksa muat dan membungkus teks jika terlalu panjang */
    .table {
        table-layout: fixed !important;
        width: 100% !important;
    }

    .table td, .table th {
        white-space: normal !important; /* Membuat teks panjang otomatis turun ke bawah, bukan memanjang ke samping */
        word-wrap: break-word !important;
    }
</style>  
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
          

            <!-- Row: Chart -->
            <div class="row mt-1">
              <div class="col-12">
                <div class="card mb-4 shadow-sm">
                  <div class="card-header">
                      <h5 class="card-title fw-bold">Grafik SPT vs SPPD (Gabungan)</h5>
                  </div>
                  <!-- Tambahkan class position-relative pada card-body -->
                  <div class="card-body position-relative">
                      
                      <!-- Wadah Kotak Ringkasan di Pojok Kanan Atas -->
                      <div class="d-flex gap-2" style="position: absolute; top: 15px; right: 15px; z-index: 10;">
                          
                          <!-- Kotak Mini 1: SPT (Tugas) -->
                          
    
                      <!-- Kotak Kecil di Kanan -->
                      <div class="d-flex gap-2">
                          <div class="px-3 py-1 bg-light rounded border-start border-info border-3 text-center">
                              <span style="font-size: 11px;" class="text-muted">SPT:</span>
                              <strong style="font-size: 14px;">120</strong>
                          </div>
                          <div class="px-3 py-1 bg-light rounded border-start border-success border-3 text-center">
                              <span style="font-size: 11px;" class="text-muted">SPPD:</span>
                              <strong style="font-size: 14px;">85</strong>
                          </div>
                      </div>
                  </div>

                      </div>

                      <!-- Tempat Grafik Anda Rendring -->
                      <div id="cadil-chart-gabungan"></div>
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
                        <!-- Baris data lainnya... -->
                </tbody>
            </table>
        </div> <!-- Penutup table-responsive / w-100 -->
    </div> <!-- Penutup card-body -->
</div> <!-- Penutup card -->
</div> <!-- Penutup col-12 -->
</div> <!-- Penutup row milik tabel -->

</div> <!-- Penutup app-content (Ini yang membuat copyright kembali ke posisinya) -->
</main>

<?php
// Menyuntikkan script chart (ApexCharts) spesifik hanya untuk file CADIL ini ke footer
ob_start();
?>
<script>
  const cadilChartOptions = {
    series: [
      { name: 'SPT (Tugas)', data: [8, 12, 10, 14, 18, 16, 0, 0, 0, 0, 0, 0] },
      { name: 'SPPD (Perjalanan)', data: [6, 9, 8, 11, 13, 10, 0, 0, 0, 0, 0, 0] },
    ],
    chart: { type: 'line', height: 340, toolbar: { show: false } },
    colors: ['#00d6fd', '#198754'],
    stroke: { curve: 'smooth', width: 3 },
    markers: { size: 4 },
    xaxis: { categories: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agt', 'Sep', 'Okt', 'Nov', 'Des'] },
    legend: { 
      position: 'top', 
      horizontalAlign: 'left',
      offsetY: -10 // Angka minus akan memaksa teks legenda naik lebih tinggi ke arah judul
    },
    grid: {
      padding: {
        top: 0
      }
    },
    // TAMBAHKAN BLOK KODE YAXIS INI DI SINI
    yaxis: {
      max: 19, // Mengunci batas atas grafik di angka 19 (pas di atas angka tertinggi 18)
      tickAmount: 4, // Membuat pembagian skala menjadi 4 tingkatan rapi di kiri
    },
    dataLabels: { enabled: false },
    tooltip: { y: { formatter: (val) => `${val} Surat` } }
  };
  new ApexCharts(document.querySelector('#cadil-chart-gabungan'), cadilChartOptions).render();
</script>
<?php
$extra_scripts = ob_get_clean();
?>
