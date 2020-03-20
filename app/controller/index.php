<?php
class Index extends Controller
{
	public function index() {
        if(isset($_SESSION['user'])){
            $data = [];
            $db = new DB;
            $data['user_profile'] = $db->find('user_profile', ['id' => $session['id']]);

            $sql = "SELECT u.id,up.first_name,up.last_name,up.middle_name, u.is_active, u.date_created
                    FROM user u
                    LEFT JOIN user_profile up
                        ON u.id = up.user_id";

            $data['users'] = $db->select($sql);
            // $data['users'] = $db->find('user_profile');
            $data['title'] = 'MVC - User';
            $this->render->view('user/index', $data);
        }
	}
}