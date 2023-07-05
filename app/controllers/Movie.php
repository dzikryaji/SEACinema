<?php

class Movie extends Controller{
    public function movieDetail($id)
    {
        $data['title'] = 'Movie Details';
        $json = file_get_contents('https://seleksi-sea-2023.vercel.app/api/movies');
        $movies = json_decode($json, true);

        $dates = [];
        for ($i = 1; $i <= 7; $i++) {
            $plusDay = "+$i days";
            $dates[] = date("Y-m-d", strtotime($plusDay));
        }

        $showtimes = ['13:00', '16:00', '19:00'];

        $data['movie'] = $movies[$id];
        $data['movie']['id'] = $id;
        $data['dates'] = $dates;
        $data['showtimes'] = $showtimes;
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
        $data['date'] = date("d F Y", strtotime($_POST['date']));
        $data['showtime'] = $_POST['showtime'];

        $seats = $this->model('SeatsModel')->getSeats($id, $_POST['date'], $_POST['showtime']);
        if ($seats) {
            $data['seats'] = $seats['seats'];
        } else {
            $data['seats'] = $this->model('SeatsModel')->createSeats($id, $_POST['date'], $_POST['showtime']);
        }

        $this->view('Movie/Seats', $data, 'Movie/Seats');
    }

    public function payment($id)
    {
        if (!isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }
        $date = date("Y-m-d", strtotime($_POST['date']));
        $showtime = $_POST['showtime'];
        $seats = $this->model('SeatsModel')->getSeats($id, $date, $showtime);

        $data['title'] = 'Payment';
        $data['date'] = $_POST['date'];
        unset($_POST['date']);
        $data['showtime'] = $_POST['showtime'];
        unset($_POST['showtime']);
        $data['seats'] = $_POST;

        $json = file_get_contents('https://seleksi-sea-2023.vercel.app/api/movies');
        $movies = json_decode($json, true);
        $data['movie'] = $movies[$id];
        $data['movie']['id'] = $id;

        $_SESSION['book'] = ['id_movie' => $id, 'id_seats' => $seats['id_seats'], 'seats' => $_POST];

        $data['balance'] = $_SESSION['account']['balance'];
        $this->view('Movie/Payment', $data);
    }
}