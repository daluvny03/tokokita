<div class="container-fluid mt-3">
  <!-- Notifikasi Flashdata -->
  <?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?= $this->session->flashdata('success'); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <?php if ($this->session->flashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <?= $this->session->flashdata('error'); ?>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  <?php endif; ?>

  <div class="card shadow-lg">
    <div class="card-body">
      <h4 class="fw-bold text-center">Manage Pembeli</h4>
      <div class="table-responsive">
        <table class="table table-bordered">
          <thead class="table-primary text-center">
            <tr>
              <th>ID</th>
              <th>Nama</th>
              <th>Email</th>
              <th>No HP</th>
              <th>Alamat</th>
              <th>Tgl Daftar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody class="text-justify">
            <?php foreach ($pembeli as $p) : ?>
              <tr>
                <td class="text-center"><?= $p['id']; ?></td>
                <td><?= $p['nama_pembeli']; ?></td>
                <td><?= $p['email']; ?></td>
                <td><?= $p['no_hp']; ?></td>
                <td><?= $p['alamat']; ?></td>
                <td><?= date('d/m/Y', strtotime($p['created_at'])); ?></td>
                <td class="text-center">
                  <a href="<?= site_url('admin/pembeli/edit/' . $p['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                  <a href="<?= site_url('admin/pembeli/delete/' . $p['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>