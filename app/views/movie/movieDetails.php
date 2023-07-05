<section class="d-flex flex-column align-items-center px-5 py-3 mb-0">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <img src="<?= $movie['poster_url'] ?>" class="img-thumbnail">
            </div>
            <div class="col-lg-9 col-md-6">
                <div class="w-100 mb-4">
                    <h1><?= $movie['title']; ?></h1>
                    <p><?= $movie['age_rating'] ?>+</p>
                    <p>Rp<?= $movie['ticket_price'] ?></p>
                    <p><?= $movie['description'] ?></p>
                </div>
                <?php if (isset($_SESSION['account'])) : ?>
                    <a href="<?= BASEURL . "Movie/Seats/" . $movie['id'] ?>" class="btn btn-primary">Book Ticket</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>