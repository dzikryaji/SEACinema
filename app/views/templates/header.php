<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['judul'] ?></title>
    <link rel="stylesheet" href="<?= BASEURL; ?>resources/css/bootstrap.css">
    <script src="<?= BASEURL; ?>resources/js/bootstrap.bundle.js"></script>
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
        <?php if(isset($_SESSION['user_id'])): ?>
          <li class="nav-item">
              <a class ="nav-link" data-bs-toggle="modal" data-bs-target="#logoutModal" role="button">Logout</a>
          </li>
        <?php else: ?>
        <li class="nav-item">
            <a class ="nav-link" href="<?= BASEURL ?>c=Home&m=login">Login</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>