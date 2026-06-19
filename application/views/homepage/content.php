<!-- Slider -->
<div id="promoCarousel" class="carousel slide mt-3 container" data-bs-ride="carousel" data-bs-interval="3000">
  <div class="carousel-inner">
    <?php if (!empty($promo)) : ?>
      <?php foreach ($promo as $index => $p) : ?>
        <div class="carousel-item <?= ($index === 0) ? 'active' : ''; ?>">
          <a href="<?= $p->link ?>" target="_blank">
            <img src="<?= base_url('uploads/promo/' . $p->poster); ?>" 
                 class="d-block w-100 rounded" 
                 style="height: 400px; object-fit: cover;" 
                 alt="<?= $p->nama_promo; ?>">
          </a>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <div class="carousel-item active">
        <img src="https://via.placeholder.com/1200x400" class="d-block w-100 rounded" alt="Default Promo">
      </div>
    <?php endif; ?>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon"></span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon"></span>
  </button>
</div>


<!-- Konten Utama -->
<div class="container mt-4">
  <div class="row">
   <!-- Sidebar Kategori -->
<div class="col-md-3">
  <div class="sidebar mb-3">
    <h5>Kategori</h5>
    <?php if (!empty($kategori)) : ?>
      <?php foreach ($kategori as $k) : ?>
        <a href="<?= site_url('admin/produk/kategori/' . $k['id']); ?>">
          <?= $k['nama_kategori']; ?>
        </a>
      <?php endforeach; ?>
    <?php else : ?>
      <p class="text-muted">Belum ada kategori tersedia.</p>
    <?php endif; ?>
  </div>
  <div class="sidebar">
    <h5>Merek</h5>
    <?php if (!empty($merek)) : ?>
      <?php foreach ($merek as $m) : ?>
        <a href="">
          <?= $m['nama_merek']; ?>
        </a>
      <?php endforeach; ?>
    <?php else : ?>
      <p class="text-muted">Belum ada merek tersedia.</p>
    <?php endif; ?>
  </div>
</div>


    <!-- Produk -->
    <div class="col-md-9">
      <h5 class="mb-3">Produk Tersedia</h5>
      <div class="row">
      <?php if (!empty($produk)) : ?>
  <?php foreach ($produk as $p) : ?>
    <div class="col-md-4 mb-4 mt-3">
      <div class="position-relative h-100">
        <!-- Card sebagai link -->
        <a href="<?= site_url('home/detail/' . $p['id']); ?>" class="text-decoration-none text-dark d-block h-100">
          <div class="card product-card h-100">
            <img src="<?= base_url('uploads/' . $p['foto']); ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?= $p['nama_produk']; ?>">
            <div class="card-body">
              <h6 class="card-title"><?= $p['nama_produk']; ?></h6>
              <p class="text-danger">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></p>
              <div class="btn btn-success btn-sm disabled">Beli</div>
            </div>
          </div>
        </a>
        <!-- Tombol Tambah ke Cart -->
        <div class="mb-4">
          <a href="<?= site_url('Cart/add/' . $p['id']); ?>" class="btn btn-sm btn-outline-primary w-100">
            🛒 Tambah ke Cart
          </a>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
<?php else : ?>
  <p class="text-muted">Belum ada produk tersedia.</p>
<?php endif; ?>

      </div>
    </div>
  </div>
</div>
