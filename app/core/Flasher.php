<?php

class Flasher {

    public static function setFlash($msg, $type)
    {
        $_SESSION['flash'] = [
            'msg' => $msg,
            'type' => $type,
        ];

    }

    public static function flash()
    {
        if( isset($_SESSION['flash']) ) {
            echo    '<div class="alert alert-'. $_SESSION['flash']['type'] .' alert-dismissible fade show w-50" role="alert">' 
                        . '<strong>' . $_SESSION['flash']['msg'] . '</strong>' . 
                        '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';

            unset($_SESSION['flash']);
        }
    }

}