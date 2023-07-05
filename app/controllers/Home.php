<?php

class Home extends Controller{
    public function index()
    {
        $data['title'] = 'Home';
        $json = file_get_contents('https://seleksi-sea-2023.vercel.app/api/movies');
        $data['movies'] = json_decode($json, true);
        $this->view('home/index', $data);
    }
}