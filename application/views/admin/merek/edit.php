<div class="card">
    <div class="card-body">
        <h4>Edit merek</h4>
        <form action="<?= site_url('admin/merek/update/'.$merek['id']); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_merek" class="form-label">Nama merek</label>
                <input type="text" class="form-control" id="nama_merek" name="nama_merek" value="<?= $merek['nama_merek']; ?>" required>
            </div>
            <div class="mb-3">
            <label>Foto Toko Saat Ini</label><br>
            <?php if (!empty($merek['logo'])): ?>
                <img src="<?= base_url('uploads/'.$merek['logo']) ?>" width="150" class="img-thumbnail mb-2">
            <?php endif; ?>
            <input type="file" name="logo" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
        </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="<?= site_url('admin/merek'); ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
