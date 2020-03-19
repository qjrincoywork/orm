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
		/* if(file_exists($path)){
			require $path;
			$modelName = $name . '_model';
			$this->model = new $modelName();
		} */
    }
    
	/* public function loadModel($name){
		$path = 'model/' . $name . '_model.php';
		if(file_exists($path)){
			require $path;
			$modelName = $name . '_model';
			$this->model = new $modelName();
		}
	} */
}


?>