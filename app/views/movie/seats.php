<section class="d-flex flex-column align-items-center px-5 py-3 mb-0">
    <div class="row mb-5">
        <div class="col-12">
            <h1><?= $movie['title'] ?></h1>
        </div>
    </div>
    <form action="<?= BASEURL . "Movie/Payment/" . $movie['id'] ?>" method="post" class="w-100 align-items-center ">
        <div class="container-fluid mb-4">
            <div class="row justify-content-center mb-4">
                <div class="col-lg-3 mb-3">
                    <label for="date" class="form-label">Date : </label>
                    <input type="text" class="form-control w-100" name="date" id="date" value="<?= $date ?>" readonly>
                </div>
                <div class="col-lg-3 mb-3">
                    <label for="showtime" class="form-label">Showtime : </label>
                    <input type="text" class="form-control w-100" name="showtime" id="showtime" value="<?= $showtime ?>" readonly>
                </div>
            </div>
            <?php for ($index = 1; $index <= 64; $index++) : ?>
                <?php if ($index % 8 == 1) : ?>
                    <div class="row gx-1 mb-2 justify-content-center">
                    <?php endif; ?>
                    <div class="col-1">
                        <input class="btn-check" type="checkbox" autocomplete="off" value="<?= $index ?>" id="Seat_<?= $index ?>" name="Seat_<?= $index ?>" <?= $seats[$index - 1] ? 'disabled' : '' ?>>
                        <label class="btn <?= $seats[$index - 1] ? 'btn-secondary' : 'btn-outline-primary' ?> w-100 px-0" for="Seat_<?= $index ?>">
                            <?= $index ?>
                        </label>
                    </div>
                    <?php if ($index % 4 == 0 && $index % 8 != 0) : ?>
                        <div class="col-1"></div>
                    <?php endif; ?>
                    <?php if ($index % 8 == 0 || $index == 64) : ?>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
            <div class="row mb-5 mt-2 justify-content-center">
                <div class="col-9 bg-secondary rounded">
                    <div class="w-100 text-center text-light py-1 fw-bold">Screen</div>
                </div>
            </div>
            <div class="row mt-4 justify-content-center">
                <?php if ($_SESSION['account']['age'] < $movie['age_rating']) : ?>
                    <input id="btnBook" type="button" value="Book Ticket" class="btn btn-primary w-50" data-bs-toggle="modal" data-bs-target="#ageModal">
                <?php else : ?>
                    <input id="btnBook" type="submit" value="Book Ticket" class="btn btn-primary w-50" disabled>
                <?php endif; ?>
            </div>
        </div>
    </form>
</section>

<?php if ($_SESSION['account']['age'] < $movie['age_rating']) : ?>
    <!-- Modal -->
    <div class="modal fade" id="ageModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3 " style="border-radius: 1rem;">
                <div class="modal-body d-flex flex-column align-items-center justify-content-center">
                    <h5 class="mb-4">YOU CANT BOOK THIS MOVIE</h5>
                    <h6 class="mb-3">Your age is below <?= $movie['age_rating'] ?> years old</h6>
                    <button type="button" class="btn btn-primary w-100" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>