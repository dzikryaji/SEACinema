<?php

class Ticket extends Controller
{
    public function book($id)
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
        $this->view('Ticket/Book', $data, 'Ticket/Book');
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
