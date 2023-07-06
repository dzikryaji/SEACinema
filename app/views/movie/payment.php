<section class="d-flex flex-column align-items-center justify-content-center">

    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-0 justify-content-center">
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.1s">
                    <div>
                        <img class="img-fluid" src="<?= $movie['poster_url'] ?>" alt="">
                    </div>
                </div>
                <div class="col-lg-4 wow fadeIn" data-wow-delay="0.3s">
                    <div class="bg-secondary h-100 d-flex flex-column p-5">
                        <h1 class="text-uppercase mb-4"><?= $movie['title']; ?></h1>

                        <div class="d-flex py-2">
                            <h6 class="text-uppercase mb-0 me-2">Date : </h6>
                            <span><?= $date ?></span>
                        </div>
                        <div class="d-flex py-2">
                            <h6 class="text-uppercase mb-0 me-2">Showtime : </h6>
                            <span class=""><?= $showtime ?></span>
                        </div>
                        <div class="d-flex flex-column py-1">
                            <h6 class="text-uppercase mb-0 me-2">Seat : </h6>
                            <div class="d-flex py-1">
                                <?php foreach ($seats as $index => $seat) : ?>
                                    <span class="me-2">Seat <?= $seat ?> <?= $index == count($seats) - 1 ? '' : ', ' ?> </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="d-flex flex-column py-1">
                            <h6 class="text-uppercase mb-0">Ticket Price : </h6>
                            <div class="d-flex py-1">
                                <span class="me-auto"><?= $movie['ticket_price'] . " x " . count($seats) ?></span>
                                <span>Rp<?= $total ?></span>
                            </div>
                        </div>
                        <div class="d-flex py-1 my-4">
                            <h6 class="text-uppercase mb-0 me-auto">Your Balance : </h6>
                            <span class="">Rp<?= $balance ?></span>
                        </div>
                        <a class="btn btn-primary w-50" href="<?= BASEURL ?>Ticket/bookTicket" role="button">Pay</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section>