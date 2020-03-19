<?php
use lib\Session;

class UserController extends Controller
{
    public function index()
    {
        $session = $_SESSION['User'];
        $data = [];
        if($session){
            $db = new DB;
            $data = $db->find('user_profile', ['id' => $session['id']]);
            $data['users'] = $db->find('user_profile');
            $data['title'] = 'MVC - User';
        }
        $this->render->view('user/index', $data);
    }

	public function delete() {
        $id = $_GET['id'];
        $db = new DB;
        $user = $db->find('user_profile', ['id' => $id]);
        $oldData = $user[0]['is_active'];
        $status = ($user[0]['is_active'] == 1) ? 0 : 1;

        $data['id'] = $id;
        $data['is_active'] = $status;
        $result = $db->update('user_profile', $data);

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
?>