<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Marketplace</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f5f5f5;
    }

    .navbar {
      background-color: #00a96e;
    }

    /* Warna hijau Tokopedia */
    .navbar-brand,
    .nav-link {
      color: #fff !important;
      font-weight: 600;
    }

    .search-bar {
      max-width: 500px;
      width: 100%;
    }

    .btn-search {
      background-color: #02885a;
      color: #fff;
    }

    .category-card img {
      width: 60px;
      height: 60px;
    }

    .category-card:hover {
      background-color: #f8f9fa;
      transition: 0.3s;
    }

    .product-card {
      transition: transform 0.3s;
    }

    .product-card:hover {
      transform: scale(1.05);
    }

    .footer {
      background-color: #343a40;
      color: #fff;
      padding: 20px 0;
      text-align: center;
    }
  </style>
</head>

<body>

  <!-- Header -->
  <nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="#">Marketplace</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item"><a class="nav-link" href="#">Home</a></li>
          <li class="nav-item"><a class="nav-link" href="#">About</a></li>
          <li class="nav-item"><a class="nav-link" href="#">Cara Beli</a></li>
        </ul>
        <form class="d-flex search-bar">
          <select class="form-select me-2">
            <option value="">Kategori</option>
            <option value="elektronik">Elektronik</option>
            <option value="fashion">Fashion</option>
            <option value="otomotif">Otomotif</option>
          </select>
          <input class="form-control" type="search" placeholder="Cari produk...">
          <button class="btn btn-search ms-2" type="submit">Cari</button>
        </form>
        <ul class="navbar-nav ms-3">
          <li class="nav-item"><a class="nav-link" href="#">🛒 Cart</a></li>
          <li class="nav-item"><a class="nav-link" href="<?= base_url("auth/login"); ?>
 ">🔑 Login</a></li>
        </ul>
      </div>
    </div>
  </nav>
php
  <!-- Slider -->
  <div id="carouselExample" class="carousel slide mt-3 container" data-bs-ride="carousel">
    <div class="carousel-inner">
      <?php $no = 0;
      foreach ($promo as $row): ?>
        <div class="carousel-item <?= $no == 0 ? 'active' : '' ?>">
          <img src="<?= base_url('uploads/promo/' . $row->poster) ?>" class="d-block w-100 rounded" alt="<?= $row->nama_promo ?>">
        </div>
      <?php $no++;
      endforeach; ?>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>


  <!-- Daftar Kategori -->
  <div class="container mt-4">
    <h5 class="mb-3">Kategori Populer</h5>
    <div class="row text-center">
      <div class="col-md-2">
        <div class="card category-card p-2">
          <img src="https://via.placeholder.com/100" class="mx-auto d-block">
          <p class="mt-2">Elektronik</p>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card category-card p-2">
          <img src="https://via.placeholder.com/100" class="mx-auto d-block">
          <p class="mt-2">Fashion</p>
        </div>
      </div>
      <div class="col-md-2">
        <div class="card category-card p-2">
          <img src="https://via.placeholder.com/100" class="mx-auto d-block">
          <p class="mt-2">Otomotif</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Produk Terbaru -->
  <div class="container mt-4">
    <h5 class="mb-3">Produk Terbaru</h5>
    <div class="row">
      <div class="col-md-3">
        <div class="card product-card">
          <img src="https://via.placeholder.com/200" class="card-img-top">
          <div class="card-body">
            <h6 class="card-title">Produk A</h6>
            <p class="text-danger">Rp 100.000</p>
            <a href="#" class="btn btn-success btn-sm">Beli</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Produk Terlaris -->
  <div class="container mt-4">
    <h5 class="mb-3">Produk Terlaris</h5>
    <div class="row">
      <div class="col-md-3">
        <div class="card product-card">
          <img src="https://via.placeholder.com/200" class="card-img-top">
          <div class="card-body">
            <h6 class="card-title">Produk C</h6>
            <p class="text-danger">Rp 200.000</p>
            <a href="#" class="btn btn-success btn-sm">Beli</a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer mt-4">
    <p>&copy; 2025 Marketplace. All Rights Reserved.</p>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>