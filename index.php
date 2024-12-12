<?php
include 'koneksi.php';

// Query to get total MOU and MOA
$query = "
    SELECT YEAR(awal_kerjasama) AS tahun, jenis_dokumen, COUNT(*) AS jumlah 
    FROM tb_dokumen 
    GROUP BY tahun, jenis_dokumen
    ORDER BY tahun ASC
";
$result = $koneksi->query($query);

// Siapkan data untuk Chart.js
$years = [];
$mouData = [];
$moaData = [];
$totalMou = 0; // For total MOU
$totalMoa = 0; // For total MOA

while ($row = $result->fetch_assoc()) {
    $tahun = $row['tahun'];
    $jenis = strtoupper($row['jenis_dokumen']);
    $jumlah = (int)$row['jumlah'];

    if (!in_array($tahun, $years)) {
        $years[] = $tahun;
    }

    if ($jenis === 'MOU') {
        $mouData[$tahun] = $jumlah;
        $totalMou += $jumlah; // Add to total MOU
    } elseif ($jenis === 'MOA') {
        $moaData[$tahun] = $jumlah;
        $totalMoa += $jumlah; // Add to total MOA
    }
}

// Pastikan semua tahun memiliki nilai default (0) jika tidak ada data
foreach ($years as $tahun) {
    $mouData[$tahun] = $mouData[$tahun] ?? 0;
    $moaData[$tahun] = $moaData[$tahun] ?? 0;
}

// Query to get the total proposals from tb_usulan
$queryUsulan = "SELECT COUNT(*) AS jumlah_usulan FROM tb_usulan";
$resultUsulan = $koneksi->query($queryUsulan);
$rowUsulan = $resultUsulan->fetch_assoc();
$totalUsulan = (int)$rowUsulan['jumlah_usulan'];

