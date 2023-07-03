<?php

class Ticket extends Controller
{
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
        if($seats){
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
        if ($balance) {
            $totalCost = $movie->ticket_price * count($_SESSION['book']['seats']);

            if($balance['balance'] > $totalCost){
                $this->model('BalanceModel')->substractBalance($totalCost);
                $seats = $this->model('SeatsModel')->getSeatsByIdMovie($_SESSION['book']['id_movie']);
                foreach ($_SESSION['book']['seats'] as  $seat) {
                    $seats['seats'][$seat - 1] = 1;
                }

                $this->model('SeatsModel')->upadateSeats($seats);

                header("Location: " . BASEURL );
                exit;
            } else {
                $msg =  "Insufficient Balance";
                Flasher::setFlash($msg, 'danger');
                header("Location: " . BASEURL . "Balance");
                exit;
            }
        } else {
            $msg =  "Insufficient Balance";
            Flasher::setFlash($msg, 'danger');
            header("Location: " . BASEURL . "Balance");
            exit;
        }
    }
}
