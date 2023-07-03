<?php

class Ticket extends Controller{
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
        $this->view('Ticket/Book', $data);
    }

    public function payment($id){
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

        $data['balance'] = $this->model('BalanceModel')->getBalancebyIdAccount($_SESSION['account']['id']);
        $this->view('Ticket/Payment', $data);
        // var_dump($data);
    }
}