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
                        <img src="<?= $movie['poster_url'] ?>" class="img-thumbnail w-100">
                        <div class="py-2 px-2">
                            <h4><?= $movie['title'] ?></h6>
                                <h6>Rp<?= $movie['ticket_price'] ?></h6>
                        </div>
                    </a>
                </div>
                <?php if ($index % 4 == 3 || $index + 1 == count($movies)) : ?>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <div class="d-flex align-items-center justify-content-center w-100">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                    <a class="page-link" aria-label="Previous" <?= $currentPage == $totalPages ? 'tabindex="-1" aria-disabled="true"' : 'href="' . BASEURL . "Home/Index/" . $currentPage - 1 . '"' ?>>
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= $currentPage == $i ? 'active' : '' ?>">
                        <a class="page-link" href="<?= BASEURL . "Home/Index/" . $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link" aria-label="Next" <?= $currentPage == $totalPages ? 'tabindex="-1" aria-disabled="true"' : 'href="' . BASEURL . "Home/Index/" . $currentPage + 1 . '"' ?>>
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</section>