<!-- Header / Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="<?= base_url(); ?>">Marketplace</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu kiri -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link" href="<?= base_url('index.php/home'); ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Cara Beli</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('history') ?>">History</a></li>
            </ul>

            <!-- Form search -->
            <form class="d-flex search-bar me-3" action="<?= base_url('produk/cari'); ?>" method="get">
                <select name="kategori" class="form-select me-2">
                    <option value="">Kategori</option>
                    <?php foreach ($kategori as $k) : ?>
                        <option value="<?= $k['nama_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                    <!-- Tambah kategori dinamis di sini -->
                </select>
                <input class="form-control" type="search" name="q" placeholder="Cari produk...">
                <button class="btn btn-primary ms-2" type="submit">Cari</button>
            </form>

            <!-- Menu kanan -->
            <ul class="navbar-nav">
                <?php $pembeli_id = $this->session->userdata('pembeli_id'); ?>

                <?php if ($pembeli_id): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('toko'); ?>">Toko</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url('index.php/cart'); ?>">
                            🛒 Cart
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('auth/logout'); ?>">🚪 Logout</a></li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="<?= site_url('auth/login'); ?>">🔑 Login</a></li>
                <?php endif; ?>
            </ul>

        </div>
    </div>
</nav>