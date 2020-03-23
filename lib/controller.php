<?php
use lib\View;
use lib\Model;

class Controller
{
    protected $render;
    protected $run;

    public function __construct() {
		try{
			$this->render = new View();
			$this->run = new Model();
		} catch (Exception $ex) {
			die($ex->getMessage()); 
		}
    }
}