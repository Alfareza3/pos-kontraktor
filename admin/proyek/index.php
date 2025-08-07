<?php
require __DIR__ . '/../header.php';
require __DIR__ . '/../topbar.php';
require __DIR__ . '/../sidebar.php';
require __DIR__ . '/../../inc/koneksi.php';

// Proses pencarian
$cari = isset($_GET['cari']) ? mysqli_real_escape_string($conn, $_GET['cari']) : '';
if ($cari) {
  $proyek = mysqli_query($conn, "SELECT * FROM proyek 
    WHERE nama_proyek LIKE '%$cari%' 
       OR lokasi LIKE '%$cari%' 
       OR klien LIKE '%$cari%' 
    ORDER BY id DESC");
} else {
  $proyek = mysqli_query($conn, "SELECT * FROM proyek ORDER BY id DESC");
}
?>

<div class="p-4 flex-grow-1">
  <div class="card shadow-sm">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="mb-0">📋 Data Proyek</h4>
        <a href="tambah.php" class="btn btn-success">➕ Tambah Proyek</a>
      </div>

      <!-- Form Pencarian -->
      <form method="GET" class="mb-3">
        <div class="input-group">
          <input type="text" name="cari" class="form-control" placeholder="Cari proyek berdasarkan nama, lokasi, atau klien..." value="<?= htmlspecialchars($cari) ?>">
          <button class="btn btn-outline-success" type="submit">🔍 Cari</button>
          <?php if ($cari) : ?>
            <a href="index.php" class="btn btn-outline-secondary">🔁 Reset</a>
          <?php endif; ?>
        </div>
      </form>

      <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
          <thead class="table-light">
            <tr>
              <th>Nama Proyek</th>
              <th>Lokasi</th>
              <th>Klien</th>
              <th>Mulai</th>
              <th>Selesai</th>
              <th>Status</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($proyek) > 0) : ?>
              <?php while ($row = mysqli_fetch_assoc($proyek)) : ?>
                <tr>
                  <td><?= htmlspecialchars($row['nama_proyek']) ?></td>
                  <td><?= htmlspecialchars($row['lokasi']) ?></td>
                  <td><?= htmlspecialchars($row['klien']) ?></td>
                  <td><?= htmlspecialchars($row['tanggal_mulai']) ?></td>
                  <td><?= htmlspecialchars($row['tanggal_selesai']) ?></td>
                  <td>
                    <?php
                      $status = htmlspecialchars($row['status']);
                      $badge = 'secondary';
                      if ($status == 'Berjalan') $badge = 'warning';
                      elseif ($status == 'Selesai') $badge = 'success';
                      elseif ($status == 'Tertunda') $badge = 'danger';
                    ?>
                    <span class="badge bg-<?= $badge ?>"><?= $status ?></span>
                  </td>
                  <td>
                    <a href="edit.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-warning">✏️ Edit</a>
                    <a href="hapus.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus?')">🗑️ Hapus</a>
                  </td>
                </tr>
              <?php endwhile; ?>
            <?php else : ?>
              <tr>
                <td colspan="7" class="text-center text-muted">Data tidak ditemukan.</td>
              </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

<?php include '../footer.php'; ?>