// Konversi data ke format JSON untuk Chart.js
$chartData = [
    'years' => $years,
    'mou' => array_values($mouData),
    'moa' => array_values($moaData),
    'totalMou' => $totalMou, // Total MOU
    'totalMoa' => $totalMoa, // Total MOA
    'totalUsulan' => $totalUsulan // Total proposals
];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>SIKers PNP - Home Page</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="img/PNP.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Font Awesome -->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Inter:wght@100;200;300;400;500;600;700;800;900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: iLanding
  * Template URL: https://bootstrapmade.com/ilanding-bootstrap-landing-page-template/
  * Updated: Nov 12 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div
      class="header-container container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.php" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="img/PNP.png" alt="">
        <h1 class="sitename">SIKers PNP</h1>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#statistik">Statistik</a></li>
          <li><a href="#kerjasama">Kerjasama</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>
      <div class="hero-buttons">
        <a href="login.php" class="btn-getstarted me-0 me-sm-2 mx-1"
          style="background-color: #ff6f3C; color: white;">Login</a>
      </div>
    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center">
          <div class="col-lg-6">
            <div class="hero-content" data-aos="fade-up" data-aos-delay="200">

              <h1 class="mb-4">
                SISTEM INFORMASI KERJASAMA <br>
                <span class="" style="color: #ff8c42;">POLITEKNIK NEGERI PADANG</span>
              </h1>

              <p class="mb-4 mb-md-5">
                Ayo!! mulai berkerjasama dengan kami di Politeknik Negeri Padang
              </p>

              <div class="hero-buttons">
                <a class="btn-getstarted btn-primary" data-bs-toggle="modal" data-bs-target="#usulanModal"
                  style="background-color: #ff6f3c;">Usulkan Kerjasama</a>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="hero-image" data-aos="zoom-out" data-aos-delay="300">
              <img src="img/Business strategy.gif" alt="Hero Image" class="img-fluid">

              <div class="customers-badge">
                <p class="mb-0 mt-2">200+ mitra yang sudah berkerjasama</p>
              </div>
            </div>
          </div>
        </div>

        <div class="row stats-row gy-4 mt-5" data-aos="fade-up" data-aos-delay="500">
          <div class="col-lg-4 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
              <i class="bi bi-file-earmark-ruled"></i>
              </div>
              <div class="stat-content">
                <h4>Total MOU</h4>
                <?php echo number_format($chartData['totalMou']); ?>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
              <i class="bi bi-file-earmark-ruled-fill"></i>
              </div>
              <div class="stat-content">
                <h4>Total MOA</h4>
                <?php echo number_format($chartData['totalMoa']); ?>
              </div>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="stat-item">
              <div class="stat-icon">
              <i class=" fas fa-handshake"></i>
              </div>
              <div class="stat-content">
                <h4>Jumlah Usulan Kerjasama</h4>
                <?php echo number_format($chartData['totalUsulan']); ?>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /Hero Section -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4 align-items-center justify-content-between">

          <div class="col-xl-5" data-aos="fade-up" data-aos-delay="200">
            <span class="about-meta" style="color: #ff8c42;">MORE ABOUT US</span>
            <h2 class="about-title">Kerjasama Politeknik Negeri Padang</h2>
            <p class="about-description">
              Dalam rangka menghadapi perkembangan ilmu pengetahuan dan teknologi yang berkembang begitu cepat, maka PNP
              dengan industri dan instansi lainnya menjalin kerjasama dengan stake holder terutama untuk menjaga mutu
              lulusan dan pengembangan sumber daya serta menyalurkan lulusan. Kerjasama yang dilakukan tidak hanya di
              Indonesia tapi juga dengan luar negeri baik dibidang industri maupun perguruan tinggi.</p>

            <div class="row feature-list-wrapper">
              <div class="col-md-6">
                <ul class="feature-list">
                  <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ff8c42"
                      class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                      <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg></i> PT. United Tractors BTN</li>
                  <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ff8c42"
                      class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                      <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg></i> PT. Toyota Motor Manufacturing</li>
                  <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ff8c42"
                      class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                      <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg></i> PT. Trakindo Utama BPD</li>
                </ul>
              </div>
              <div class="col-md-6">
                <ul class="feature-list">
                  <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ff8c42"
                      class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                      <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg></i> Pertamina</li>
                  <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ff8c42"
                      class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                      <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg></i> PT. Epson</li>
                  <li><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#ff8c42"
                      class="bi bi-check-circle-fill" viewBox="0 0 16 16">
                      <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0m-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
                    </svg></i> PT.Unindo
                    ASPEKINDO</li>
                </ul>
              </div>
            </div>
          </div>

          <div class="col-xl-6" data-aos="fade-up" data-aos-delay="300">
            <div class="image-wrapper">
              <div class="images position-relative" data-aos="zoom-out" data-aos-delay="400">
                <img src="assets/img/about-5.webp" alt="Business Meeting" class="img-fluid main-image rounded-4">
                <img src="assets/img/about-2.webp" alt="Team Discussion" class="img-fluid small-image rounded-4">
              </div>
              <div class="experience-badge floating">
                <h3>15+ <span>Years</span></h3>
                <p>Of experience in business service</p>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section><!-- /About Section -->

    <!-- Features Section -->
    <section id="statistik" class="features section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Statistik</h2>
        <p>Grafik Distribusi Dokumen Kerjasama</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="d-flex justify-content-center">

          <div class="row">
            <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">
              <div class="counter-box">
                <div class="card-body">
                  <div class="chart-container">
                    <h4>Jumlah MOA dan MOA per Tahun</h4> <br>
                    <canvas id="barChart" width="1000" height="500"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
              <div class="counter-box">
                <div class="card-body">
                  <div class="chart-container">
                    <h4>Total MOU dan MOA</h4> <br>
                    <canvas id="pieChart"></canvas>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Features Section -->

    <!-- Testimonials Section -->
    <section id="kerjasama" class="testimonials section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Daftar Kerjasama</h2>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row g-5">

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">

          </div><!-- End testimonial item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">

          </div><!-- End testimonial item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">

          </div><!-- End testimonial item -->

          <div class="col-lg-6" data-aos="fade-up" data-aos-delay="400">

          </div><!-- End testimonial item -->

        </div>

      </div>

    </section><!-- /Testimonials Section -->

    <!-- Stats Section -->
    <section id="statistik" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">



      </div>

    </section><!-- /Stats Section -->

    <!-- Contact Section -->
    <section id="contact" class="contact section light-background">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Contact</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row g-4 g-lg-5">
          <div class="col-lg-5">
            <div class="info-box" data-aos="fade-up" data-aos-delay="200">
              <h3>Contact Info</h3>
              <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis.
              </p>

              <div class="info-item" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box">
                  <i class="bi bi-geo-alt"></i>
                </div>
                <div class="content">
                  <h4>Our Location</h4>
                  <p>A108 Adam Street</p>
                  <p>New York, NY 535022</p>
                </div>
              </div>

              <div class="info-item" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box">
                  <i class="bi bi-telephone"></i>
                </div>
                <div class="content">
                  <h4>Phone Number</h4>
                  <p>+1 5589 55488 55</p>
                  <p>+1 6678 254445 41</p>
                </div>
              </div>

              <div class="info-item" data-aos="fade-up" data-aos-delay="500">
                <div class="icon-box">
                  <i class="bi bi-envelope"></i>
                </div>
                <div class="content">
                  <h4>Email Address</h4>
                  <p>info@example.com</p>
                  <p>contact@example.com</p>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-7">
            <div class="contact-form" data-aos="fade-up" data-aos-delay="300">
              <h3>Get In Touch</h3>
              <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ante ipsum primis.
              </p>

              <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up"
                data-aos-delay="200">
                <div class="row gy-4">

                  <div class="col-md-6">
                    <input type="text" name="name" class="form-control" placeholder="Your Name" required="">
                  </div>

                  <div class="col-md-6 ">
                    <input type="email" class="form-control" name="email" placeholder="Your Email" required="">
                  </div>

                  <div class="col-12">
                    <input type="text" class="form-control" name="subject" placeholder="Subject" required="">
                  </div>

                  <div class="col-12">
                    <textarea class="form-control" name="message" rows="6" placeholder="Message" required=""></textarea>
                  </div>

                  <div class="col-12 text-center">
                    <div class="loading">Loading</div>
                    <div class="error-message"></div>
                    <div class="sent-message">Your message has been sent. Thank you!</div>

                    <button type="submit" class="btn">Send Message</button>
                  </div>

                </div>
              </form>

            </div>
          </div>

        </div>

      </div>

    </section><!-- /Contact Section -->

  </main>

  <!-- Modal Section -->
  <div class="modal modal-lg fade" id="usulanModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <form action="/superAdmin/proses_usulan.php?proses=insert" method="POST" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title" id="modalLabel">Form Usulan Kerjasama</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="id_usulan" id="id_usulan">
            <div class="mb-3">
              <label for="nama_instansi" class="form-label">Nama Instansi</label>
              <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" required>
            </div>
            <div class="mb-3">
              <label for="alamat" class="form-label">Alamat</label>
              <textarea class="form-control" id="alamat" name="alamat" rows="3" required></textarea>
            </div>
            <div class="mb-3">
              <label for="nama_pejabat_penanda_tangan" class="form-label">Nama Pejabat Penanda Tangan</label>
              <input type="text" class="form-control" id="nama_pejabat_penanda_tangan"
                name="nama_pejabat_penanda_tangan" required>
            </div>
            <div class="mb-3">
              <label for="nama_jabatan" class="form-label">Jabatan</label>
              <input type="text" class="form-control" id="nama_jabatan" name="nama_jabatan" required>
            </div>
            <div class="mb-3">
              <label for="no_kontak" class="form-label">No Kontak</label>
              <input type="text" class="form-control" id="no_kontak" name="no_kontak" required>
            </div>
            <div class="mb-3">
              <label for="alamat_email" class="form-label">Alamat Email</label>
              <input type="email" class="form-control" id="alamat_email" name="alamat_email" required>
            </div>
            <div class="mb-3">
              <label for="upload_dokumen" class="form-label">Upload Dokumen (tidak lebih dari 4mb)</label>
              <input type="file" class="form-control" id="upload_dokumen" name="upload_dokumen" accept=".pdf,.doc,.docx"
                required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <footer id="footer" class="footer">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="logo d-flex align-items-center">
            <span class="sitename">iLanding</span>
          </a>
          <div class="footer-contact pt-3">
            <p>A108 Adam Street</p>
            <p>New York, NY 535022</p>
            <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
            <p><strong>Email:</strong> <span>info@example.com</span></p>
          </div>
          <div class="social-links d-flex mt-4">
            <a href=""><i class="bi bi-twitter-x"></i></a>
            <a href=""><i class="bi bi-facebook"></i></a>
            <a href=""><i class="bi bi-instagram"></i></a>
            <a href=""><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Useful Links</h4>
          <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">About us</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="#">Terms of service</a></li>
            <li><a href="#">Privacy policy</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Our Services</h4>
          <ul>
            <li><a href="#">Web Design</a></li>
            <li><a href="#">Web Development</a></li>
            <li><a href="#">Product Management</a></li>
            <li><a href="#">Marketing</a></li>
            <li><a href="#">Graphic Design</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Hic solutasetp</h4>
          <ul>
            <li><a href="#">Molestiae accusamus iure</a></li>
            <li><a href="#">Excepturi dignissimos</a></li>
            <li><a href="#">Suscipit distinctio</a></li>
            <li><a href="#">Dilecta</a></li>
            <li><a href="#">Sit quas consectetur</a></li>
          </ul>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Nobis illum</h4>
          <ul>
            <li><a href="#">Ipsam</a></li>
            <li><a href="#">Laudantium dolorum</a></li>
            <li><a href="#">Dinera</a></li>
            <li><a href="#">Trodelas</a></li>
            <li><a href="#">Flexo</a></li>
          </ul>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">iLanding</strong> <span>All Rights Reserved</span></p>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you've purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: [buy-url] -->
        Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

  <!-- Chart -->
  <script>
    // Data dari PHP
    const chartData = <?php echo json_encode($chartData); ?>;

    // Inisialisasi Bar Chart
    const barCtx = document.getElementById('barChart').getContext('2d');
    new Chart(barCtx, {
        type: 'bar',
        data: {
            labels: chartData.years,
            datasets: [
                {
                    label: 'MOU',
                    data: chartData.mou,
                    backgroundColor: '#007bff',
                },
                {
                    label: 'MOA',
                    data: chartData.moa,
                    backgroundColor: '#28a745',
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: true,
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tahun'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Dokumen'
                    },
                    beginAtZero: true
                }
            }
        }
    });

    // Inisialisasi Pie Chart
    const pieCtx = document.getElementById('pieChart').getContext('2d');
    new Chart(pieCtx, {
        type: 'pie',
        data: {
            labels: ['Total MOU', 'Total MOA'],
            datasets: [{
                data: [chartData.totalMou, chartData.totalMoa],
                backgroundColor: ['#007bff', '#28a745'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                }
            }
        }
    });
    </script>

</body>

</html>