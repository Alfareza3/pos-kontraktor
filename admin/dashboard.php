<?php
session_start();
if (!isset($_SESSION['admin'])) {
  header("Location: login.php");
  exit;
}

require __DIR__ . '/../inc/koneksi.php';
require __DIR__ . '/header.php';
require __DIR__ . '/topbar.php';
require __DIR__ . '/sidebar.php';

$jumlah_proyek       = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM proyek"));
$jumlah_pekerja      = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM pekerja"));
$jumlah_bahan        = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM bahan"));
$jumlah_absensi      = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM absensi"));
$jumlah_pengeluaran  = mysqli_num_rows(mysqli_query($conn, "SELECT id FROM pengeluaran_lain"));
?>

<div class="flex-grow-1 p-4">
  <h4 class="mb-4">📊 <strong>Dashboard Admin</strong></h4>
  <div class="row g-4">

    <!-- CARD -->
    <?php
    $cards = [
      ['icon' => '🏗️', 'title' => 'Proyek', 'value' => $jumlah_proyek],
      ['icon' => '👷', 'title' => 'Pekerja', 'value' => $jumlah_pekerja],
      ['icon' => '🧱', 'title' => 'Bahan', 'value' => $jumlah_bahan],
      ['icon' => '🗓️', 'title' => 'Absensi', 'value' => $jumlah_absensi],
      ['icon' => '💸', 'title' => 'Pengeluaran lain-lain', 'value' => $jumlah_pengeluaran],
    ];

    foreach ($cards as $card) :
    ?>
      <div class="col-md-4">
        <div class="card shadow-sm border-0 bg-light h-100">
          <div class="card-body">
            <div class="d-flex align-items-center">
              <div class="me-3 fs-3"><?= $card['icon'] ?></div>
              <div>
                <h6 class="mb-1"><?= $card['title'] ?></h6>
                <p class="fs-5 fw-semibold mb-0"><?= $card['value'] ?> data</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <!-- Grafik -->
  <div class="mt-5">
    <h5 class="mb-3">📈 <strong>Visualisasi Data Statistik</strong></h5>
    <div class="row g-4">
      <div class="col-md-6">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h6 class="card-title">Bar Chart: Jumlah Data</h6>
            <canvas id="barChart" height="200"></canvas>
          </div>
        </div>
      </div>
      <div class="col-md-6">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <h6 class="card-title">Pie Chart: Komposisi Data</h6>
            <canvas id="pieChart" height="200"></canvas>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Tambahkan Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const dataLabels = ['Proyek', 'Pekerja', 'Bahan', 'Absensi', 'Pengeluaran lain-lain'];
  const dataValues = [
    <?= $jumlah_proyek ?>,
    <?= $jumlah_pekerja ?>,
    <?= $jumlah_bahan ?>,
    <?= $jumlah_absensi ?>,
    <?= $jumlah_pengeluaran ?>
  ];

  // Bar Chart
  const barCtx = document.getElementById('barChart').getContext('2d');
  new Chart(barCtx, {
    type: 'bar',
    data: {
      labels: dataLabels,
      datasets: [{
        label: 'Jumlah Data',
        data: dataValues,
        backgroundColor: [
          '#198754cc',
          '#0d6efdcc',
          '#ffc107cc',
          '#6f42c1cc',
          '#dc3545cc'
        ],
        borderColor: '#ffffff00',
        borderWidth: 1
      }]
    },
    options: {
      responsive: true,
      plugins: {
        tooltip: { enabled: true },
        legend: { display: false }
      },
      scales: {
        y: {
          beginAtZero: true,
          ticks: {
            precision: 0
          }
        }
      }
    }
  });

  // Pie Chart
  const pieCtx = document.getElementById('pieChart').getContext('2d');
  new Chart(pieCtx, {
    type: 'pie',
    data: {
      labels: dataLabels,
      datasets: [{
        label: 'Komposisi',
        data: dataValues,
        backgroundColor: [
          '#198754cc',
          '#0d6efdcc',
          '#ffc107cc',
          '#6f42c1cc',
          '#dc3545cc'
        ],
        borderColor: '#fff',
        borderWidth: 2
      }]
    },
    options: {
      responsive: true,
      plugins: {
        legend: {
          position: 'bottom'
        },
        tooltip: { enabled: true }
      }
    }
  });
</script>

<?php require __DIR__ . '/footer.php'; ?>
