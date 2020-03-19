<?php
use lib\Session;

class UserController extends Controller
{
    public function index()
    {
        if($_SESSION['User']){
            $db = new DB;
            $data = $db->find('user_profile', ['id' => $_SESSION['User']['id']]);
            $data['title'] = 'MVC - User';
            $this->render->view('user/index', $data);
        }
    }

	public function logout() {
		Session::destroy();
		header("location: ".URL);
	}
}



?>