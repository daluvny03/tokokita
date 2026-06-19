<div class="card">
  <div class="card-body">
    <h4>Tambah Pembeli</h4>
    <form action="<?= site_url('admin/pembeli/store'); ?>" method="post">
      <div class="mb-3">
        <label for="nama" class="form-label">Nama</label>
        <input type="text" class="form-control" id="nama" name="nama" required>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="mb-3">
        <label for="no_hp" class="form-label">No HP</label>
        <input type="text" class="form-control" id="no_hp" name="no_hp">
      </div>
      <div class="mb-3">
        <label for="alamat" class="form-label">Alamat</label>
        <textarea class="form-control" id="alamat" name="alamat" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-success">Simpan</button>
      <a href="<?= site_url('admin/pembeli'); ?>" class="btn btn-secondary">Kembali</a>
    </form>
  </div>
</div>