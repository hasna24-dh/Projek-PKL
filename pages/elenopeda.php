      <main class="app-main">
        <div class="app-content-header">
          <div class="container-fluid">
            <div class="row">
              <div class="col-sm-6">
                <h3 class="mb-0 fw-bold">ELENOPEDA</h3>
              </div>
              <div class="col-sm-6 text-end">
                <ol class="breadcrumb float-sm-end">
                  <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">ELENOPEDA</li>
                </ol>
              </div>
            </div>
            <!-- Filter Tanggal -->
            <div class="row align-items-center mt-3">
              <div class="col-md-6 col-lg-4">
                <div class="input-group">
                  <span class="input-group-text" id="date-filter-icon"><i class="bi bi-calendar-event"></i></span>
                  <input type="date" id="elenopeda-date-filter" class="form-control" value="<?= date('Y-m-d') ?>" aria-describedby="date-filter-icon">
                  <button class="btn btn-primary" type="button">Filter</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="app-content">
          <div class="container-fluid">
            <!-- Row 1: Main Summary (Refactored for Responsiveness) -->
           <!-- Row 1: Main Summary (Refactored for Responsiveness) -->
    <div class="row d-flex align-items-stretch g-3 mb-4">
        
        <!-- Kotak 1: Total Pengajuan Dana -->
        <div class="col-lg-3 col-md-6 col-12 d-flex">
            <div class="info-box w-100 h-100 m-0 shadow-sm">
                <span class="info-box-icon text-bg-primary"><i class="bi bi-cash-stack"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total Pengajuan Dana</span>
                    <span class="info-box-number">Rp 1.250.000.000</span>
                </div>
            </div>
        </div>

        <!-- Kotak 2: Total NPD -->
        <div class="col-xl-3 col-md-6 col-12 d-flex">
            <div class="info-box w-100 h-100 m-0 shadow-sm">
                <span class="info-box-icon text-bg-warning"><i class="bi bi-file-earmark-text-fill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Total NPD</span>
                    <span class="info-box-number">360</span>
                </div>
            </div>
        </div>

        <!-- Kotak 3: NPD Terverifikasi -->
        <div class="col-xl-3 col-md-6 col-12 d-flex">
            <div class="info-box w-100 h-100 m-0 shadow-sm">
                <span class="info-box-icon text-bg-success"><i class="bi bi-patch-check-fill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">NPD Terverifikasi</span>
                    <span class="info-box-number">240</span>
                </div>
            </div>
        </div>

        <!-- Kotak 4: NPD Belum Verifikasi -->
        <div class="col-xl-3 col-md-6 col-12 d-flex">
            <div class="info-box w-100 h-100 m-0 shadow-sm">
                <span class="info-box-icon text-bg-danger"><i class="bi bi-patch-exclamation-fill"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">NPD Belum Verifikasi</span>
                    <span class="info-box-number">120</span>
                </div>
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
            <div class="row d-flex align-items-stretch">
                <div class="col-md-4 mb-4">
                    <div class="info-box h-100">
                        <span class="info-box-icon text-bg-primary"><i class="bi bi-diagram-3-fill"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Program</span>
                            <span class="info-box-number">10</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="info-box h-100">
                        <span class="info-box-icon text-bg-info"><i class="bi bi-layout-text-window-reverse"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Kegiatan</span>
                            <span class="info-box-number">45</span>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="info-box h-100">
                        <span class="info-box-icon text-bg-secondary"><i class="bi bi-grid"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Jumlah Sub Kegiatan</span>
                            <span class="info-box-number">120</span>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </main>

<?php
// Menyuntikkan script chart (ApexCharts) spesifik hanya untuk file ELENOPEDA ini ke footer
ob_start();
?>
<script>
document.addEventListener("DOMContentLoaded", () => {
  // Chart 1: Status Verifikasi NPD (Donut Chart)
  const chartVerifikasiOptions = {
    series: [240, 120], // Data: [Terverifikasi, Belum Terverifikasi]
    chart: {
      type: 'donut',
      height: 320
    },
    labels: ['NPD Terverifikasi', 'NPD Belum Verifikasi'],
    colors: ['#198754', '#dc3545'], // Success and Danger colors
    plotOptions: {
      pie: {
        donut: {
          labels: {
            show: true,
            total: {
              show: true,
              label: 'Total NPD',
              formatter: function (w) {
                return w.globals.seriesTotals.reduce((a, b) => {
                  return a + b
                }, 0)
              }
            }
          }
        }
      }
    },
    legend: {
      position: 'bottom'
    },
    tooltip: {
      y: {
        formatter: (val) => `${val} NPD`
      }
    }
  };
  new ApexCharts(document.querySelector('#chart-verifikasi-npd'), chartVerifikasiOptions).render();

  // Chart 2: Struktur Kegiatan (Bar Chart)
  const chartStrukturOptions = {
    series: [{
      name: 'Jumlah',
      data: [10, 45, 120] // Data: [Program, Kegiatan, Sub Kegiatan]
    }],
    chart: {
      type: 'bar',
      height: 320,
      toolbar: {
        show: false
      }
    },
    plotOptions: {
      bar: {
        borderRadius: 4,
        horizontal: false,
        columnWidth: '50%',
      }
    },
    dataLabels: {
      enabled: false
    },
    colors: ['#3182ce'],
    xaxis: {
      categories: ['Program', 'Kegiatan', 'Sub Kegiatan'],
    },
    yaxis: {
      title: {
        text: 'Jumlah'
      }
    },
    tooltip: {
      y: {
        formatter: (val) => `${val}`
      }
    }
  };
  new ApexCharts(document.querySelector('#chart-struktur-kegiatan'), chartStrukturOptions).render();
});
</script>
<?php
$extra_scripts = ob_get_clean();
?>