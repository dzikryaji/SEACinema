<section class="d-flex flex-column align-items-center justify-content-center vh-100">
    <div class="card w-25 px-3 shadow mb-3" style="border-radius: 1rem;">
        <div class="card-body d-flex flex-column align-items-center justify-content-center ">
            <h2 class="card-title mb-2">Your Balance</h2>
            <h3 class ="mb-5">Rp<?= $balance ?></h3>

            <form action="<?= BASEURL; ?>Account/Withdraw" method="post" class="w-100 mb-3">
                <div class="mb-3">
                    <label for="withdraw">Withdraw Amount</label>
                    <input class="form-control w-100" type="number" name="withdraw" id="withdraw" placeholder="Rp" min="0" max="<?= $balance > 500000 ? 500000 : $balance ?>">
                </div>
                <input class="btn btn-primary w-100" type="submit" value="Withdraw">
            </form>
        </div>
    </div>
</section>