<section class="d-flex flex-column align-items-center px-5 py-3 mb-0">

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0">
                <div class="col-lg-5 wow fadeIn" data-wow-delay="0.1s">
                    <div class="h-100">
                        <img class="img-fluid h-100" src="<?= $movie['poster_url'] ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-7 wow fadeIn" data-wow-delay="0.5s">
                    <div class="bg-secondary h-100 d-flex flex-column justify-content-center p-5">
                        <h1 class="text-uppercase mb-4"><?= $movie['title']; ?></h1>
                        <div>
                            <div class="d-flex py-2">
                                <h6 class="text-uppercase mb-0 me-2">Age Rating : </h6>
                                <span class="text-uppercase"><?= $movie['age_rating'] ?>+</span>
                            </div>
                            <div class="d-flex py-2">
                                <h6 class="text-uppercase mb-0 me-2">Ticket Price : </h6>
                                <span class="">Rp<?= $movie['ticket_price'] ?></span>
                            </div>
                            <div class="d-flex flex-column py-2">
                                <h6 class="text-uppercase mb-2 me-2">Description : </h6>
                                <span class=""><?= $movie['description'] ?></span>
                            </div>
                            <?php if (isset($_SESSION['account'])) : ?>
                                <form action="<?= BASEURL . "Movie/Seats/" . $movie['id'] ?>" method="post">
                                    <div class="d-flex flex-column py-2">
                                        <h6 class="text-uppercase mb-2 me-2">Dates : </h6>
                                        <div>
                                            <?php foreach ($dates as $index => $date) : ?>
                                                <input type="radio" class="btn-check" value="<?= $date ?>" name="date" id="<?= $index ?>" autocomplete="off" <?= $index == 0 ? 'checked' : '' ?>>
                                                <label class="btn btn-outline-primary mb-2" for="<?= $index ?>"><?= date("d F Y", strtotime($date)) ?></label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-column py-2">
                                        <h6 class="text-uppercase mb-2 me-2">Description : </h6>
                                        <div>
                                            <?php foreach ($showtimes as $index => $showtime) : ?>
                                                <input type="radio" class="btn-check" value="<?= $showtime ?>" name="showtime" id="<?= $index ?>" autocomplete="off" <?= $index == 0 ? 'checked' : '' ?>>
                                                <label class="btn btn-outline-primary mb-2" for="<?= $index ?>"><?= $showtime ?></label>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Book Ticket</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</section>