<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - Marketplace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f5f5; }
        .register-box {
            max-width: 500px;
            margin: 60px auto;
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.05);
        }
        .btn-green {
            background-color: #00a96e;
            color: #fff;
        }
        .btn-green:hover {
            background-color: #02885a;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="register-box">
        <h4 class="text-center mb-4">Daftar Akun Marketplace</h4>

        <!-- Alert jika ada error -->
        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= site_url('auth/register') ?>" method="post">
            <div class="mb-3">
                <label>Nama Lengkap</label>
                <input type="text" name="nama" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>No Hp</label>
                <input type="text" name="nohp" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Kode Pos</label>
                <input type="text" name="kodepos" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Konfirmasi Password</label>
                <input type="password" name="password2" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-green w-100">Daftar</button>
        </form>

        <p class="text-center mt-3">Sudah punya akun? <a href="<?= site_url('auth/login') ?>">Login di sini</a></p>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
