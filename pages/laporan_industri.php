<?php
$url="http://192.168.34.169/satukan.jiwa/sesuk/index.php/api_dashboard";
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

  // ==============================================================================
  // DATA DUMMY 28 JENIS KBLI (Sesuai Gambar 1)
  // ==============================================================================
  const allKbliData = [
    { category: '10 Industri Makanan', value: 350 },
    { category: '11 Industri Minuman', value: 210 },
    { category: '12 Industri Pengolahan Tembakau', value: 45 },
    { category: '13 Industri Tekstil', value: 180 },
    { category: '14 Industri Pakaian Jadi', value: 420 },
    { category: '15 Industri Kulit & Alas Kaki', value: 150 },
    { category: '16 Industri Kayu & Barang dari Kayu', value: 200 },
    { category: '17 Industri Kertas', value: 85 },
    { category: '18 Industri Pencetakan', value: 110 },
    { category: '19 Industri Produk Batubara & Pengilangan', value: 30 },
    { category: '20 Industri Bahan Kimia', value: 140 },
    { category: '21 Industri Farmasi & Obat', value: 95 },
    { category: '22 Industri Karet & Plastik', value: 175 },
    { category: '23 Industri Barang Galian Bukan Logam', value: 220 },
    { category: '24 Industri Logam Dasar', value: 65 },
    { category: '25 Industri Barang Logam', value: 130 },
    { category: '26 Industri Komputer & Elektronik', value: 80 },
    { category: '27 Industri Peralatan Listrik', value: 90 },
    { category: '28 Industri Mesin & Perlengkapan', value: 105 },
    { category: '29 Industri Kendaraan Bermotor', value: 55 },
    { category: '30 Industri Alat Angkut Lainnya', value: 40 },
    { category: '31 Industri Furnitur', value: 280 },
    { category: '32 Industri Pengolahan Lainnya', value: 160 },
    { category: '33 Jasa Reparasi & Pemasangan Mesin', value: 125 },
    { category: 'KBLI Tambahan 25', value: 50 },
    { category: 'KBLI Tambahan 26', value: 45 },
    { category: 'KBLI Tambahan 27', value: 35 },
    { category: 'KBLI Tambahan 28', value: 20 }
  ];

  // ==============================================================================
  // LOGIKA MANAJEMEN DATA & PAGINASI CHART KBLI
  // ==============================================================================
  
  // Variabel untuk menampung data yang sedang aktif (bisa diurutkan atau bawaan)
  let activeKbliData = [...allKbliData]; 
  
  let currentKbliPage = 1;
  const itemsPerKbliPage = 10; 
  let totalKbliPages = Math.ceil(activeKbliData.length / itemsPerKbliPage);

  // Variabel state untuk melacak mode pengurutan saat ini 
  // (false = Mode Terbanyak/Bawaan, true = Mode Terkecil)
  let isAscending = false;

  // Fungsi untuk mengambil potongan data berdasarkan halaman aktif
  function getPaginatedKbliData(page) {
    const startIndex = (page - 1) * itemsPerKbliPage;
    const endIndex = startIndex + itemsPerKbliPage;
    // Menggunakan activeKbliData yang sudah disalin, bukan allKbliData
    const slicedData = activeKbliData.slice(startIndex, endIndex);

    return {
      seriesData: slicedData.map(item => item.value),
      categories: slicedData.map(item => item.category)
    };
  }

  // Inisialisasi Data Halaman Pertama
  const initialKbliData = getPaginatedKbliData(currentKbliPage);

  // Konfigurasi ApexCharts Horizontal
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
    colors: ['#198754'], // Warna diubah menjadi hijau (Success Bootstrap)
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
  // EVENT LISTENER: PAGINASI, SORTING (TOGGLE) & REFRESH
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

  // Event: Urutkan dengan sistem Toggle (Terbanyak <-> Terkecil)
  // Memastikan ID yang dipanggil adalah 'btn-sort-kbli'
  document.getElementById('btn-sort-kbli').addEventListener('click', function() {
    // Mencari elemen ikon <i> di dalam tombol ini
    const iconSort = this.querySelector('i');

    if (!isAscending) {
      // Aksi 1: Urutkan dari Terkecil ke Terbesar (Ascending)
      activeKbliData = [...allKbliData].sort((a, b) => a.value - b.value);
      
      // Ubah ikon panah menjadi menghadap ke atas
      if (iconSort) {
        iconSort.classList.remove('bi-sort-down');
        iconSort.classList.add('bi-sort-up');
      }
      isAscending = true; // Perbarui status ke Ascending
    } else {
      // Aksi 2: Urutkan dari Terbesar ke Terkecil (Descending)
      activeKbliData = [...allKbliData].sort((a, b) => b.value - a.value);
      
      // Ubah ikon panah kembali menghadap ke bawah
      if (iconSort) {
        iconSort.classList.remove('bi-sort-up');
        iconSort.classList.add('bi-sort-down');
      }
      isAscending = false; // Perbarui status ke Descending
    }

    currentKbliPage = 1; // Memaksa kembali ke halaman 1 setelah diurutkan
    updateKbliChart();
  });

  // Event: Refresh / Kembalikan ke Susunan Awal
  document.getElementById('btn-reset-kbli').addEventListener('click', () => {
    // 1. Mengembalikan data aktif menjadi salinan data asli
    activeKbliData = [...allKbliData];
    
    // 2. Kembalikan status variabel dan mereset ikon ke kondisi semula
    isAscending = false;
    const iconSort = document.querySelector('#btn-sort-kbli i');
    if (iconSort) {
      iconSort.classList.remove('bi-sort-up');
      iconSort.classList.add('bi-sort-down');
    }

    // 3. Render ulang dari halaman pertama
    currentKbliPage = 1; 
    updateKbliChart();
  });

  // Panggil sekali saat halaman dimuat untuk mengatur status awal tombol
  updateKbliPaginationUI();
</script>
<?php
$extra_scripts = ob_get_clean();
?>