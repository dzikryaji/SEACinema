<section class="d-flex flex-column align-items-center px-5 py-3 mb-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <img src="<?= $movie->poster_url ?>" class="img-thumbnail">
            </div>
            <div class="col-lg-9 col-md-6">
                <div class="w-100 mb-4">
                    <h1><?= $movie->title; ?></h1>
                    <p><?= $movie->age_rating ?>+</p>
                    <p>Rp<?= $movie->ticket_price ?></p>
                    <p><?= $movie->description ?></p>
                </div>
                <?php if (isset($_SESSION['account'])) : ?>
                    <?php if ($_SESSION['account']['age'] < $movie->age_rating) : ?>
                        <a class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ageModal" role="button">Book Ticket</a>
                    <?php else : ?>
                        <a href="<?= BASEURL . "Ticket/Seats/" . $movie->id ?>" class="btn btn-primary">Book Ticket</a>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php if(isset($_SESSION['account'])) : ?>
<?php if($_SESSION['account']['age'] < $movie->age_rating) : ?>
<!-- Modal -->
<div class="modal fade" id="ageModal" tabindex="-1" aria-hidden="true" >
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3 " style="border-radius: 1rem;">
      <div class="modal-body d-flex flex-column align-items-center justify-content-center">
          <h5 class="mb-4">YOU CANT BOOK THIS MOVIE</h5>
          <h6 class="mb-3">Your age is below <?= $movie->age_rating ?> years old</h6>
          <button type="button" class="btn btn-primary w-100"  data-bs-dismiss="modal">OK</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>
<?php endif; ?>