<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Marketplace</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f5f5f5; }
        .login-box {
            max-width: 500px;
            margin: 80px auto;
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
    <div class="login-box">
        <h4 class="text-center mb-4">Login Pembeli</h4>

        <?php if ($this->session->flashdata('error')): ?>
            <div class="alert alert-danger"><?= $this->session->flashdata('error') ?></div>
        <?php endif; ?>
        <?php if ($this->session->flashdata('success')): ?>
            <div class="alert alert-success"><?= $this->session->flashdata('success') ?></div>
        <?php endif; ?>

        <form action="<?= site_url('auth/login') ?>" method="post">
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-green w-100">Login</button>
        </form>

        <p class="text-center mt-3">Belum punya akun? <a href="<?= site_url('auth/register') ?>">Daftar di sini</a></p>
    </div>
</div>
</body>
</html>
