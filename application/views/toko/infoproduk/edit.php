<div class="container mt-4">
    <div class="card shadow">
        <div class="card-body">
            <h4 class="fw-bold text-center">Edit Produk</h4>

            <?php if ($this->session->flashdata('error')): ?>
                <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
            <?php endif; ?>

            <form action="" method="post" enctype="multipart/form-data">

                <!-- Kategori Produk -->
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select name="kategori_id" id="kategori_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k['id']; ?>" <?= $k['id'] == $produk['kategori_id'] ? 'selected' : ''; ?>>
                                <?= $k['nama_kategori']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="nama_produk" class="form-label">Nama Produk</label>
                    <input type="text" name="nama_produk" id="nama_produk" class="form-control" value="<?= set_value('nama_produk', $produk['nama_produk']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" rows="4"><?= set_value('deskripsi', $produk['deskripsi']); ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" value="<?= set_value('harga', $produk['harga']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="number" name="stok" id="stok" class="form-control" value="<?= set_value('stok', $produk['stok']); ?>" required>
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="tersedia" <?= $produk['status'] == 'tersedia' ? 'selected' : ''; ?>>Tersedia</option>
                        <option value="habis" <?= $produk['status'] == 'habis' ? 'selected' : ''; ?>>Habis</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="foto" class="form-label">Foto Produk</label>
                    <?php if ($produk['foto']): ?>
                        <div class="mb-2">
                            <img src="<?= base_url('uploads/' . $produk['foto']); ?>" alt="Foto Produk" width="120">
                        </div>
                    <?php endif; ?>
                    <input type="file" name="foto" id="foto" class="form-control">
                    <small class="text-muted">Biarkan kosong jika tidak ingin mengganti foto.</small>
                </div>

                <button type="submit" class="btn btn-success">Simpan Perubahan</button>
                <a href="<?= site_url('toko'); ?>" class="btn btn-secondary">Kembali</a>
            </form>
        </div>
    </div>
</div>