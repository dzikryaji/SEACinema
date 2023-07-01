<?php

class Movie extends Controller{
    public function MovieDetail($id)
    {
        $data['title'] = 'Movie Details';
        $json = file_get_contents('https://seleksi-sea-2023.vercel.app/api/movies');
        $movies = json_decode($json);
        $data['movie'] = $movies[$id];
        $this->view('movie/movieDetails', $data);
    }
}