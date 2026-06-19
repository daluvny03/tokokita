<div class="card">
    <div class="card-body">
        <h4>Edit Password</h4>
        <form action="<?= site_url('admin/profile/ganti_password') ?>" method="post">
            <div class="mb-3">
                <label for="password_lama" class="form-label">Password Lama</label>
                <input type="password" class="form-control" id="password_lama" name="password_lama" required>
            </div>
            <div class="mb-3">
                <label for="password_baru" class="form-label">Password Baru</label>
                <input type="password" class="form-control" id="password_baru" name="password_baru" required>
            </div>
            <div class="mb-3">
                <label for="konfirmasi_password" class="form-label">Konfirmasi Password Baru</label>
                <input type="password" class="form-control" id="konfirmasi_password" name="konfirmasi_password" required>
            </div>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Ganti Password</button>
                <a href="<?= site_url('admin/Profile/'); ?>"><button class="btn btn-secondary mx-2" type="button">Kembali</button></a>
            </div>
        </form>
    </div>
</div>