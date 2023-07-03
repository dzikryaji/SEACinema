<?php

class Balance extends Controller
{
    public function index()
    {
        if (!isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }

        $data['title'] = 'Balance';
        $data['balance'] = $this->model('BalanceModel')->getBalancebyIdAccount($_SESSION['account']['id']);
        $this->view('balance/index', $data);
    }

    public function topUp()
    {
        if (!isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if ($this->model('BalanceModel')->getBalancebyIdAccount($_SESSION['account']['id'])) {
                $this->model('BalanceModel')->addBalance($_POST);
            } else {
                $this->model('BalanceModel')->createBalance($_POST);
            }
            header("Location: " . BASEURL . "Balance");
            exit;
        } else {
            $data['title'] = 'Top Up';
            $data['balance'] = $this->model('BalanceModel')->getBalancebyIdAccount($_SESSION['account']['id']);
            $this->view('balance/topUp', $data);
        }
    }


    public function withdraw()
    {
        if (!isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model('BalanceModel')->substractBalance($_POST);
            header("Location: " . BASEURL . "Balance");
            exit;
        } else {
            $data['title'] = 'Withdraw';
            $data['balance'] = $this->model('BalanceModel')->getBalancebyIdAccount($_SESSION['account']['id']);
            $this->view('balance/withdraw', $data);
        }
    }
}
