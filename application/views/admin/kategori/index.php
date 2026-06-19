<div class="container-fluid mt-3">
    <!-- Notifikasi Flashdata -->
    <?php if ($this->session->flashdata('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('success'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if ($this->session->flashdata('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('error'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-lg">
        <div class="card-body">
            <h4 class="fw-bold text-center">Manage Kategori</h4>
            <a href="<?= site_url('admin/kategori/create'); ?>" class="btn btn-primary mb-3">Tambah Kategori</a>
            <table class="table table-bordered">
                <thead class="table-primary text-center">
                    <tr>
                        <th>ID</th>
                        <th>Nama Kategori</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-justify">
                    <?php foreach ($kategori as $k) : ?>
                    <tr>
                        <td class="text-center"><?= $k['id']; ?></td>
                        <td class="text-justify"><?= $k['nama_kategori']; ?></td>
                        <td class="text-center">
                            <a href="<?= site_url('admin/kategori/edit/'.$k['id']); ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="<?= site_url('admin/kategori/delete/'.$k['id']); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
