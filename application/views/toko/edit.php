<div class="container mt-4">
    <h3>Edit Toko</h3>

    <?php echo form_open_multipart('toko/update', ['class' => 'needs-validation']); ?>
        <input type="hidden" name="id" value="<?= $toko['id_toko'] ?>">

        <div class="mb-3">
            <label>Nama Toko</label>
            <input type="text" name="nama_toko" class="form-control" value="<?= htmlspecialchars($toko['nama_toko']) ?>" required>
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"><?= htmlspecialchars($toko['deskripsi']) ?></textarea>
        </div>

        <div class="mb-3">
            <label>Alamat Toko</label>
            <textarea name="alamat_toko" class="form-control"><?= htmlspecialchars($toko['alamat_toko']) ?></textarea>
        </div>

        <div class="mb-3">
            <label>Foto Toko Saat Ini</label><br>
            <?php if (!empty($toko['foto_toko'])): ?>
                <img src="<?= base_url('uploads/toko/'.$toko['foto_toko']) ?>" width="150" class="img-thumbnail mb-2">
            <?php endif; ?>
            <input type="file" name="foto_toko" class="form-control">
            <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
        </div>

        <button type="submit" class="btn btn-success">Update Toko</button>
        <a href="<?= site_url('toko/hapus/'.$toko['id_toko']) ?>" class="btn btn-danger float-end" onclick="return confirm('Yakin hapus toko ini?')">Hapus</a>
    <?php echo form_close(); ?>
</div>