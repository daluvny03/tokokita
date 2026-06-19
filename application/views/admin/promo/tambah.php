<div class="container mt-4">
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
    <h4>Tambah Promo</h4>
    <form action="<?= site_url('admin/promo/simpan') ?>" method="post" enctype="multipart/form-data" class="row g-3">
        <div class="row mb-3">
            <label for="nama_promo" class="col-sm-2 col-form-label">Nama Promo</label>
            <div class="col-sm-10">
                <input type="text" name="nama_promo" id="nama_promo" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <label for="poster" class="col-sm-2 col-form-label">Poster</label>
            <div class="col-sm-10">
                <input type="file" name="poster" id="poster" class="form-control" required>
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-form-label">Status</label>
            <div class="col-sm-10 d-flex align-items-center">
                <div class="form-check me-3">
                    <input class="form-check-input" type="radio" name="status" id="aktif" value="aktif" checked>
                    <label class="form-check-label" for="aktif">Aktif</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="status" id="nonaktif" value="nonaktif">
                    <label class="form-check-label" for="nonaktif">Nonaktif</label>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <label for="link" class="col-sm-2 col-form-label">Link</label>
            <div class="col-sm-10">
                <input type="text" name="link" id="link" class="form-control">
            </div>
        </div>
        <div class="row mb-3">
            <div class="offset-sm-2 col-sm-10">
                <button type="submit" class="btn btn-success">Simpan</button>
            </div>
        </div>
    </form>
</div>
