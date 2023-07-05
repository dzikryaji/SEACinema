<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $title ?></title>
  <link rel="stylesheet" href="<?= BASEURL; ?>resources/css/bootstrap.css">
  <script src="<?= BASEURL; ?>resources/js/bootstrap.bundle.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <?php if(isset($script)):?>
  <script src="<?= BASEURL. "resources/js/" . $script . ".js" ?>"></script>
  <?php endif;?>
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm border-bottom-1">
    <div class="container-fluid px-5">
      <a class="navbar-brand" href="<?= BASEURL; ?>">SEA Cinema</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav ms-auto">
          <?php if (isset($_SESSION['account'])) : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= BASEURL ?>Ticket">Ticket</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= BASEURL ?>Account/Balance">Balance</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-bs-toggle="modal" data-bs-target="#logoutModal" role="button">Logout</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?= BASEURL ?>Account/Login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?= BASEURL ?>Account/SignUp">Sign Up</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>