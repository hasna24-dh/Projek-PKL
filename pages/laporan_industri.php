<?php
$url="http://192.168.34.169/satukan.jiwa/dbes-ikm/index.php/api_dashboard"; //.../dbes-ikm";
$response=file_get_contents($url);
$data=json_decode($response,true);
?>   
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
            <!-- Row: Key summary -->
            <div class="row d-flex align-items-stretch">
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-danger h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold"><?php echo $data['total_ikm'];?></h3>
                    <p>Jumlah IKM</p>
                  </div>
                  <i class="small-box-icon bi bi-buildings-fill"></i>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-success h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold"><?php echo $data['ikm_kecil'];?></h3>
                    <p>Skala Industri Kecil</p>
                  </div>
                  <i class="small-box-icon bi bi-person-workspace"></i>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-primary h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold"><?php echo $data['ikm_menengah'];?></h3>
                    <p>Skala Industri Menengah</p>
                  </div>
                  <i class="small-box-icon bi bi-graph-up-arrow"></i>
                </div>
              </div>
              <div class="col-lg-3 col-6">
                <div class="small-box text-bg-warning h-100 mb-0 shadow-sm">
                  <div class="inner">
                    <h3 class="fw-bold"><?php echo $data['ikm_besar'];?></h3>
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
                        <h5 class="card-title fw-bold">Jumlah IKM</h5>
                    </div>
                    <div class="card-body">
                        <div id="jumlah-ikm-chart"></div>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
              <div class="col-12">
                <div class="card mb-4 shadow-sm">
            
                <div class="card-header d-flex align-items-center">
                    <h5 class="card-title fw-bold mb-0">Per Jenis KBLI</h5>
  
                  <div class="ms-auto d-flex align-items-center gap-2">
    
                    <button id="btn-sort-kbli" class="btn btn-sm btn-outline-success d-flex align-items-center justify-content-center" type="button" title="Urutkan Terbanyak / Terkecil" style="width: 32px; height: 32px;">
                      <i class="bi bi-sort-down"></i>
                    </button>
    
                      <button id="btn-reset-kbli" class="btn btn-sm btn-outline-secondary d-flex align-items-center justify-content-center" type="button" title="Kembalikan ke Awal" style="width: 32px; height: 32px;">
                          <i class="bi bi-arrow-clockwise"></i>
                      </button>
    
                  </div>
                </div>
            <div class="card-body">
                <div id="per-jenis-kbli-chart"></div>
                
                <div class="d-flex justify-content-center align-items-center mt-3 gap-3">
                    <button id="btn-prev-kbli" class="btn btn-sm btn-outline-primary" type="button">
                        <i class="bi bi-chevron-left"></i> Sebelumnya
                    </button>
                    <span id="kbli-page-info" class="fw-bold text-muted small">1 dari 3</span>
                    <button id="btn-next-kbli" class="btn btn-sm btn-outline-primary" type="button">
                        Selanjutnya <i class="bi bi-chevron-right"></i>
                    </button>
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
    series: [<?php echo $data['ikm_kecil'];?>, <?php echo $data['ikm_menengah'];?>, <?php echo $data['ikm_besar'];?>],
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
    series: [{ name: 'Jumlah IKM', data: [<?php echo $data['ikm_kecil'];?>, <?php echo $data['ikm_menengah'];?>, <?php echo $data['ikm_besar'];?>] }],
    chart: { type: 'bar', height: 280, toolbar: { show: false } },
    plotOptions: { bar: { horizontal: true, borderRadius: 6, dataLabels: { position: 'center' }, offsetY:45, offsetX: -15 } },
    dataLabels: { enabled: true, formatter: function (val) { return val; }, style: { colors: ['#ffffff'] }},
    colors: ['#0d6efd', '#198754', '#ffc107'],
    xaxis: { categories: ['Kecil', 'Menengah', 'Besar'] },
    tooltip: { y: { formatter: (val) => `${val} IKM` } }
  };
  new ApexCharts(document.querySelector('#jumlah-ikm-chart'), jumlahIkmOptions).render();


  // ==============================================================================
  // 1. AKUISISI & TRANSFORMASI DATA API (Data Mapping)
  // ==============================================================================
  // Mengambil string JSON yang didistribusikan oleh Controller PHP
  // Pastikan variabel $data['sebaran_kbli'] sudah melalui fungsi json_encode() di Controller
  const rawKbliData = <?php echo $data['kbli']; ?>;

  // Melakukan transformasi struktur dari format Database ke format ApexCharts
  const allKbliData = rawKbliData.map(item => ({
    // Menggabungkan ID dan Nama sebagai label kategori
    category: item.id_kbli + ' ' + item.nama_kbli, 
    // Memastikan kuantitas dibaca sebagai integer (bilangan bulat)
    value: parseInt(item.jml, 10) 
  }));

  // ==============================================================================
  // 2. LOGIKA MANAJEMEN DATA & PAGINASI CHART KBLI
  // ==============================================================================
  
  // Variabel state untuk menampung data yang sedang aktif
  let activeKbliData = [...allKbliData]; 
  
  let currentKbliPage = 1;
  const itemsPerKbliPage = 10; 
  // Kalkulasi total halaman secara dinamis berdasarkan panjang data API
  let totalKbliPages = Math.ceil(activeKbliData.length / itemsPerKbliPage);

  // Variabel state untuk melacak mode pengurutan saat ini 
  // (false = Mode Terbanyak/Bawaan, true = Mode Terkecil)
  let isAscending = false;

  // Fungsi untuk mengambil potongan data berdasarkan halaman aktif
  function getPaginatedKbliData(page) {
    const startIndex = (page - 1) * itemsPerKbliPage;
    const endIndex = startIndex + itemsPerKbliPage;
    
    // Menggunakan activeKbliData yang merepresentasikan state terkini
    const slicedData = activeKbliData.slice(startIndex, endIndex);

    return {
      seriesData: slicedData.map(item => item.value),
      categories: slicedData.map(item => item.category)
    };
  }

  // Inisialisasi state halaman pertama
  const initialKbliData = getPaginatedKbliData(currentKbliPage);

  // ==============================================================================
  // 3. KONFIGURASI & RENDERING APEXCHARTS
  // ==============================================================================
  const perJenisKbliOptions = {
    series: [{ name: 'Jumlah IKM', data: initialKbliData.seriesData }],
    chart: { type: 'bar', height: 400, toolbar: { show: false } },
    plotOptions: { 
      bar: { 
        horizontal: true, 
        borderRadius: 4,
        dataLabels: { position: 'top' }, 
      } 
    },
    colors: ['#198754'], // Representasi warna hijau (Success Bootstrap)
    dataLabels: { 
      enabled: true,
      offsetX: 25, 
      style: { colors: ['#333'], fontSize: '12px' } 
    },
    xaxis: { 
      categories: initialKbliData.categories,
      labels: { show: false }, 
      axisBorder: { show: false },
      axisTicks: { show: false }
    },
    yaxis: {
      labels: {
        style: { fontSize: '12px', fontWeight: 500 },
        maxWidth: 250 
      }
    },
    grid: { show: false }, 
    tooltip: { y: { formatter: (val) => `${val} IKM` } }
  };

  const kbliChart = new ApexCharts(document.querySelector('#per-jenis-kbli-chart'), perJenisKbliOptions);
  kbliChart.render();

  // ==============================================================================
  // 4. EVENT LISTENER: PAGINASI, SORTING (TOGGLE) & REFRESH
  // ==============================================================================
  const btnPrevKbli = document.getElementById('btn-prev-kbli');
  const btnNextKbli = document.getElementById('btn-next-kbli');
  const kbliPageInfo = document.getElementById('kbli-page-info');

  function updateKbliPaginationUI() {
    kbliPageInfo.innerText = `${currentKbliPage} dari ${totalKbliPages}`;
    btnPrevKbli.disabled = currentKbliPage === 1;
    btnNextKbli.disabled = currentKbliPage === totalKbliPages;
  }

  function updateKbliChart() {
    const newData = getPaginatedKbliData(currentKbliPage);
    kbliChart.updateSeries([{ data: newData.seriesData }]);
    kbliChart.updateOptions({ xaxis: { categories: newData.categories } });
    updateKbliPaginationUI();
  }

  // Event Navigasi Paginasi
  btnPrevKbli.addEventListener('click', () => {
    if (currentKbliPage > 1) {
      currentKbliPage--;
      updateKbliChart();
    }
  });

  btnNextKbli.addEventListener('click', () => {
    if (currentKbliPage < totalKbliPages) {
      currentKbliPage++;
      updateKbliChart();
    }
  });

  // Event: Pengurutan Dinamis (Ascending / Descending)
  document.getElementById('btn-sort-kbli').addEventListener('click', function() {
    const iconSort = this.querySelector('i');

    if (!isAscending) {
      // Ascending (Terkecil ke Terbesar)
      activeKbliData = [...allKbliData].sort((a, b) => a.value - b.value);
      
      if (iconSort) {
        iconSort.classList.remove('bi-sort-down');
        iconSort.classList.add('bi-sort-up');
      }
      isAscending = true; 
    } else {
      // Descending (Terbesar ke Terkecil)
      activeKbliData = [...allKbliData].sort((a, b) => b.value - a.value);
      
      if (iconSort) {
        iconSort.classList.remove('bi-sort-up');
        iconSort.classList.add('bi-sort-down');
      }
      isAscending = false; 
    }

    currentKbliPage = 1; 
    updateKbliChart();
  });

  // Event: Restorasi ke Susunan Default Basis Data
  document.getElementById('btn-reset-kbli').addEventListener('click', () => {
    // Merestorasi data ke struktur aslinya
    activeKbliData = [...allKbliData];
    
    isAscending = false;
    const iconSort = document.querySelector('#btn-sort-kbli i');
    if (iconSort) {
      iconSort.classList.remove('bi-sort-up');
      iconSort.classList.add('bi-sort-down');
    }

    currentKbliPage = 1; 
    updateKbliChart();
  });

  // Inisialisasi User Interface pada saat pemuatan pertama (onload)
  updateKbliPaginationUI();
</script>
<?php
$extra_scripts = ob_get_clean();
?>