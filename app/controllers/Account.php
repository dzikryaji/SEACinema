<?php

class Account extends Controller
{
    public function login()
    {
        if (isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $account = $this->model('AccountModel')->getAccountbyUsername($_POST['username']);

            if ($account && password_verify($_POST['password'], $account['password_hash'])) {
                $_SESSION["account"] = $account;

                header("Location: " . BASEURL);
                exit;
            } else {
                $msg =  "Incorrect Username or Password";
                Flasher::setFlash($msg, 'danger');
                header("Location: " . BASEURL . "Account/Login");
                exit;
            }
        } else {
            $data['title'] = 'Login';
            $this->view('account/login', $data);
        }
    }

    public function signUp()
    {
        if (isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($_POST["name"])) {
                $msg = "Name is required";
            } else  if (empty($_POST["username"])) {
                $msg = "Name is required";
            } else  if (empty($_POST["age"])) {
                $msg = "Name is required";
            } else if (strlen($_POST["password"]) < 8) {
                $msg = "Password must be at least 8 characters";
            } else if ($_POST["password"] !== $_POST["password_confirmation"]) {
                $msg = "Passwords must match";
            }

            if (isset($msg)) {
                Flasher::setFlash($msg, 'danger');
                header("Location: " . BASEURL . "Account/SignUp");
                exit;
            }

            try {
                $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $data = $_POST;
                $data['password_hash'] = $password_hash;
                if ($this->model('AccountModel')->createAccount($data) > 0) {
                    $this->login();
                } else {
                    $msg = "Failed to create an account";
                    Flasher::setFlash($msg, 'danger');
                    header("Location: " . BASEURL . "Account/SignUp");
                    exit;
                }
            } catch (Exception $e) {
                $msg = $e->getMessage();
                Flasher::setFlash($msg, 'danger');
                header("Location: " . BASEURL . "Account/SignUp");
                exit;
            }
        } else {
            $data['title'] = 'Sign Up';
            $this->view('account/signup', $data);
        }
    }

    public function logout()
    {
        if (!isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }

        session_destroy();

        header("Location: " . BASEURL);
        exit;
    }

    public function balance()
    {
        if (!isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }

        $data['title'] = 'Balance';
        $data['balance'] = $_SESSION['account']['balance'];
        $this->view('account/balance', $data);
    }

    public function topUp()
    {
        if (!isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->model('AccountModel')->addBalance($_POST['topUp']);
            $_SESSION['account']['balance'] = $_SESSION['account']['balance'] + $_POST['topUp'];
            try {
                $msg = "Top Up Rp" . $_POST['topUp'] . ' Success';
                Flasher::setFlash($msg, "success");
            } catch (Exception $e) {
                $msg = "Top Up Rp" . $_POST['topUp'] . ' Failed';
                Flasher::setFlash($msg, "danger");
            } finally {
                header("Location: " . BASEURL . "Account/Balance");
                exit;
            }
        } else {
            $data['title'] = 'Top Up';
            $data['balance'] = $_SESSION['account']['balance'];
            $this->view('account/topUp', $data);
        }
    }


    public function withdraw()
    {
        if (!isset($_SESSION['account'])) {
            header("Location: " . BASEURL);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $this->model('AccountModel')->substractBalance($_POST['withdraw']);
                $_SESSION['account']['balance'] = $_SESSION['account']['balance'] - $_POST['withdraw'];
                $msg = "Withdraw Rp" . $_POST['withdraw'] . ' Success';
                Flasher::setFlash($msg, "success");
            } catch (Exception $e) {
                $msg = "Withdraw Rp" . $_POST['withdraw'] . ' Failed';
                Flasher::setFlash($msg, "danger");
            } finally {
                header("Location: " . BASEURL . "Account/Balance");
                exit;
            }
        } else {
            $data['title'] = 'Withdraw';
            $data['balance'] = $_SESSION['account']['balance'];
            $this->view('account/withdraw', $data);
        }
    }
}
