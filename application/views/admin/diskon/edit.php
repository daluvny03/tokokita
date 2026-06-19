<div class="container mt-4">
    <h4><?= isset($edit) ? 'Edit' : 'Tambah' ?> Diskon</h4>

    <form method="post">
        <div class="mb-3">
            <label>Produk</label>
            <select name="produk_id" class="form-select">
                <option value="">Semua Produk</option>
                <?php foreach ($produk as $p): ?>
                    <option value="<?= $p->id ?>" <?= ($diskon->produk_id ?? '') == $p->id ? 'selected' : '' ?>>
                        <?= $p->nama ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="mb-3">
            <label>Tipe Diskon</label>
            <select name="tipe" class="form-select" required>
                <option value="persen" <?= ($diskon->tipe ?? '') == 'persen' ? 'selected' : '' ?>>Persen</option>
                <option value="nominal" <?= ($diskon->tipe ?? '') == 'nominal' ? 'selected' : '' ?>>Nominal</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Nilai</label>
            <input type="number" name="nilai" class="form-control" value="<?= $diskon->nilai ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label>Mulai</label>
            <input type="date" name="mulai" class="form-control" value="<?= $diskon->mulai ?? '' ?>" required>
        </div>

        <div class="mb-3">
            <label>Selesai</label>
            <input type="date" name="selesai" class="form-control" value="<?= $diskon->selesai ?? '' ?>" required>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= site_url('admin/diskon') ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
