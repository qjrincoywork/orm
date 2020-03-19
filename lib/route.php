<?php
use lib\View;
use lib\Session;
class Route
{
    public function __construct() {
		Session::init();
        $link = isset($_GET['url']) ? $_GET['url'] : null;
		$url = explode('/',trim($link,'/'));
		
		$controller = $url[0] != '' ? $url[0]. 'Controller' : 'indexController';
		$function = isset($url[1]) ? $url[1] : 'index';
		
        $path = "app/controller/". $controller. ".php";
		
        $function = isset($url[1]) ? $url[1] : 'index';
        
		if(!Session::getSession('User') && $url[0] != 'User')
		{
            $controller = 'HomeController';
			$path = 'app/controller/' . $controller . '.php';
		}
		
		if(file_exists($path))
		{
			require $path;
			if(class_exists($controller)) {
				if(method_exists($controller,$function)){
					if(isset($arrayLink[2])){
						$cont = new $controller();
						$cont->$function($arrayLink[2]);
					} else {
						$cont = new $controller();
						$cont->$function();
					}
				} else {
					$this->error();
				}
			} else {
				$this->error();
			}
		} else {
			$this->error();
		}
    }

	public function error(){
        $views = new View();
		$views->view('error/index');
		exit;
    }
}


?>