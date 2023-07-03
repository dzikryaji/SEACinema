<section class="d-flex flex-column align-items-center px-5 py-3 mb-0">
    <div class="row mb-5">
        <div class="col-12">
            <h1><?= $movie->title ?></h1>
        </div>
    </div>
    <form action="<?= BASEURL . "Ticket/Payment/" . $movie->id ?>" method="post" class="w-100 align-items-center ">
        <div class="container-fluid mb-4">
            <?php for ($index = 1; $index <= 64; $index++) : ?>
                <?php if ($index % 8 == 1) : ?>
                    <div class="row mb-2 justify-content-center">
                    <?php endif; ?>
                    <div class="col-1">
                        <input class="form-check-input w-100" type="checkbox" value="<?= $index ?>" id="Seat_<?= $index ?>" name="Seat_<?= $index ?>" <?= $seats[$index - 1] ? 'disabled' : '' ?>>
                        <label class="form-check-label text-center w-100" for="Seat_<?= $index ?>">
                            Seat <?= $index ?>
                        </label>
                    </div>
                    <?php if ($index % 8 == 0 || $index == 64) : ?>
                    </div>
                <?php endif; ?>
            <?php endfor; ?>
            <div class="row mt-4 justify-content-center">
                <input type="submit" value="Book Ticket" class="btn btn-primary w-50" disabled>
            </div>
        </div>
    </form>
</section>