<?php
$url="http://192.168.34.169:8080/satukan.jiwa/elenopeda/index.php/api_dashboard";
$response=file_get_contents($url);
$data=json_decode($response,true);
?>      
      <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0 fw-bold">ELENOPEDA</h3>
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

        <div class="app-content">
          <div class="container-fluid">
            <div class="row d-flex align-items-stretch g-3 mb-4">
            <!-- Kotak 1: Total Pengajuan Dana -->
            <div class="col-xl-4 col-lg-4 col-md-6 col-12 d-flex">
                <div class="small-box text-bg-primary h-100 m-0 shadow-sm w-100">
                    <div class="inner">
                        <h3 class="fw-bold text-nowrap" style="font-size: 1.4rem; margin-bottom: 5px;"><?php echo $data['total_dana'];?></h3>
                        <p class="text-nowrap" style="font-size: 0.9rem; margin-bottom: 0;">Total Pengajuan Dana</p>
                    </div>
                    <i class="small-box-icon text-bg-primary bi bi-cash-stack"></i>
                </div>
            </div>
            <!-- Kotak 2: Total NPD -->
            <div class="col-xl-2 col-lg-2 col-md-6 col-12 d-flex">
                <div class="small-box text-bg-warning h-100 m-0 shadow-sm w-100">
                    <div class="inner">
                        <h3 class="fw-bold"><?php echo $data['total_npd'];?></h3>
                        <p style="font-size: 0.9rem; margin-bottom: 0;">Total NPD</p>
                    </div>
                    <i class="small-box-icon bi bi-file-earmark-text-fill"></i>
                </div>
            </div>
            <!-- Kotak 3: NPD Terverifikasi -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-12 d-flex">
                <div class="small-box text-bg-success h-100 m-0 shadow-sm w-100">
                    <div class="inner">
                        <h3 class="fw-bold"><?php echo $data['npd_verifikasi'];?></h3>
                        <p style="font-size: 0.9rem; margin-bottom: 0;">NPD Terverifikasi</p>
                    </div>
                    <i class="small-box-icon bi bi-patch-check-fill"></i>
                </div>
            </div>
            <!-- Kotak 4: NPD Belum Verifikasi -->
            <div class="col-xl-3 col-lg-3 col-md-6 col-12 d-flex">
                <div class="small-box text-bg-danger h-100 m-0 shadow-sm w-100">
                    <div class="inner">
                        <h3 class="fw-bold"><?php echo $data['npd_belum'];?></h3>
                        <p style="font-size: 0.9rem; margin-bottom: 0;">NPD Belum Verifikasi</p>
                    </div>
                    <i class="small-box-icon bi bi-patch-exclamation-fill"></i>
                </div>
            </div>
           </div>

            <!-- Row 2: Charts -->
            <div class="row d-flex align-items-stretch">
              <div class="col-lg-4 mb-4">
                <div class="card h-100">
                  <div class="card-header">
                    <h5 class="card-title fw-bold">Status Verifikasi NPD</h5>
                  </div>
                  <div class="card-body d-flex align-items-center justify-content-center">
                    <div id="chart-verifikasi-npd" style="min-height: 300px; width: 100%;"></div>
                  </div>
                </div>
              </div>
              <div class="col-lg-8 mb-4">
                <div class="card h-100">
                  <div class="card-header">
                    <h5 class="card-title fw-bold">Struktur Kegiatan</h5>
                  </div>
                  <div class="card-body">
                    <div id="chart-struktur-kegiatan" style="min-height: 300px;"></div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Row 3: Breakdown -->
          <div class="row d-flex align-items-stretch g-3 mb-4">
              <!-- Kotak: Jumlah Program -->
              <div class="col-xl-4 col-md-4 col-12 d-flex">
                  <div class="card w-100 h-100 m-0 shadow-sm p-4" style="border-left: 5px solid #0d6efd; border-radius: 12px 4px 4px 12px; border-top: none; border-right: none; border-bottom: none; display: flex; flex-direction: row; justify-content: space-between; align-items: center; min-height: 95px; background-color: #fff;">
                      <div>
                          <h3 class="fw-bold" style="color: #212529; margin-bottom: 4px; font-size: 1.75rem; line-height: 1.1;"><?php echo $data['jml_program'];?></h3>
                          <p style="font-size: 0.9rem; color: #6c757d; margin-bottom: 0; font-weight: bold;">Jumlah Program</p>
                      </div>
                      <div class="text-primary">
                          <i class="bi bi-diagram-3-fill" style="font-size: 1.5rem;"></i>
                      </div>
                  </div>
              </div>

              <!-- Kotak: Jumlah Kegiatan -->
              <div class="col-xl-4 col-md-4 col-12 d-flex">
                  <div class="card w-100 h-100 m-0 shadow-sm p-4" style="border-left: 5px solid #198754; border-radius: 12px 4px 4px 12px; border-top: none; border-right: none; border-bottom: none; display: flex; flex-direction: row; justify-content: space-between; align-items: center; min-height: 95px; background-color: #fff;">
                      <div>
                          <h3 class="fw-bold" style="color: #212529; margin-bottom: 4px; font-size: 1.75rem; line-height: 1.1;"><?php echo $data['jml_kegiatan'];?></h3>
                          <p style="font-size: 0.9rem; color: #6c757d; margin-bottom: 0; font-weight: bold;">Jumlah Kegiatan</p>
                      </div>
                      <div class="text-success">
                          <i class="bi bi-collection-fill" style="font-size: 1.5rem;"></i>
                      </div>
                  </div>
              </div>

              <!-- Kotak: Jumlah Sub Kegiatan -->
              <div class="col-xl-4 col-md-4 col-12 d-flex">
                  <div class="card w-100 h-100 m-0 shadow-sm p-4" style="border-left: 5px solid #dc3545; border-radius: 12px 4px 4px 12px; border-top: none; border-right: none; border-bottom: none; display: flex; flex-direction: row; justify-content: space-between; align-items: center; min-height: 95px; background-color: #fff;">
                      <div>
                          <h3 class="fw-bold" style="color: #212529; margin-bottom: 4px; font-size: 1.75rem; line-height: 1.1;"><?php echo $data['jml_sub_kegiatan'];?></h3>
                          <p style="font-size: 0.9rem; color: #6c757d; margin-bottom: 0; font-weight: bold;">Jumlah Sub Kegiatan</p>
                      </div>
                      <div class="text-danger">
                          <i class="bi bi-grid-3x3-gap-fill" style="font-size: 1.5rem;"></i>
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
document.addEventListener("DOMContentLoaded", () => {
  // Chart 1: Status Verifikasi NPD (Donut Chart)
  const chartVerifikasiOptions = {
    series: [<?php echo $data['npd_verifikasi'];?>, <?php echo $data['npd_belum'];?>], // Data: [Terverifikasi, Belum Terverifikasi]
    chart: { type: 'donut', height: 320 },
    labels: ['NPD Terverifikasi', 'NPD Belum Verifikasi'],
    colors: ['#198754', '#dc3545'], 
    dataLabels: { enabled: true, style: { fontSize: '10px', fontWeight: 'bold', colors: ['#ffffff'] }, },
    plotOptions: {
      pie: {
        donut: {
          labels: {
            show: true,
            name: { show: true, fontSize: '12px', fontWeight: 500, color: '#666666', offsetY: -10 },
            value: { show: true, fontSize: '16px', fontWeight: 700, color: '#111111', offsetY: 4 },
            total: { show: true, label: 'Total NPD', fontSize: '12px', fontWeight: 500, color: '#666666',
              formatter: function (w) {
                return w.globals.seriesTotals.reduce((a, b) => { return a + b }, 0)
              }
            }
          }
        }
      }
    },
    legend: { position: 'bottom' },
    tooltip: { enabled: true, theme: 'light', fillSeriesColor: false,  style: {fontSize: '12px', fontFamily: undefined },
    y: { formatter: function(val, opts) {
          let total = opts.globals.series.reduce((a, b) => a + b, 0);
          let percent = ((val / total) * 100).toFixed(1);
          return val + " NPD (" + percent + "%)";},
          title: { formatter: function() { return 'Jumlah NPD:'; } }
      }
    }
  };
  new ApexCharts(document.querySelector('#chart-verifikasi-npd'), chartVerifikasiOptions).render();

  // Chart 2: Struktur Kegiatan (Bar Chart)
  const chartStrukturOptions = {
    series: [{
      name: 'Jumlah',
      data: [<?php echo $data['jml_program'];?>, <?php echo $data['jml_kegiatan'];?>, <?php echo $data['jml_sub_kegiatan'];?>] // Data: [Program, Kegiatan, Sub Kegiatan]
    }],
    chart: {  type: 'bar', height: 320, toolbar: { show: false } },
    plotOptions: { bar: {  borderRadius: 4,  horizontal: false, columnWidth: '50%', } },
    dataLabels: {  enabled: false },
    colors: ['#3182ce'],
    xaxis: { categories: ['Program', 'Kegiatan', 'Sub Kegiatan'], },
    yaxis: {  title: { text: 'Jumlah' } },
    tooltip: { y: { formatter: (val) => `${val}`  } }
  };
  new ApexCharts(document.querySelector('#chart-struktur-kegiatan'), chartStrukturOptions).render();
});
</script>
<?php
$extra_scripts = ob_get_clean();
?>