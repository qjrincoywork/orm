<?php
namespace lib;

class View
{
    public function view($filename, $data = null) {
        $path = "app/view/". $filename. ".php";
        if(Session::getSession('user')) {
            require_once 'app/view/layouts/header.php';
            require_once $path;
            require_once 'app/view/layouts/footer.php';
        } else {
            require_once 'app/view/layouts/loginHeader.php';
            require_once $path;
            require_once 'app/view/layouts/loginFooter.php';
        }
    }
}