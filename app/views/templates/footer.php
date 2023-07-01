<?php if(isset($_SESSION['account'])): ?>
<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3 " style="border-radius: 1rem;">
      <div class="modal-body d-flex flex-column align-items-center justify-content-center">
          <h5>YOU ARE ATTEMPTING TO LOGOUT</h5>
          <h6 class="mb-5">Are you sure?</h6>
          <h6 class="mb-3">Logged in as <?= $_SESSION['account']['name'] ?></h6>
          <a type="button" class="btn btn-primary w-100" href="<?= BASEURL ?>c=Home&m=logout">LOGOUT</a>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
</body>
</html>