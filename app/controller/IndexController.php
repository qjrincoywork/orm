<?php

class IndexController extends Controller
{
	public function index() {
        if($_SESSION['User']){
            $db = new DB;
            $data = $db->find('user_profile', ['id' => $_SESSION['User']['id']]);
            $data['title'] = 'MVC - User';
            $this->render->view('user/index', $data);
        }
	}
}
?>