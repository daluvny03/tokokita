<div class="card">
  <div class="card-body">
    <h4>Edit Pembeli</h4>
    <form action="<?= site_url('admin/pembeli/update/' . $pembeli['id']); ?>" method="post">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" value="<?= $pembeli['nama']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?= $pembeli['email']; ?>" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Kosongkan jika tidak ingin mengubah password">
        <small class="text-muted">Biarkan kosong jika tidak ingin mengubah password.</small>
      </div>
      <div class="mb-3">
        <label for="no_hp" class="form-label">No HP</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp" value="<?= $pembeli['no_hp']; ?>">
      </div>
      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3"><?= $pembeli['alamat']; ?></textarea>
      </div>
      <button type="submit" class="btn btn-success">Update</button>
      <a href="<?= site_url('admin/pembeli'); ?>" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>