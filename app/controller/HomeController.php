<?php
use lib\Session;

class HomeController extends Controller
{
    public function index()
    {
        $data['title'] = 'MVC - Home';
        $this->render->view('home/index', $data);
    }
    
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $values = $_POST;
            if ($values['username'] == '' || $values['password'] == '') {
                $data['error'] = 'Username or Password can not be empty.';
            } else {
                $db = new DB;
                $user = $db->find('user', ['username' => $values['username']]);
                
                if ($user) {
                    $data['error'] = 'User Exists';
                } else {
                    $db = new DB;
                    $user = $this->run->model('user');
                    $user->setUsername($values['username']);
                    $user->setPassword($values['password']);
                    $user->setIs_active(1);
                    $res = $db->insert($user);
                    if($res) {
                        $userProfile = $this->run->model('userprofile');
                        $userProfile->setEmail($values['email']);
                        $userProfile->setMobile_number($values['mobile_number']);
                        $userProfile->setLast_name($values['lastname']);
                        $userProfile->setFirst_name($values['firstname']);
                        $userProfile->setMiddle_name($values['middlename']);
                        $userProfile->setSuffix($values['suffix']);
                        $userProfile->setIs_active(1);
                        $result = $db->insert($userProfile);
                        if($result)
                            $data['success'] = 'User Added';
                    }
                }
            }
        }
        
        $data['title'] = 'MVC - Home';
        $this->render->view('home/index', $data);
    }

    public function login() 
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $values = $_POST;
            if ($values['username'] == '' || $values['password'] == '') {
                $data['error'] = 'Username or Password can not be empty.';
            } else {
                $db = new DB;
                $user = $db->find('user', ['username' => $values['username']]);
                
                if ($user) {
                    if($user[0]['is_active']) {
                        if($values['password'] == $user[0]['password']){
                            Session::setSession('User',$user[0]);
                            header("location: ".URL."/User");
                            exit;
                        } else {
                            $data['error'] = 'Wrong password.';
                        }
                    } else {
                        $data['error'] = 'Your account is deactivated.';
                    }
                } else {
                    $data['error'] = 'User Does not Exists';
                }
            }
        }
        
        $data['title'] = 'MVC - Home';
        $this->render->view('home/index', $data);
    }
}
?>