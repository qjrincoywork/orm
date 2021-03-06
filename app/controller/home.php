<?php
use lib\Session;
class Home extends Controller
{
    public function index()
    {
        $data['title'] = 'MVC - Home';
        $this->render->view('home/index', $data);
    }
    
    public function register()
    {
        $db = new DB;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $values = $_POST;
            if ($values['username'] == '' || $values['password'] == '') {
                $data['error'] = 'Username or Password can not be empty.';
            } else {
                $user = $db->find('user', ['username' => $values['username']]);
                if ($user) {
                    $data['error'] = 'Username Exists';
                } else {
                    $user = $this->run->model('User');
                    $user->setUsername($values['username']);
                    $user->setPassword($values['password']);
                    $user->setIs_active(1);
                    $res = $db->insert($user);
                    if($res) {
                        $userProfile = $this->run->model('UserProfile');
                        $userProfile->setUser_id($res);
                        $userProfile->setEmail($values['email']);
                        $userProfile->setMobile_number($values['mobile_number']);
                        $userProfile->setLast_name($values['lastname']);
                        $userProfile->setFirst_name($values['firstname']);
                        $userProfile->setMiddle_name($values['middlename']);
                        $userProfile->setSuffix($values['suffix']);
                        $userProfile->setIs_active(1);
                        $result = $db->insert($userProfile);
                        if($result)
                            Session::setSession('user', ['id' => $res, 'username' => $values['username']]);
                            $data['success'] = 'User Successfully Added';
                            header("location: ".URL."/user");
                    } else {
                        $data['error'] = 'Unable to save User';
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
                            Session::setSession('user',$user[0]);
                            header("location: ".URL."/user");
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
    
    public function removeHtmlTagsOfFields(array $inputs, array $excepts = null)
    {
        $inputOriginal = $inputs;

        $inputs = array_except($inputs, $excepts);

        foreach ($inputs as $index => $in) {
            $inputs[$index] = strip_tags($in);
        }

        if (!empty($excepts)) {

            foreach ($excepts as $except) {
                $inputs[$except] = $inputOriginal[$except];
            }
        }

        return $inputs;
    }
}