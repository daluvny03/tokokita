<div class="container mt-4">
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
    <?php endif; ?>

    <div class="card shadow">
        <div class="card-body">
            <h4 class="fw-bold text-center">Daftar Produk</h4>
            <a href="<?= site_url('admin/produk/create'); ?>" class="btn btn-primary mb-3">Tambah Produk</a>
            <table class="table table-bordered table-striped">
                <thead class="table-primary text-center">
                    <thead class="table-primary text-center">
                        <tr>
                            <th>ID</th>
                            <th>Gambar</th> <!-- Tambahan -->
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>

                </thead>
                <tbody>
                    <?php foreach ($produk as $p): ?>
                        <tr>
                            <td><?= $p['id']; ?></td>
                            <td class="text-center">
                                <?php if ($p['foto']): ?>
                                    <img src="<?= base_url('uploads/' . $p['foto']); ?>" alt="Foto Produk" width="80">
                                <?php else: ?>
                                    <span class="text-muted">Tidak ada gambar</span>
                                <?php endif; ?>
                            </td>
                            <td><?= $p['nama_produk']; ?></td>
                            <td>Rp<?= number_format($p['harga']); ?></td>
                            <td><?= $p['stok']; ?></td>
                            <td><?= ucfirst($p['status']); ?></td>
                            <td class="text-center">
                                <a href="<?= site_url('admin/produk/edit/' . $p['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                <a href="<?= site_url('admin/produk/delete/' . $p['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus produk ini?')">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>

            </table>
        </div>
    </div>
</div>