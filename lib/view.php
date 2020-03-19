<?php
namespace lib;

class View
{
    public function view($filename, $data = null) {
        if(Session::getSession('User')) {
            require_once 'app/view/layouts/header.php';
            require_once "app/view/". $filename. ".php";
            require_once 'app/view/layouts/footer.php';
        } else {
            require_once 'app/view/layouts/loginHeader.php';
            require_once "app/view/". $filename. ".php";
            require_once 'app/view/layouts/loginFooter.php';
        }
    }
}
?>