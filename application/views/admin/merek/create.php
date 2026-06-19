<div class="card">
    <div class="card-body">
        <h4>Tambah merek</h4>
        <form action="<?= site_url('admin/merek/store'); ?>" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="nama_merek" class="form-label">Nama merek</label>
                <input type="text" class="form-control" id="nama_merek" name="nama_merek" required>
            </div>
            <div class="mb-3">
            <label>logo merek</label>
            <input type="file" name="logo" class="form-control" accept="image/*">
        </div>
            <button type="submit" class="btn btn-success">Simpan</button>
            <a href="<?= base_url('merek'); ?>" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
