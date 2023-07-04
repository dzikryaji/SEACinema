<?php

class Ticket extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }

        $json = file_get_contents('https://seleksi-sea-2023.vercel.app/api/movies');
        $movies = json_decode($json, true);
        $tickets = $this->model('TicketModel')->getTicketbyIdAccount($_SESSION['account']['id']);

        foreach ($tickets as $index => $ticket) {
            $tickets[$index] = array_merge($ticket, $movies[$ticket['id_movie']]);
            $seats = [];
            for ($i = 0; $i < strlen($tickets[$index]['seats']); $i++) {
                if ($tickets[$index]['seats'][$i]) {
                    $seats[] = $i + 1;
                }
            }
            $tickets[$index]['seats'] = $seats;
        }
        $data['tickets'] = $tickets;
        $data['title'] = "Your Ticket";
        $this->view('Ticket/Index', $data);
    }

    public function seats($id)
    {
        if (!isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }

        $data['title'] = 'Book Ticket';
        $json = file_get_contents('https://seleksi-sea-2023.vercel.app/api/movies');
        $movies = json_decode($json);
        $data['movie'] = $movies[$id];
        $data['movie']->id = $id;

        $seats = $this->model('SeatsModel')->getSeatsByIdMovie($id);
        if ($seats) {
            $data['seats'] = $seats['seats'];
        } else {
            $data['seats'] = $this->model('SeatsModel')->createSeats($id);
        }

        $this->view('Ticket/Seats', $data, 'Ticket/Seats');
    }

    public function payment($id)
    {
        if (!isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }

        $data['title'] = 'Payment';

        $data['seats'] = $_POST;

        $json = file_get_contents('https://seleksi-sea-2023.vercel.app/api/movies');
        $movies = json_decode($json);
        $data['movie'] = $movies[$id];
        $data['movie']->id = $id;

        $_SESSION['book'] = ['id_movie' => $id, 'seats' => $_POST];

        $data['balance'] = $this->model('BalanceModel')->getBalancebyIdAccount($_SESSION['account']['id']);
        $this->view('Ticket/Payment', $data);
    }

    public function bookTicket()
    {
        if (!isset($_SESSION['account']) || !isset($_SESSION['book'])) {
            header("Location: " . BASEURL);
            exit;
        }

        $json = file_get_contents('https://seleksi-sea-2023.vercel.app/api/movies');
        $movies = json_decode($json);
        $movie = $movies[$_SESSION['book']['id_movie']];

        $balance = $this->model('BalanceModel')->getBalancebyIdAccount($_SESSION['account']['id']);
        $totalCost = $movie->ticket_price * count($_SESSION['book']['seats']);
        if ($balance || $balance['balance'] > $totalCost) {

            $db = new Database;
            $db->beginTransaction();
            try {
                $seatsMovie = $this->model('SeatsModel')->getSeatsByIdMovie($_SESSION['book']['id_movie']);
                $seatsTicket = '';
                for ($i = 0; $i < 64; $i++) {
                    $seatsTicket .= 0;
                }

                foreach ($_SESSION['book']['seats'] as  $seat) {
                    $seatsMovie['seats'][$seat - 1] = 1;
                    $seatsTicket[$seat - 1] = 1;
                }

                $this->model('BalanceModel')->substractBalance($totalCost);
                $this->model('SeatsModel')->updateSeats($seatsMovie);
                $this->model('TicketModel')->setTicket($_SESSION['account']['id'], $_SESSION['book']['id_movie'], $seatsTicket);
                $db->commit();

                $msg =  "Ticket Purchased";
                Flasher::setFlash($msg, 'success');
            } catch (Exception $e) {
                $db->rollback();
                $msg =  "Failed to purchase ticket";
                Flasher::setFlash($msg, 'danger');
            } finally {
                header("Location: " . BASEURL . "Ticket");
                exit;
            }
        } else {
            $msg =  "Insufficient Balance";
            Flasher::setFlash($msg, 'danger');
            header("Location: " . BASEURL . "Balance");
            exit;
        }
    }

    public function cancel($idMovie)
    {
        if (!isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }
        $db = new Database;
        $json = file_get_contents('https://seleksi-sea-2023.vercel.app/api/movies');
        $movies = json_decode($json, true);
        $movie = $movies[$idMovie];

        try {
            $db->beginTransaction();

            $ticket = $this->model('TicketModel')->getTicketbyIdAccountAndIdMovie($_SESSION['account']['id'], $idMovie);
            $seats = $this->model('SeatsModel')->getSeatsByIdMovie($idMovie);

            $refund = 0;
            for ($i = 0; $i < strlen($ticket['seats']); $i++) {
                if ($ticket['seats'][$i]) {
                    $seats['seats'][$i] =  0;
                    $refund += $movie['ticket_price'];
                }
            }

            $this->model('SeatsModel')->updateSeats($seats);
            $this->model('TicketModel')->deleteTicket($_SESSION['account']['id'], $idMovie);
            $this->model('BalanceModel')->addBalance($refund);

            $db->commit();
            $msg = "Balance Refunded : Rp" . $refund;
            Flasher::setFlash($msg, "success");
            header("Location: " . BASEURL . "Ticket");
            exit;
        } catch (Exception $e) {
            $db->rollback();
            $msg = "Ticket Cancellation Failed";
            Flasher::setFlash($msg, "danger");
            header("Location: " . BASEURL . "Ticket");
            exit;
        }
    }
}
