<?php
class Index extends Controller
{
	public function index() {
        if(isset($_SESSION['user'])){
            $data = [];
            $db = new DB;
            $data['user_profile'] = $db->find('user_profile', ['id' => $session['id']]);

            $sql = "SELECT e.id,ep.first_name,ep.last_name,ep.middle_name, e.is_active, e.date_created
                    FROM user e 
                    LEFT JOIN user_profile ep
                        ON e.id = ep.id";

            $data['users'] = $db->select($sql);
            // $data['users'] = $db->find('user_profile');
            $data['title'] = 'MVC - User';
            $this->render->view('user/index', $data);
        }
	}
}