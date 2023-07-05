<?php

class Movie extends Controller{
    public function movieDetail($id)
    {
        $data['title'] = 'Movie Details';
        $json = file_get_contents('https://seleksi-sea-2023.vercel.app/api/movies');
        $movies = json_decode($json, true);
        $data['movie'] = $movies[$id];
        $data['movie']['id'] = $id;
        $this->view('movie/movieDetails', $data);
    }

    public function seats($id)
    {
        if (!isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }

        $data['title'] = 'Book Ticket';
        $json = file_get_contents('https://seleksi-sea-2023.vercel.app/api/movies');
        $movies = json_decode($json, true);
        $data['movie'] = $movies[$id];
        $data['movie']['id'] = $id;

        $seats = $this->model('SeatsModel')->getSeatsByIdMovie($id);
        if ($seats) {
            $data['seats'] = $seats['seats'];
        } else {
            $data['seats'] = $this->model('SeatsModel')->createSeats($id);
        }

        $this->view('Movie/Seats', $data, 'Movie/Seats');
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
        $movies = json_decode($json, true);
        $data['movie'] = $movies[$id];
        $data['movie']['id'] = $id;

        $_SESSION['book'] = ['id_movie' => $id, 'seats' => $_POST];

        $data['balance'] = $_SESSION['account']['balance'];
        $this->view('Movie/Payment', $data);
    }
}