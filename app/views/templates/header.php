<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title><?= $title ?></title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">

  <!-- Favicon -->
  <link href="<?= BASEURL ?>resources/img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Oswald:wght@600&display=swap" rel="stylesheet">

  <!-- Icon Font Stylesheet -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="<?= BASEURL ?>resources/lib/animate/animate.min.css" rel="stylesheet">
  <link href="<?= BASEURL ?>resources/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="<?= BASEURL ?>resources/css/bootstrap.min.css" rel="stylesheet">

  <!-- Template Stylesheet -->
  <link href="<?= BASEURL ?>resources/css/style.css" rel="stylesheet">
</head>

<body>
  <!-- Spinner Start -->
  <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
    <div class="spinner-grow text-primary" style="width: 3rem; height: 3rem;" role="status">
      <span class="sr-only">Loading...</span>
    </div>
  </div>
  <!-- Spinner End -->


  <!-- Navbar Start -->
  <nav class="navbar navbar-expand-lg bg-secondary navbar-dark sticky-top py-lg-0 px-lg-5 wow fadeIn" data-wow-delay="0.1s">
    <a href="<?= BASEURL ?>" class="navbar-brand ms-4 ms-lg-0">
      <h1 class="mb-0 text-primary text-uppercase">SeaCinema</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
      <div class="navbar-nav ms-auto p-4 p-lg-0">
        <?php if (isset($_SESSION['account'])) : ?>
        <a href="<?= BASEURL ?>Ticket" class="nav-item nav-link <?= $activeTicket ?? '' ?>">Ticket</a>
        <a href="<?= BASEURL ?>Account/Balance" class="nav-item nav-link <?= $activeBalance ?? '' ?>">Balance</a>
        <a class="nav-item nav-link" data-bs-toggle="modal" data-bs-target="#logoutModal" role="button">Logout</a>
        <?php else : ?>
        <a href="<?= BASEURL ?>Account/Login" class="nav-item nav-link <?= $activeLogin ?? '' ?>">Login</a>
        <a href="<?= BASEURL ?>Account/SignUp" class="nav-item nav-link <?= $activeSignUp ?? '' ?>">Sign Up</a>
        <?php endif; ?>
      </div>
    </div>
  </nav>
  <!-- Navbar End -->