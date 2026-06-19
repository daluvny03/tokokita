<div class="container mt-4">
  <h4 class="mb-4">Produk Berdasarkan Kategori: <?= $kategori['nama_kategori']; ?></h4>

  <div class="row">
    <?php if (!empty($produk)) : ?>
      <?php foreach ($produk as $p) : ?>
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            <img src="<?= base_url('uploads/' . $p['foto']); ?>" class="card-img-top" style="height: 200px; object-fit: cover;" alt="<?= $p['nama_produk']; ?>">
            <div class="card-body">
              <h5 class="card-title"><?= $p['nama_produk']; ?></h5>
              <p class="card-text text-danger">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></p>
              <a href="#" class="btn btn-primary btn-sm">Lihat Detail</a>
            </div>
            <a href="<?= site_url('cart/tambah/' . $p['id']); ?>" class="btn btn-sm btn-outline-primary">
    🛒 Tambah ke Cart
</a>

          </div>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <p class="text-muted">Tidak ada produk dalam kategori ini.</p>
    <?php endif; ?>
  </div>
</div>
