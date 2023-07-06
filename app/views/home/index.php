<section>
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="text-uppercase">Movies</h1>
            </div>
            <?php foreach ($movies as $index => $movie) : ?>
                <?php if ($index % 4 == 0) : ?>
                    <div class="row g-4 mb-4">
                    <?php endif; ?>
                    <div class="col-lg-3 col-md-6 wow fadeInUp" data-wow-delay="<?= "0." . ($index % 4) + 1 . "s" ?>">
                        <div class="team-item">
                            <div class="team-img position-relative overflow-hidden">
                                <img class="img-fluid" src="<?= $movie['poster_url'] ?>" alt="Movie Poster">
                                <div class="team-social">
                                    <a class="btn btn-primary" href="<?= BASEURL . "Movie/MovieDetail/" . $index ?>">Details</a>
                                </div>
                            </div>
                            <div class="bg-secondary text-center p-4" style="height: 7.5rem;">
                                <h5 class="text-uppercase"><?= $movie['title'] ?></h5>
                                <span class="text-primary"><?= "Age Rating : ". $movie['age_rating'] . "+" ?></span>
                            </div>
                        </div>
                    </div>
                    <?php if ($index % 4 == 3 || $index + 1 == count($movies)) : ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="d-flex align-items-center justify-content-center w-100 wow fadeInUp mt-5" data-wow-delay="0.1s">
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <li class="page-item <?= $currentPage == 1 ? 'disabled' : '' ?>">
                    <a class="page-link bg-secondary border-secondary" aria-label="Previous" <?= $currentPage == $totalPages ? 'tabindex="-1" aria-disabled="true"' : 'href="' . BASEURL . "Home/Index/" . $currentPage - 1 . '"' ?>>
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                    <li class="page-item <?= $currentPage == $i ? 'active' : '' ?>">
                        <a class="page-link <?= $currentPage == $i ? '' : 'bg-secondary border-secondary' ?>" href="<?= BASEURL . "Home/Index/" . $i ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?= $currentPage == $totalPages ? 'disabled' : '' ?>">
                    <a class="page-link bg-secondary border-secondary" aria-label="Next" <?= $currentPage == $totalPages ? 'tabindex="-1" aria-disabled="true"' : 'href="' . BASEURL . "Home/Index/" . $currentPage + 1 . '"' ?>>
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</section>