<section class="d-flex flex-column align-items-center justify-content-center vh-100">
    <?php Flasher::flash(); ?>
    <div class="card w-25 px-3 shadow mb-3 bg-secondary" style="border-radius: 1rem;">
        <div class="card-body d-flex flex-column align-items-center justify-content-center ">
            <h2 class="card-title mb-2">Your Balance</h2>
            <h3 class="mb-5">Rp<?= $balance ?></h3>
            <a class="btn btn-primary mb-2 w-100" href="<?= BASEURL; ?>Account/TopUp">Top Up</a>
            <?php if ($balance > 0) : ?>
                <a class="btn btn-outline-primary w-100" href="<?= BASEURL; ?>Account/Withdraw">Withdraw</a>
            <?php else : ?>
                <button class="btn btn-outline-primary w-100" disabled>Withdraw</button>
            <?php endif; ?>
        </div>
    </div>
</section>