<div class="container mt-4">
    <h3>Daftar Toko Saya</h3>

    <a href="<?= site_url('toko/tambah'); ?>" class="btn btn-primary mb-3">+ Tambah Toko Baru</a>

    <?php if (!empty($toko)) : ?>
        <div class="row">
            <?php foreach ($toko as $t) : ?>
                <div class="mb-4 position-relative">
                    <div class="card shadow-lg">
                        <div class="card-body">
                            <h4 class="fw-bold text-center">Manage Toko</h4>
                            <table class="table table-bordered">
                                <thead class="table-primary text-center">
                                    <tr>
                                        <th>Logo</th>
                                        <th>Nama Toko</th>
                                        <th>Deskripsi</th>
                                        <th>status</th>
                                        <td>Alamat</td>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="text-justify">
                                        <tr>
                                            <td><img src="<?= base_url('uploads/toko/' . $t['foto_toko']) ?>" class="card-img-top" alt="Foto Toko" style="width : 50px; height: 50px; object-fit: cover;"></td>
                                            <td class="text-justify"><?= $t['nama_toko']; ?></td>
                                            <td class="text-justify"><?= $t['deskripsi']; ?></td>
                                            <td class="text-justify"><?= $t['status']; ?></td>
                                            <td class="text-justify"><?= $t['alamat_toko']; ?></td>
                                            <td class="text-center">
                                                <a href="<?= site_url('toko/edit/' . $t['id_toko']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                                <a href="<?= site_url('toko/produk/' . $t['id_toko']); ?>" class="btn btn-success btn-sm">Lihat Produk</a>
                                                <a href="<?= site_url('penjualan/index/' . $t['id_toko']); ?>" class="btn btn-primary btn-sm">History Penjualan</a>
                                                <a href="<?= site_url('toko/hapus/' . $t['id_toko']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else : ?>
        <div class="alert alert-info">Anda belum memiliki toko.</div>
    <?php endif; ?>
</div>