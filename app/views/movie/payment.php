<section class="d-flex flex-column align-items-center justify-content-center vh-100">
    <div class="card w-50 px-3 shadow mb-3" style="border-radius: 1rem;">
        <div class="card-body d-flex flex-column align-items-center justify-content-center ">
            <h3 class="card-title mb-4"><?= $movie['title'] ?></h3>
            <h4 class="mb-2">Your Balance</h4>
            <h5 class ="mb-4">Rp<?= $balance ?></h5>

            <h5 class="mb-2"><?php foreach ($seats as $index =>$seat ) echo "Seat $seat " ?></h5>
            <h5 class="mb-4">Total : <?= count($seats) * $movie['ticket_price'] ?></h5>
            <a class="btn btn-primary w-50" href="<?= BASEURL ?>Ticket/bookTicket" role="button">Pay</a>
        </div>
    </div>
</section>