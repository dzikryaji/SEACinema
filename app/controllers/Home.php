<?php

class Home extends Controller{
    public function index($id = 1)
    {
        $data['title'] = 'Home';
        $json = file_get_contents('https://seleksi-sea-2023.vercel.app/api/movies');
        $movies = json_decode($json, true);

        $perPage = 12;
        $currentPage = $id;
        $totalMovies = count($movies);
        $totalPages = ceil($totalMovies / $perPage);
        $start = ($currentPage - 1) * $perPage;
        $data['movies'] = array_slice($movies, $start, $perPage, true);
        $data['totalPages'] = $totalPages;
        $data['currentPage'] = $currentPage;

        $this->view('home/index', $data);
    }
}