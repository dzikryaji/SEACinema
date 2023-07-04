<section class="d-flex flex-column align-items-center p-3">
    <?php Flasher::flash(); ?>
    <div class="d-flex flex-column align-items-center w-100 min-vh-100 <?= $tickets ? 'p-5' : 'justify-content-center' ?>">
        <?php if ($tickets) : ?>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Movie</th>
                        <th scope="col">Seats</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tickets as $index => $ticket) : ?>
                        <tr>
                            <th scope="row" class="align-middle"><?= $index + 1 ?></th>
                            <td class="align-middle"><?= $ticket['title'] ?></td>
                            <td class="align-middle"><?php foreach ($ticket['seats'] as $i => $seat) {
                                                            echo $i < count($ticket['seats']) - 1 ? "Seat $seat, " : "Seat $seat";
                                                        } ?></td>
                            <td class="align-middle"><a class="btn btn-danger" href="<?= BASEURL . 'Ticket/Cancel/' . $ticket['id_movie'] ?>" role="button">Cancel</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <h1 class="text-secondary">You dont have any tickets at the momment</h1>
        <?php endif; ?>
    </div>
</section>