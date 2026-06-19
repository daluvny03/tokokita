<div class="card">
    <div class="card-body">
        <h4>Edit Profil</h4>
        <form action="<?= site_url('admin/profile/update/') ?>" method="post">
            <div class="mb-3">
                <label for="nama" class="form-label">Nama Lengkap</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?= $admin->nama; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?= $admin->email ?>" required>
            </div>
            <button type="submit" class="btn btn-success">Update</button>
            <a href="<?= site_url('admin/AdminDashboard'); ?>" class="btn btn-secondary">Kembali</a>
            <a href="<?= site_url('admin/profile/ganti'); ?>" class="btn btn-danger">Ganti Password</a>
        </form>
    </div>
</div>