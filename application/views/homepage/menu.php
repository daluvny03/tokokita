<!-- Header / Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top mp-navbar" id="mainNavbar">
    <div class="container">
        <a class="navbar-brand mp-brand" href="<?= base_url(); ?>">
            <span class="mp-brand-icon">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 7h12l1.5 13.5a1 1 0 01-1 1.1H5.5a1 1 0 01-1-1.1L6 7z" stroke="white" stroke-width="1.8" stroke-linejoin="round"/>
                    <path d="M9 7a3 3 0 016 0" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
                </svg>
            </span>
            <span class="mp-brand-text">Marketplace</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu kiri -->
            <ul class="navbar-nav me-auto mp-nav-left">
                <li class="nav-item"><a class="nav-link" href="<?= base_url('index.php/home'); ?>">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Cara Beli</a></li>
                <li class="nav-item"><a class="nav-link" href="<?= site_url('history') ?>">History</a></li>
            </ul>

            <!-- Form search -->
            <form class="mp-search d-flex me-3" action="<?= base_url('produk/cari'); ?>" method="get">
                <select name="kategori" class="mp-search-category">
                    <option value="">Kategori</option>
                    <?php foreach ($kategori as $k) : ?>
                        <option value="<?= $k['nama_kategori']; ?>"><?= $k['nama_kategori']; ?></option>
                    <?php endforeach; ?>
                </select>
                <span class="mp-search-divider"></span>
                <input class="mp-search-input" type="search" name="q" placeholder="Cari produk impianmu...">
                <button class="mp-search-btn" type="submit" aria-label="Cari">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="11" cy="11" r="7" stroke="white" stroke-width="2"/>
                        <path d="M21 21l-4.3-4.3" stroke="white" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                </button>
            </form>

            <!-- Menu kanan -->
            <ul class="navbar-nav mp-nav-right align-items-center">
                <?php $pembeli_id = $this->session->userdata('pembeli_id'); ?>

                <?php if ($pembeli_id): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= site_url('toko'); ?>">Toko</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mp-cart-link" href="<?= base_url('index.php/cart'); ?>">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M6 7h12l1.5 13.5a1 1 0 01-1 1.1H5.5a1 1 0 01-1-1.1L6 7z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                                <path d="M9 7a3 3 0 016 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            </svg>
                            Cart
                            <?php if (!empty($jumlah_cart)): ?>
                                <span class="mp-cart-badge"><?= $jumlah_cart; ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="mp-btn-outline" href="<?= site_url('auth/logout'); ?>">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item ms-2">
                        <a class="mp-btn-primary" href="<?= site_url('auth/login'); ?>">Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<script>
window.addEventListener('scroll', function () {
    document.getElementById('mainNavbar').classList.toggle('scrolled', window.scrollY > 10);
});
</script>