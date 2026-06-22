<!-- Slider -->
<div id="promoCarousel" class="carousel slide mp-carousel mt-4 container" data-bs-ride="carousel" data-bs-interval="3000">
  <div class="carousel-inner mp-carousel-inner">
    <?php if (!empty($promo)) : ?>
      <?php foreach ($promo as $index => $p) : ?>
        <div class="carousel-item <?= ($index === 0) ? 'active' : ''; ?>">
          <a href="<?= $p->link ?>" target="_blank">
            <img src="<?= base_url('uploads/promo/' . $p->poster); ?>"
                 class="d-block w-100"
                 style="height: 400px; object-fit: cover;"
                 alt="<?= $p->nama_promo; ?>">
            <div class="mp-carousel-overlay"></div>
          </a>
        </div>
      <?php endforeach; ?>
    <?php else : ?>
      <div class="carousel-item active">
        <img src="https://via.placeholder.com/1200x400" class="d-block w-100" alt="Default Promo">
      </div>
    <?php endif; ?>
  </div>

  <button class="carousel-control-prev mp-carousel-control" type="button" data-bs-target="#promoCarousel" data-bs-slide="prev">
    <span class="mp-carousel-arrow">‹</span>
  </button>
  <button class="carousel-control-next mp-carousel-control" type="button" data-bs-target="#promoCarousel" data-bs-slide="next">
    <span class="mp-carousel-arrow">›</span>
  </button>
</div>


<!-- Konten Utama -->
<div class="container mt-5">
  <div class="row">
    <!-- Sidebar Kategori -->
    <div class="col-md-3">
      <div class="mp-sidebar mb-3">
        <h5 class="mp-sidebar-title">Kategori</h5>
        <?php if (!empty($kategori)) : ?>
          <ul class="mp-sidebar-list">
            <?php foreach ($kategori as $k) : ?>
              <li>
                <a href="<?= site_url('admin/produk/kategori/' . $k['id']); ?>">
                  <?= $k['nama_kategori']; ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else : ?>
          <p class="text-muted small mb-0">Belum ada kategori tersedia.</p>
        <?php endif; ?>
      </div>

      <div class="mp-sidebar">
        <h5 class="mp-sidebar-title">Merek</h5>
        <?php if (!empty($merek)) : ?>
          <ul class="mp-sidebar-list">
            <?php foreach ($merek as $m) : ?>
              <li>
                <a href="">
                  <?= $m['nama_merek']; ?>
                </a>
              </li>
            <?php endforeach; ?>
          </ul>
        <?php else : ?>
          <p class="text-muted small mb-0">Belum ada merek tersedia.</p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Produk -->
    <div class="col-md-9">
      <div class="d-flex justify-content-between align-items-baseline mb-3">
        <h5 class="mp-section-title">Produk Tersedia</h5>
        <span class="mp-section-sub"><?= !empty($produk) ? count($produk) : 0; ?> produk</span>
      </div>

      <div class="row">
        <?php if (!empty($produk)) : ?>
          <?php foreach ($produk as $p) : ?>
            <div class="col-md-4 mb-4">
              <div class="mp-product">
                <a href="<?= site_url('home/detail/' . $p['id']); ?>" class="text-decoration-none d-block">
                  <div class="card mp-product-card">
                    <div class="mp-product-img-wrap">
                      <img src="<?= base_url('uploads/' . $p['foto']); ?>" class="mp-product-img" alt="<?= $p['nama_produk']; ?>">
                    </div>
                    <div class="card-body">
                      <h6 class="mp-product-name"><?= $p['nama_produk']; ?></h6>
                      <p class="mp-product-price">Rp <?= number_format($p['harga'], 0, ',', '.'); ?></p>
                      <div class="mp-btn-primary mp-btn-block disabled">Beli</div>
                    </div>
                  </div>
                </a>
                <!-- Tombol Tambah ke Cart -->
                <a href="<?= site_url('Cart/add/' . $p['id']); ?>" class="mp-btn-outline mp-btn-block mp-add-cart mt-2">
                  <svg width="15" height="15" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 7h12l1.5 13.5a1 1 0 01-1 1.1H5.5a1 1 0 01-1-1.1L6 7z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/>
                    <path d="M9 7a3 3 0 016 0" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                  </svg>
                  Tambah ke Cart
                </a>
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

<style>
/* Variabel sama dengan navbar, didefinisikan ulang agar halaman ini tetap konsisten meski di-load berdiri sendiri */
:root{
    --mp-violet: #6D28D9;
    --mp-pink: #EC4899;
    --mp-amber: #F59E0B;
    --mp-ink: #1E1B2E;
    --mp-gray: #6B7280;
    --mp-border: #E5E7EB;
}
@import url('https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap');

