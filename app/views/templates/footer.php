<?php if (isset($_SESSION['account'])) : ?>
  <!-- Modal -->
  <div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content p-3 bg-secondary" style="border-radius: 1rem;">
        <div class="modal-body d-flex flex-column align-items-center justify-content-center">
          <h5>YOU ARE ATTEMPTING TO LOGOUT</h5>
          <h6 class="mb-5">Are you sure?</h6>
          <h6 class="mb-3">Logged in as <?= $_SESSION['account']['name'] ?></h6>
          <a type="button" class="btn btn-primary w-100" href="<?= BASEURL ?>Account/Logout">LOGOUT</a>
        </div>
      </div>
    </div>
  </div>
<?php endif; ?>

<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="<?= BASEURL ?>resources/lib/wow/wow.min.js"></script>
<script src="<?= BASEURL ?>resources/lib/easing/easing.min.js"></script>
<script src="<?= BASEURL ?>resources/lib/waypoints/waypoints.min.js"></script>
<script src="<?= BASEURL ?>resources/lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Template Javascript -->
<script src="<?= BASEURL ?>resources/js/main.js"></script>

<?php if (isset($script)) : ?>
  <script src="<?= BASEURL . "resources/js/" . $script . ".js" ?>"></script>
<?php endif; ?>
</body>

</html>