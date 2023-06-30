<?php

class User extends Controller{
    public function login()
    {
        $data['judul'] = 'Login';
        $this->view('templates/header', $data);
        $this->view('user/login', $data);
        $this->view('templates/footer');
    }

    public function signUp()
    {
        $data['judul'] = 'Sign Up';
        $this->view('templates/header', $data);
        $this->view('user/signup', $data);
        $this->view('templates/footer');
    }
}