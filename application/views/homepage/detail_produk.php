<!-- application/views/homepage/detail_produk.php -->
<style>
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap');

:root{
    --mp-violet: #6D28D9;
    --mp-pink: #EC4899;
    --mp-amber: #F59E0B;
    --mp-ink: #1E1B2E;
    --mp-gray: #6B7280;
    --mp-border: #E5E7EB;
}

.mp-detail-page{
    font-family: 'Inter', sans-serif;
    position: relative;
    background: #FAFAFC;
    padding-top: 1.6rem;
}

/* Breadcrumb */
.mp-breadcrumb{
    font-size: 0.85rem;
    color: var(--mp-gray);
    margin-bottom: 1.2rem;
}
.mp-breadcrumb a{ color: var(--mp-gray); text-decoration: none; }
.mp-breadcrumb a:hover{ color: var(--mp-violet); }
.mp-breadcrumb .sep{ margin: 0 6px; color: #C9C5D6; }
.mp-breadcrumb .current{ color: var(--mp-ink); font-weight: 600; }

/* Gambar produk */
.mp-detail-img-wrap{
    border-radius: 18px;
    overflow: hidden;
    border: 1px solid var(--mp-border);
    background: #fff;
    box-shadow: 0 18px 44px -18px rgba(31,16,71,0.22);
    position: sticky;
    top: 90px;
}
.mp-detail-img{
    width: 100%;
    aspect-ratio: 1 / 1;
    object-fit: cover;
    display: block;
}

/* Judul & harga */
.mp-product-title{
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 1.55rem;
    color: var(--mp-ink);
    margin-bottom: 0.5rem;
    line-height: 1.3;
}
.mp-price-detail{
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 1.75rem;
    background: linear-gradient(135deg, var(--mp-violet), var(--mp-pink));
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    margin-bottom: 0.8rem;
    display: inline-block;
}

/* Badge stok */
.mp-stock-badge{
    display: inline-flex;
    align-items: center;
    gap: 5px;
    font-size: 0.78rem;
    font-weight: 600;
    padding: 0.32rem 0.9rem;
    border-radius: 999px;
    background: #ECFDF5;
    color: #047857;
    margin-bottom: 1.4rem;
}
.mp-stock-badge::before{
    content: "";
    width: 6px; height: 6px;
    border-radius: 50%;
    background: #10B981;
}
.mp-stock-badge.low{ background: #FEF3C7; color: #B45309; }
.mp-stock-badge.low::before{ background: #F59E0B; }
.mp-stock-badge.empty{ background: #FEE2E2; color: #B91C1C; }
.mp-stock-badge.empty::before{ background: #EF4444; }

/* Deskripsi */
.mp-desc-card{
    background: #fff;
    border: 1px solid var(--mp-border);
    border-radius: 16px;
    padding: 1.1rem 1.3rem;
    margin-bottom: 1.4rem;
}
.mp-desc-title{
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
    font-size: 0.92rem;
    color: var(--mp-ink);
    margin-bottom: 0.5rem;
}
.mp-desc-text{
    color: var(--mp-gray);
    font-size: 0.92rem;
    line-height: 1.7;
    margin: 0;
}

/* CTA */
.mp-cta-wrap{
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.3rem;
}
.mp-cta-price{ white-space: nowrap; }
.mp-cta-price small{ display:block; color: var(--mp-gray); font-size: 0.75rem; }
.mp-cta-price strong{
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    color: var(--mp-violet);
    font-size: 1.1rem;
}
.mp-btn-primary{
    background: linear-gradient(135deg, var(--mp-violet), var(--mp-pink));
    color: #fff !important;
    font-weight: 600;
    font-size: 0.92rem;
    padding: 0.65rem 1.4rem;
    border-radius: 999px;
    text-decoration: none;
    text-align: center;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    border: none;
    transition: transform .15s ease, box-shadow .15s ease;
    box-shadow: 0 10px 22px -8px rgba(109,40,217,0.45);
}
.mp-btn-primary:hover{ transform: translateY(-1px); color:#fff; }
.mp-cta-btn{ flex: 1; }

@media (max-width: 767px){
    .mp-cta-wrap{
        position: fixed;
        left: 0; right: 0; bottom: 0;
        background: #fff;
        padding: 0.8rem 1rem;
        box-shadow: 0 -10px 28px -14px rgba(31,16,71,0.3);
        z-index: 1030;
        margin-bottom: 0;
    }
    .mp-detail-page{ padding-bottom: 92px; }
    .mp-detail-img-wrap{ position: static; }
}

.mp-divider{
    border: none;
    border-top: 1px solid var(--mp-border);
    margin: 1.7rem 0;
}

/* Tanya Produk */
.mp-qna-title{
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 1.08rem;
    color: var(--mp-ink);
    margin-bottom: 1rem;
}
.mp-qna-form{
    background: #fff;
    border: 1px solid var(--mp-border);
    border-radius: 16px;
    padding: 1.1rem;
    margin-bottom: 1.5rem;
}
.mp-qna-form textarea.form-control{
    border-radius: 10px;
    border: 1.5px solid var(--mp-border);
    font-size: 0.9rem;
    resize: none;
}
.mp-qna-form textarea.form-control:focus{
    border-color: var(--mp-violet);
    box-shadow: 0 0 0 4px rgba(109,40,217,0.12);
}
.mp-login-hint{
    background: #F8F4FF;
    border: 1px dashed #D8C5FF;
    border-radius: 12px;
    padding: 0.85rem 1.1rem;
    color: var(--mp-gray);
    font-size: 0.9rem;
    margin-bottom: 1.5rem;
}
.mp-login-hint a{ color: var(--mp-violet); font-weight: 600; text-decoration: none; }
.mp-alert-success{
    background: #ECFDF5;
    color: #047857;
    border: 1px solid #A7F3D0;
    border-radius: 12px;
    font-size: 0.9rem;
}

.mp-qna-list{ display: flex; flex-direction: column; gap: 1rem; }
.mp-qna-empty{
    text-align: center;
    padding: 2rem 1rem;
    color: var(--mp-gray);
    background: #fff;
    border: 1px dashed var(--mp-border);
    border-radius: 16px;
    font-size: 0.9rem;
}
.mp-qna-item{
    background: #fff;
    border: 1px solid var(--mp-border);
    border-radius: 16px;
    padding: 1.1rem 1.2rem;
    transition: box-shadow .2s ease;
}
.mp-qna-item:hover{ box-shadow: 0 10px 24px -14px rgba(31,16,71,0.2); }
.mp-qna-head{ display: flex; gap: 12px; align-items: flex-start; }
.mp-avatar{
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--mp-violet), var(--mp-pink));
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.88rem;
    flex-shrink: 0;
}
.mp-qna-name{ font-weight: 600; color: var(--mp-ink); font-size: 0.9rem; }
.mp-qna-text{ color: var(--mp-ink); font-size: 0.9rem; margin: 2px 0 4px; }
.mp-qna-time{ font-size: 0.74rem; color: var(--mp-gray); }

.mp-answer-box{
    margin-top: 0.8rem;
    margin-left: 48px;
    padding: 0.8rem 1rem;
    background: #F8F4FF;
    border-left: 3px solid var(--mp-violet);
    border-radius: 10px;
}
.mp-answer-label{ color: var(--mp-violet); font-weight: 700; font-size: 0.8rem; }

.mp-answer-form{ margin-top: 0.8rem; margin-left: 48px; }
.mp-answer-form .form-control{
    border-radius: 999px 0 0 999px;
    border: 1.5px solid var(--mp-border);
    font-size: 0.9rem;
}
.mp-answer-form .form-control:focus{ border-color: var(--mp-violet); box-shadow: none; }
.mp-answer-form .btn{
    border-radius: 0 999px 999px 0 !important;
    background: linear-gradient(135deg, var(--mp-violet), var(--mp-pink));
    border: none;
}

@media (max-width: 575px){
    .mp-answer-box, .mp-answer-form{ margin-left: 0; }
}
</style>

<div class="container mp-detail-page mt-2 mb-5">

  <!-- Breadcrumb -->
  <nav class="mp-breadcrumb">
    <a href="<?= base_url('index.php/home'); ?>">Home</a>
    <span class="sep">/</span>
    <span class="current"><?= $produk['nama_produk']; ?></span>
  </nav>

  <div class="row g-4">
    <!-- Gambar Produk -->
    <div class="col-md-5">
      <div class="mp-detail-img-wrap">
        <img src="<?= base_url('uploads/' . $produk['foto']); ?>" class="mp-detail-img" alt="<?= $produk['nama_produk']; ?>">
      </div>
    </div>

    <!-- Info Produk -->
    <div class="col-md-7">
      <h3 class="mp-product-title"><?= $produk['nama_produk']; ?></h3>
      <div class="mp-price-detail">Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></div>
      <br>

      <?php
        $stok = (int) $produk['stok'];
        $badgeClass = $stok === 0 ? 'empty' : ($stok <= 5 ? 'low' : '');
        $badgeText  = $stok === 0 ? 'Stok habis' : 'Stok: ' . $stok;
      ?>
      <span class="mp-stock-badge <?= $badgeClass; ?>"><?= $badgeText; ?></span>

      <div class="mp-desc-card">
        <p class="mp-desc-title">Deskripsi</p>
        <p class="mp-desc-text"><?= nl2br($produk['deskripsi']); ?></p>
      </div>

      <!-- CTA: jadi sticky bar di mobile -->
      <div class="mp-cta-wrap">
        <div class="d-none d-md-block mp-cta-price">
          <small>Total Harga</small>
          <strong>Rp <?= number_format($produk['harga'], 0, ',', '.'); ?></strong>
        </div>
        <a href="<?= site_url('cart/add/' . $produk['id']); ?>" class="mp-btn-primary mp-cta-btn">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M6 7h12l1.5 13.5a1 1 0 01-1 1.1H5.5a1 1 0 01-1-1.1L6 7z" stroke="white" stroke-width="1.8" stroke-linejoin="round"/>
            <path d="M9 7a3 3 0 016 0" stroke="white" stroke-width="1.8" stroke-linecap="round"/>
          </svg>
          Tambah ke Cart
        </a>
      </div>
      <hr class="mp-divider">

      <!-- Tanya Produk -->
      <h5 class="mp-qna-title">❓ Tanya Produk</h5>

      <?php if ($this->session->flashdata('pesan')): ?>
        <div class="alert alert-success mp-alert-success text-center"><?= $this->session->flashdata('pesan') ?></div>
      <?php endif; ?>

      <?php if ($this->session->userdata('pembeli_id')): ?>
        <form action="<?= site_url('admin/Produk/tanya') ?>" method="post" class="mp-qna-form">
          <input type="hidden" name="produk_id" value="<?= $produk['id'] ?>">
          <div class="mb-2">
            <textarea name="isi_pertanyaan" class="form-control" rows="3" placeholder="Tulis pertanyaan Anda tentang produk ini..." required></textarea>
          </div>
          <button type="submit" class="mp-btn-primary">Kirim Pertanyaan</button>
        </form>
      <?php else: ?>
        <div class="mp-login-hint">
          <a href="<?= site_url('auth/login') ?>">Login</a> untuk bertanya tentang produk ini.
        </div>
      <?php endif; ?>

      <h5 class="mp-qna-title">Pertanyaan Produk</h5>

      <?php if (empty($pertanyaan)): ?>
        <div class="mp-qna-empty">Belum ada pertanyaan untuk produk ini. Jadilah yang pertama bertanya!</div>
      <?php else: ?>
        <div class="mp-qna-list">
          <?php foreach ($pertanyaan as $p): ?>
            <div class="mp-qna-item">
              <div class="mp-qna-head">
                <div class="mp-avatar"><?= strtoupper(substr($p->pembeli_nama, 0, 1)); ?></div>
                <div>
                  <span class="mp-qna-name"><?= $p->pembeli_nama ?></span>
                  <p class="mp-qna-text"><?= $p->isi_pertanyaan ?></p>
                  <span class="mp-qna-time"><?= date('d M Y H:i', strtotime($p->tanggal_dibuat)) ?></span>
                </div>
              </div>

              <?php if (!empty($p->jawaban)): ?>
                <div class="mp-answer-box">
                  <span class="mp-answer-label">Penjual menjawab</span>
                  <p class="mb-1 mt-1"><?= $p->jawaban ?></p>
                  <span class="mp-qna-time"><?= date('d M Y H:i', strtotime($p->tanggal_jawaban)) ?></span>
                </div>
              <?php else: ?>
                <?php if ($this->session->userdata('role') === 'penjual'): ?>
                  <form method="post" action="<?= base_url('produk/jawab/' . $p->id) ?>" class="mp-answer-form">
                    <div class="input-group">
                      <input type="text" name="jawaban" class="form-control" placeholder="Tulis jawaban..." required>
                      <button class="btn btn-sm" type="submit">Jawab</button>
                    </div>
                  </form>
                <?php endif; ?>
              <?php endif; ?>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</div>