<!-- application/views/homepage/detail_produk.php -->
<div class="container mt-4">
  <div class="row">
    <div class="col-md-5">
      <img src="<?= base_url('uploads/' . $produk['foto']); ?>" class="img-fluid rounded" alt="<?= $produk['nama_produk']; ?>" style="object-fit: cover;">
    </div>
    <div class="col-md-7">
      <h3><?= $produk['nama_produk']; ?></h3>
      <h4 class="text-danger">Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></h4>
      <p><strong>Stok:</strong> <?= $produk['stok']; ?></p>
      <p><strong>Deskripsi:</strong><br><?= nl2br($produk['deskripsi']); ?></p>
      <a href="<?= site_url('cart/add/' . $produk['id']); ?>" class="btn btn-primary">
        🛒 Tambah ke Cart
      </a>
      <hr>
      <h5 class="mt-4">❓ Tanya Produk</h5>
      <?php if ($this->session->flashdata('pesan')): ?> <div class="alert alert-success text-center"><?= $this->session->flashdata('pesan') ?></div> <?php endif; ?>

      <?php if ($this->session->userdata('pembeli_id')): ?>
        <form action="<?= site_url('admin/Produk/tanya') ?>" method="post">
          <input type="hidden" name="produk_id" value="<?= $produk['id'] ?>">
          <div class="mb-2">
            <textarea name="isi_pertanyaan" class="form-control" rows="3" placeholder="Tulis pertanyaan Anda tentang produk ini..." required></textarea>
          </div>
          <button type="submit" class="btn btn-outline-primary btn-sm">Kirim Pertanyaan</button>
        </form>
      <?php else: ?>
        <p><a href="<?= site_url('auth/login') ?>">Login</a> untuk bertanya tentang produk ini.</p>
      <?php endif; ?>
      <h5 class="mt-4">Pertanyaan Produk</h5>
      <div class="list-group">
        <?php foreach ($pertanyaan as $p): ?>
          <div class="list-group-item">
            <strong><?= $p->pembeli_nama ?>:</strong> <?= $p->isi_pertanyaan ?>
            <br>
            <small class="text-muted"><?= date('d M Y H:i', strtotime($p->tanggal_dibuat)) ?></small>

            <?php if (!empty($p->jawaban)): ?>
              <div class="mt-2 ps-3 border-start border-success">
                <strong class="text-success">Penjual:</strong> <?= $p->jawaban ?>
                <br>
                <small class="text-muted"><?= date('d M Y H:i', strtotime($p->tanggal_jawaban)) ?></small>
              </div>
            <?php else: ?>
              <?php if ($this->session->userdata('role') === 'penjual'): ?>
                <form method="post" action="<?= base_url('produk/jawab/' . $p->id) ?>" class="mt-2">
                  <div class="input-group">
                    <input type="text" name="jawaban" class="form-control" placeholder="Tulis jawaban..." required>
                    <button class="btn btn-primary btn-sm" type="submit">Jawab</button>
                  </div>
                </form>
              <?php endif; ?>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>


    </div>
  </div>
</div>