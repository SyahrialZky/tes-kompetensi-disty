<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Klinik Sehat</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
      rel="stylesheet"
    />
    <style>
      .hero-section {
        background-color: #f7f7f7;
        padding: 4rem 0;
      }

      @keyframes floating {
        0% {
          transform: translateY(0);
        }
        50% {
          transform: translateY(-10px);
        }
        100% {
          transform: translateY(0);
        }
      }

      .hero-image {
        max-width: 100%;
        height: auto;
        object-fit: cover;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        animation: floating 2s ease-in-out infinite;
      }

      .services-section {
        padding: 3rem 0;
        background-color: #e9ecef;
      }

      .service-card {
        transition: transform 0.3s ease-in-out;
      }

      .service-card:hover {
        transform: translateY(-10px);
      }

      .badge-new {
        font-size: 1rem;
        padding: 0.5rem 1rem;
      }

      .navbar.sticky-top {
        background-color: #fff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      }

      .section-alt {
        background-color: #f5f5f5;
        padding: 3rem 0;
      }

      .btn-custom {
        background-color: #1664c4;
        color: white;
        padding: 10px;
        border-radius: 5px;
        width: 100%;
        border: none;
        transition: background-color 0.3s ease;
      }

      .btn-custom:hover {
        background-color: #0049b0;
        color: white;
      }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  </head>
  <body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
      <div class="container">
        <a class="navbar-brand" href="/">Klinik Sehat</a>
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="#"
                >Beranda</a
              >
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Layanan Kesehatan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Artikel Kesehatan</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Cari Dokter</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Pusat Informasi</a>
            </li>
            <li class="nav-item">
              <a class="btn btn-primary ms-lg-3" href="{{ route('login') }}">Login</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="badge badge-new bg-success text-wrap mb-3">Baru</div>
            <div class="d-inline-block bg-light p-2 rounded mb-4">
              Fitur panggilan darurat telah diperbarui
            </div>
            <h1 class="display-4">
              Temui Dokter Anda.<br />
              Terpercaya & Profesional.
            </h1>
            <div class="row mt-4">
              <div class="col-6">
                <h5>Resep Terbaik</h5>
                <p>untuk pengobatan Anda</p>
              </div>
              <div class="col-6">
                <h5>Konsultasi Gratis</h5>
                <p>sesuai janji kami</p>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <img
              src="https://images.pexels.com/photos/5215024/pexels-photo-5215024.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1"
              class="img-fluid hero-image"
              alt="Gambar Hero"
            />
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section class="services-section">
      <div class="container">
        <h3 class="text-center">Layanan Populer di Klinik Sehat</h3>
        <p class="text-center">
          Cara cepat untuk mendapatkan pengalaman pertama Anda
        </p>
        <div class="row mt-5">
          <div class="col-md-2">
            <div class="card service-card">
              <div class="card-body text-center">
                <h5>Poliklinik Umum</h5>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card service-card">
              <div class="card-body text-center">
                <h5>Poliklinik Gigi</h5>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card service-card">
              <div class="card-body text-center">
                <h5>IGD 24 Jam</h5>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card service-card">
              <div class="card-body text-center">
                <h5>Laboratorium</h5>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card service-card">
              <div class="card-body text-center">
                <h5>Radiologi</h5>
              </div>
            </div>
          </div>
          <div class="col-md-2">
            <div class="card service-card">
              <div class="card-body text-center">
                <h5>Apotek</h5>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Form Daftar Nomor Antrian -->
    <section class="section-alt">
      <div class="container">
        <h3 class="text-center">Daftar Nomor Antrian</h3>
        <p class="text-center">
          Daftar nomor antrian pasien dengan mengisi form di bawah ini
        </p>
        <div class="card mb-3 p-3 shadow">
          <form method="POST" enctype="multipart/form-data">
            <div class="form-group mb-3">
              <label for="nama_pasien" class="form-label">Nama</label>
              <input
                type="text"
                name="nama_pasien"
                id="nama_pasien"
                placeholder="Masukkan Nama Pasien"
                class="form-control"
                required
              />
            </div>
            <div class="form-group mb-3">
              <label for="telp" class="form-label">No Telp</label>
              <input
                type="number"
                name="telp"
                id="telp"
                placeholder="Masukkan No Telp"
                class="form-control"
                required
              />
            </div>
            <div class="form-group mb-3">
              <label for="email" class="form-label">Email</label>
              <input
                type="email"
                name="email"
                id="email"
                placeholder="Masukkan Email"
                class="form-control"
                required
              />
            </div>
            <div class="form-group mb-3">
              <label for="tgl_periksa" class="form-label"
                >Tanggal Periksa</label
              >
              <input
                type="date"
                name="tgl_periksa"
                id="tgl_periksa"
                class="form-control"
                required
              />
            </div>
            <div class="form-group mb-3">
              <label for="kategori_pasien" class="form-label"
                >Kategori Pasien</label
              >
              <select
                name="kategori_pasien"
                id="kategori_pasien"
                class="form-select"
                required
              >
                <option value="umum">Umum</option>
                <option value="bpjs">BPJS</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="keluhan" class="form-label">Keluhan</label>
              <textarea
                name="keluhan"
                id="keluhan"
                class="form-control"
                placeholder="Masukkan Keluhan"
                required
              ></textarea>
            </div>
            <button type="submit" class="btn btn-custom btn-block">
              Kirim
            </button>
          </form>
        </div>
      </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-dark text-light pt-5 pb-4">
      <div class="container text-center text-md-start">
        <div class="row">
          <div class="col-md-3 col-lg-3 col-xl-3 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold">Klinik Sehat</h6>
            <hr
              class="mb-4 mt-0 d-inline-block mx-auto"
              style="width: 60px; background-color: #00d9a5; height: 2px"
            />
            <p>
              Klinik Sehat menawarkan berbagai layanan kesehatan dengan tenaga
              profesional, terpercaya, dan siap membantu Anda kapan saja.
            </p>
          </div>

          <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold">Layanan</h6>
            <hr
              class="mb-4 mt-0 d-inline-block mx-auto"
              style="width: 60px; background-color: #00d9a5; height: 2px"
            />
            <p><a href="#" class="text-light">Poliklinik Umum</a></p>
            <p><a href="#" class="text-light">Poliklinik Gigi</a></p>
            <p><a href="#" class="text-light">IGD 24 Jam</a></p>
            <p><a href="#" class="text-light">Laboratorium</a></p>
          </div>

          <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
            <h6 class="text-uppercase fw-bold">Informasi</h6>
            <hr
              class="mb-4 mt-0 d-inline-block mx-auto"
              style="width: 60px; background-color: #00d9a5; height: 2px"
            />
            <p><a href="#" class="text-light">Tentang Kami</a></p>
            <p><a href="#" class="text-light">Hubungi Kami</a></p>
            <p><a href="#" class="text-light">Karir</a></p>
            <p><a href="#" class="text-light">Visi Misi</a></p>
          </div>

          <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
            <h6 class="text-uppercase fw-bold">Kontak</h6>
            <hr
              class="mb-4 mt-0 d-inline-block mx-auto"
              style="width: 60px; background-color: #00d9a5; height: 2px"
            />
            <p><i class="fas fa-home mr-3"></i> Jl. Kesehatan No.1, Jakarta</p>
            <p><i class="fas fa-envelope mr-3"></i> info@kliniksehat.com</p>
            <p><i class="fas fa-phone mr-3"></i> +62 812 3456 7890</p>
            <p><i class="fas fa-phone mr-3"></i> +62 812 3456 1010</p>
          </div>
        </div>
      </div>
    </footer>
  </body>
</html>
