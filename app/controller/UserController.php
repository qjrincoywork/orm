<?php
use lib\Session;

class UserController extends Controller
{
    public function index()
    {
        $data = [];
        if(isset($_SESSION['User'])){
            $db = new DB;
            $data['user_profile'] = $db->find('user_profile', ['id' => $session['id']]);

            $sql = "SELECT e.id,ep.first_name,ep.last_name,ep.middle_name, e.is_active, e.date_created
                    FROM user e 
                    LEFT JOIN user_profile ep
                        ON e.id = ep.id";

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

		header("location: ".URL."/User");
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
?>