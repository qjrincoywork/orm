<?php
use lib\Session;

class User extends Controller
{
    public function index()
    {
        $data = [];
        if(isset($_SESSION['user'])){
            $session = $_SESSION['user'];
            $db = new DB;
            $data['user_profile'] = $db->find('user_profile', ['id' => $session['id']]);

            $sql = "SELECT u.id,up.first_name,up.last_name,up.middle_name, u.is_active, u.date_created
                    FROM user u
                    LEFT JOIN user_profile up
                        ON u.id = up.user_id";
                        
            $data['users'] = $db->select($sql);
            // $data['users'] = $db->find('user_profile');
            $data['title'] = 'MVC - User';
        }
        $this->render->view('user/index', $data);
    }

	public function delete() {
        $id = $_GET['id'];
        $db = new DB;
        $user = $db->find('user', ['id' => $id]);
        $oldData = $user[0]['is_active'];
        $status = ($user[0]['is_active'] == 1) ? 0 : 1;

        $data['id'] = $id;
        $data['is_active'] = $status;
        $result = $db->update('user', $data);

		header("location: ".URL."/user");
    }
    
    public function edit()
    {
        $id = $_GET['id'];
        $data = [];
        $db = new DB;
        $data = $db->find('user_profile', ['id' => $id]);
        $this->render->view('user/edit', $data);
    }

	public function logout() {
		Session::destroy();
		header("location: ".URL);
	}
}