body{ font-family:'Inter', sans-serif; background:#FAFAFC; }

/* ===== Carousel ===== */
.mp-carousel-inner{
    border-radius: 18px;
    overflow: hidden;
    box-shadow: 0 16px 40px -16px rgba(31,16,71,0.25);
}
.mp-carousel-overlay{
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(0,0,0,0) 50%, rgba(31,16,71,0.35) 100%);
}
.mp-carousel-control{
    width: 42px;
    height: 42px;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(255,255,255,0.9);
    border-radius: 50%;
    opacity: 1;
    box-shadow: 0 6px 16px -4px rgba(31,16,71,0.25);
}
.mp-carousel-control.carousel-control-prev{ left: 16px; }
.mp-carousel-control.carousel-control-next{ right: 16px; }
.mp-carousel-arrow{
    color: var(--mp-violet);
    font-size: 1.6rem;
    line-height: 1;
    font-weight: 700;
}
#promoCarousel .carousel-indicators [data-bs-target]{
    width: 8px; height: 8px;
    border-radius: 50%;
    background: #fff;
    opacity: 0.6;
}
#promoCarousel .carousel-indicators .active{
    opacity: 1;
    background: var(--mp-amber);
}

/* ===== Sidebar ===== */
.mp-sidebar{
    background: #fff;
    border: 1px solid var(--mp-border);
    border-radius: 16px;
    padding: 1.1rem 1.2rem;
}
.mp-sidebar-title{
    font-family: 'Poppins', sans-serif;
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--mp-ink);
    margin-bottom: 0.9rem;
    position: relative;
    padding-bottom: 0.6rem;
}
.mp-sidebar-title::after{
    content:"";
    position: absolute;
    left: 0; bottom: 0;
    width: 50px; height: 3px;
    border-radius: 3px;
    background: linear-gradient(90deg, var(--mp-violet), var(--mp-pink));
}
.mp-sidebar-list{
    list-style: none;
    margin: 0; padding: 0;
}
.mp-sidebar-list li + li{ margin-top: 2px; }
.mp-sidebar-list a{
    display: block;
    padding: 0.5rem 0.7rem;
    border-radius: 10px;
    color: var(--mp-gray);
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    border-left: 3px solid transparent;
    transition: all .18s ease;
}
.mp-sidebar-list a:hover{
    background: #F8F4FF;
    color: var(--mp-violet);
    border-left-color: var(--mp-violet);
    padding-left: 0.9rem;
}

/* ===== Section title ===== */
.mp-section-title{
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    color: var(--mp-ink);
    margin: 0;
}
.mp-section-sub{
    font-size: 0.85rem;
    color: var(--mp-gray);
}

/* ===== Product card ===== */
.mp-product-card{
    border: 1px solid var(--mp-border);
    border-radius: 16px;
    overflow: hidden;
    transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
    background: #fff;
}
.mp-product-card:hover{
    transform: translateY(-4px);
    box-shadow: 0 18px 32px -16px rgba(31,16,71,0.22);
    border-color: #EADDFF;
}
.mp-product-img-wrap{
    overflow: hidden;
    height: 180px;
}
.mp-product-img{
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform .35s ease;
}

.mp-product-name{
    font-size: 0.92rem;
    font-weight: 600;
    color: var(--mp-ink);
    margin-bottom: 0.35rem;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 2.4em;
}
.mp-product-price{
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    font-size: 0.95rem;
    color: var(--mp-violet);
    margin-bottom: 0.7rem;
}

/* Reuse-able buttons (sama persis dgn navbar) */
.mp-btn-primary{
    background: linear-gradient(135deg, var(--mp-violet), var(--mp-pink));
    color: #fff !important;
    font-weight: 600;
    font-size: 0.85rem;
    padding: 0.45rem 1rem;
    border-radius: 999px;
    text-align: center;
    box-shadow: 0 8px 18px -6px rgba(109,40,217,0.4);
}
.mp-btn-outline{
    border: 1.5px solid var(--mp-border);
    color: var(--mp-ink) !important;
    font-weight: 500;
    font-size: 0.85rem;
    padding: 0.45rem 1rem;
    border-radius: 999px;
    text-align: center;
    text-decoration: none;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    transition: border-color .2s ease, color .2s ease, background .2s ease;
}
.mp-btn-outline:hover{
    border-color: var(--mp-violet);
    color: var(--mp-violet) !important;
    background: #F8F4FF;
}
.mp-btn-block{ width: 100%; display: block; }

@media (max-width: 767px){
    .mp-sidebar{ margin-bottom: 1rem; }
}
</style>