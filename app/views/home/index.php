<section class="d-flex flex-column justify-content-center align-items-center px-5 py-3">
    <div class="w-100">
        <div class="mb-5 ms-5 ps-5">
            <h1>SEA Cinema</h1>
        </div>
    </div>
    <div class="container-fluid px-5">
        <?php foreach ($movies as $index => $movie) : ?>
            <?php if ($index % 4 == 0) : ?>
                <div class="row mb-4">
                <?php endif; ?>
                <div class="col-lg-3 col-md-6">
                    <a class="link-dark text-decoration-none" href="<?= BASEURL . "Movie/MovieDetail/" . $index ?>">
                        <img src="<?= $movie->poster_url ?>" class="img-thumbnail w-100">
                        <div class="py-2 px-2">
                            <h4><?= $movie->title ?></h6>
                            <h6>Rp<?= $movie->ticket_price ?></h6>
                        </div>
                    </a>
                </div>
                <?php if ($index % 4 == 3 || $index + 1 == count($movies)) : ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</section>