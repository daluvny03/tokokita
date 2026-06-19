<div class="container mt-4">
    <h3>Buat Toko Baru</h3>
    <form action="<?= site_url('toko/simpan'); ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label>Nama Toko</label>
            <input type="text" name="nama_toko" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Alamat Toko</label>
            <textarea name="alamat_toko" class="form-control"></textarea>
        </div>
        <div class="mb-3">
            <label>Kode Pos Toko</label>
            <input type="text" name="kodepos" class="form-control" required>
        </div>
        <!-- TAMBAHAN FIELD FOTO -->
        <div class="mb-3">
            <label>Foto Toko</label>
            <input type="file" name="foto_toko" class="form-control" accept="image/*">
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>