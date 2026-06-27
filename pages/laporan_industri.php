<?php
// Asumsikan URL API untuk laporan industri. Ganti jika perlu.
$api_url = "http://192.168.34.169/dbes-ikm/api_dashboard.php"; // Ganti dengan URL API yang benar
$result = get_data_with_cache($koneksi_utama, $api_url, 'laporan_industri_data');

$data = $result['data'];
$is_offline = $result['source'] === 'cache';
$last_updated = $result['last_updated'] ? date('d M Y, H:i', strtotime($result['last_updated'])) : 'N/A';

// Memberikan nilai default untuk mencegah error
$total_industri = $data['total_industri'] ?? 0;
$industri_aktif = $data['industri_aktif'] ?? 0;
$industri_tidak_aktif = $data['industri_tidak_aktif'] ?? 0;
$tabel_laporan = $data['tabel_laporan'] ?? [];
?>
<main class="app-main">
  <div class="app-content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h3 class="mb-0 fw-bold">Laporan Industri</h3>
        </div>
        <div class="col-sm-6 d-flex align-items-center justify-content-end">
          <?php if ($is_offline): ?>
          <span class="badge text-bg-warning me-2" data-bs-toggle="tooltip" title="Menampilkan data offline yang tersimpan.">
            <i class="bi bi-wifi-off"></i> OFFLINE
          </span>
          <?php endif; ?>
          <small class="text-muted">
            Update Terakhir: <?php echo $last_updated; ?>
          </small>
        </div>
      </div>
    </div>
  </div>

  <div class="app-content">
    <div class="container-fluid">
      <!-- Row 1: Statistik -->
      <div class="row g-3 mb-4">
        <!-- Kotak 1: Total Industri -->
        <div class="col-md-4">
          <div class="small-box text-bg-primary h-100 m-0 shadow-sm">
            <div class="inner">
              <h3 class="fw-bold"><?php echo number_format($total_industri, 0, ',', '.'); ?></h3>
              <p>Total Industri</p>
            </div>
            <i class="small-box-icon bi bi-building"></i>
          </div>
        </div>
        <!-- Kotak 2: Industri Aktif -->
        <div class="col-md-4">
          <div class="small-box text-bg-success h-100 m-0 shadow-sm">
            <div class="inner">
              <h3 class="fw-bold"><?php echo number_format($industri_aktif, 0, ',', '.'); ?></h3>
              <p>Industri Aktif</p>
            </div>
            <i class="small-box-icon bi bi-check-circle-fill"></i>
          </div>
        </div>
        <!-- Kotak 3: Industri Tidak Aktif -->
        <div class="col-md-4">
          <div class="small-box text-bg-danger h-100 m-0 shadow-sm">
            <div class="inner">
              <h3 class="fw-bold"><?php echo number_format($industri_tidak_aktif, 0, ',', '.'); ?></h3>
              <p>Industri Tidak Aktif</p>
            </div>
            <i class="small-box-icon bi bi-x-circle-fill"></i>
          </div>
        </div>
      </div>

      <!-- Row 2: Tabel Laporan -->
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h5 class="card-title fw-bold">Data Laporan Industri</h5>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table id="tabel-laporan-industri" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Industri</th>
                      <th>Jenis Usaha</th>
                      <th>Alamat</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if (empty($tabel_laporan)): ?>
                    <tr>
                      <td colspan="5" class="text-center">Data tidak tersedia.</td>
                    </tr>
                    <?php else: ?>
                    <?php foreach ($tabel_laporan as $index => $laporan): ?>
                    <tr>
                      <td><?php echo $index + 1; ?></td>
                      <td><?php echo htmlspecialchars($laporan['nama_industri']); ?></td>
                      <td><?php echo htmlspecialchars($laporan['jenis_usaha']); ?></td>
                      <td><?php echo htmlspecialchars($laporan['alamat']); ?></td>
                      <td>
                        <?php
                          $status = htmlspecialchars($laporan['status']);
                          $badge_class = $status == 'Aktif' ? 'bg-success' : 'bg-danger';
                          echo "<span class='badge {$badge_class}'>{$status}</span>";
                        ?>
                      </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
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