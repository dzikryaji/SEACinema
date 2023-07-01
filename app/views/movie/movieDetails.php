<section class="d-flex flex-column align-items-center px-5 py-3 mb-0">
    <?php Flasher::flash(); ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <img src="<?= $movie->poster_url ?>" class="img-thumbnail">
            </div>
            <div class="col-lg-9 col-md-6">
                <div class="w-100">
                    <h1><?= $movie->title; ?></h1>
                    <p><?= $movie->age_rating ?>+</p>
                    <p>Rp<?= $movie->ticket_price ?></p>
                    <p><?= $movie->description ?></p>
                </div>
            </div>
        </div>
    </div>
</section>