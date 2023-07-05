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
                    <form action="<?= BASEURL . "Movie/Seats/" . $movie['id'] ?>" method="post">
                        <div class="mb-2">
                            <label class="form-label">Dates : </label>
                            <div>
                                <?php foreach ($dates as $index => $date) : ?>
                                    <input type="radio" class="btn-check" value="<?= $date ?>" name="date" id="<?= $index ?>" autocomplete="off" <?= $index == 0 ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-primary" for="<?= $index ?>"><?= date("d F Y", strtotime($date)) ?></label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Showtimes : </label>
                            <div>
                                <?php foreach ($showtimes as $index => $showtime) : ?>
                                    <input type="radio" class="btn-check" value="<?= $showtime ?>" name="showtime" id="<?= $index ?>" autocomplete="off" <?= $index == 0 ? 'checked' : '' ?>>
                                    <label class="btn btn-outline-primary" for="<?= $index ?>"><?= $showtime ?></label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Book Ticket</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>