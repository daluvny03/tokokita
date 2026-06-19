<form action="<?= site_url('admin/diskon/save') ?>" method="post">
    <div class="mb-3">
        <label for="produk_id" class="form-label">Produk</label>
        <select name="produk_id" id="produk_id" class="form-select">
            <option value="">Semua Produk</option>
            <?php foreach ($produk as $p): ?>
                <option value="<?= $p->id ?>"><?= $p->nama ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="mb-3">
        <label for="nama" class="form-label">nama</label>
        <input type="text" name="nama" id="nama" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="tipe" class="form-label">Tipe Diskon</label>
        <select name="tipe" id="tipe" class="form-select" required>
            <option value="persen">Persen (%)</option>
            <option value="nominal">Nominal (Rp)</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="nilai" class="form-label">Nilai Diskon</label>
        <input type="number" name="nilai" id="nilai" class="form-control" placeholder="Contoh: 10 untuk 10% atau 50000 untuk Rp50.000" required>
    </div>

    <div class="mb-3">
        <label for="mulai" class="form-label">Tanggal Mulai</label>
        <input type="date" name="mulai" id="mulai" class="form-control" required>
    </div>

    <div class="mb-3">
        <label for="selesai" class="form-label">Tanggal Selesai</label>
        <input type="date" name="selesai" id="selesai" class="form-control" required>
    </div>

    <button type="submit" class="btn btn-success">Simpan Diskon</button>
    <a href="<?= base_url('admin/diskon') ?>" class="btn btn-secondary">Kembali</a>
</form>
