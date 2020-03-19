<?php
define("URL", "http://$_SERVER[HTTP_HOST]");

define('DATABASE_HOST','localhost');
define('DATABASE_USER','root');
define('DATABASE_PASS','');
define('DATABASE_NAME','yns');

include_once "lib/session.php";
include_once "lib/database.php";
include_once "lib/view.php";
include_once "lib/route.php";
include_once "lib/controller.php";
include_once "lib/model.php";

class Index 
{
    public function __construct() {
        new Route();
    }
}

new Index();
