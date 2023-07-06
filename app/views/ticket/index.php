<section class="d-flex flex-column align-items-center p-3">
    <?php Flasher::flash(); ?>
    <div class="text-center mx-auto mt-3 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
        <h1 class="text-uppercase">Your Ticket</h1>
    </div>
    <div class="d-flex flex-column align-items-center w-100 min-vh-100 <?= $tickets ? 'p-5' : 'justify-content-center' ?>">
        <?php if ($tickets) : ?>
            <?php foreach ($tickets as $index => $ticket) : ?>
                <div class="container-xxl py-2">
                    <div class="container">
                        <div class="row g-0 justify-content-center">
                            <div class="col-lg-2 wow fadeIn" data-wow-delay="0.1s">
                                <div>
                                    <img class="img-fluid" src="<?= $ticket['poster_url'] ?>" alt="">
                                </div>
                            </div>
                            <div class="col wow fadeIn" data-wow-delay="0.3s">
                                <div class="bg-secondary h-100 d-flex flex-column p-3">
                                    <h4 class="text-uppercase mb-4"><?= $ticket['title']; ?></h4>

                                    <div class="d-flex py-2">
                                        <h6 class="text-uppercase mb-0 me-2">Date : </h6>
                                        <span><?= $ticket['date'] ?></span>
                                    </div>
                                    <div class="d-flex py-2">
                                        <h6 class="text-uppercase mb-0 me-2">Showtime : </h6>
                                        <span class=""><?= date("H:i", strtotime($ticket['showtime'])) ?></span>
                                    </div>
                                    <div class="d-flex flex-column py-1">
                                        <h6 class="text-uppercase mb-0 me-2">Seat : </h6>
                                        <div class="d-flex py-1">
                                            <?php foreach ($ticket['seats'] as $index => $seat) : ?>
                                                <span class="me-2">Seat <?= $seat ?> <?= $index == count($ticket['seats']) - 1 ? '' : ', ' ?> </span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <div class="d-flex py-2">
                                        <a class="btn btn-danger ms-auto" href="<?= BASEURL . 'Ticket/Cancel/' . $ticket['id_seats'] ?>" role="button">Cancel</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <h1 class="text-secondary">You dont have any tickets at the momment</h1>
        <?php endif; ?>
    </div>
</section>