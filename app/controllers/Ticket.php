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
        $data['activeTicket'] = 'active';
        $data['title'] = "Your Ticket";
        $this->view('Ticket/Index', $data);
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

        $balance = $_SESSION['account']['balance'];
        $totalCost = $movie->ticket_price * count($_SESSION['book']['seats']);
        if ($balance > $totalCost) {
            $db = new Database;
            $db->beginTransaction();
            try {
                $seatsMovie = $this->model('SeatsModel')->getSeatsByIdSeats($_SESSION['book']['id_seats']);
                $seatsTicket = '';
                for ($i = 0; $i < 64; $i++) {
                    $seatsTicket .= 0;
                }

                foreach ($_SESSION['book']['seats'] as  $seat) {
                    if(!($seatsMovie['seats'][$seat - 1])){
                        $seatsMovie['seats'][$seat - 1] = 1;
                        $seatsTicket[$seat - 1] = 1;
                    } else {
                        $msg =  "Failed to purchase ticket";
                        Flasher::setFlash($msg, 'danger'); 
                        unset($_SESSION['book']);
                        header("Location: " . BASEURL . "Ticket");
                        exit;
                    }
                }

                $this->model('SeatsModel')->updateSeats($seatsMovie);
                $this->model('TicketModel')->setTicket($_SESSION['account']['id'], $_SESSION['book']['id_movie'], $_SESSION['book']['id_seats'], $seatsTicket);
                $this->model('AccountModel')->substractBalance($totalCost);
                $_SESSION['account']['balance'] -= $totalCost;
                $db->commit();

                $msg =  "Ticket Purchased";
                Flasher::setFlash($msg, 'success');
            } catch (Exception $e) {
                $db->rollback();
                $msg =  "Failed to purchase ticket";
                Flasher::setFlash($msg, 'danger');
            } finally {
                unset($_SESSION['book']);
                header("Location: " . BASEURL . "Ticket");
                exit;
            }
        } else {
            $msg =  "Insufficient Balance";
            Flasher::setFlash($msg, 'danger');
            header("Location: " . BASEURL . "Account/Balance");
            exit;
        }
    }

    public function cancel($idSeats)
    {
        if (!isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }
        $db = new Database;
        
        try {
            $db->beginTransaction();
            
            $ticket = $this->model('TicketModel')->getTicketbyIdAccountAndIdSeats($_SESSION['account']['id'], $idSeats);
            $seats = $this->model('SeatsModel')->getSeatsByIdSeats($idSeats);
            $json = file_get_contents('https://seleksi-sea-2023.vercel.app/api/movies');
            $movies = json_decode($json, true);
            $movie = $movies[$seats['id_movie']];

            $refund = 0;
            for ($i = 0; $i < strlen($ticket['seats']); $i++) {
                if ($ticket['seats'][$i]) {
                    $seats['seats'][$i] =  0;
                    $refund += $movie['ticket_price'];
                }
            }

            $this->model('SeatsModel')->updateSeats($seats);
            $this->model('TicketModel')->deleteTicket($_SESSION['account']['id'], $idSeats);
            $this->model('AccountModel')->addBalance($refund);
            $_SESSION['account']['balance'] += $refund;

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
