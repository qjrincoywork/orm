<?php

class AlgorithmController extends Controller
{
    public function index()
    {
        $data = [];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $values = $_POST;
            $data['sample'] = $values['email'];
            if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
                $data['error'] = "Invalid email format";
            } else {
                $username = substr($values['email'], 0, strpos($values['email'], '@'));
                if (strpos($username, ".") !== false) {
                    $res = explode('.', $username);
                    $username = '';
                    foreach ($res as $v) {
                        $username .= $v[0];
                    }
                    $data['result'] = $username;
                } else {
                    $data['result'] = $username;
                }
            }
        }
        
        $data['title'] = 'MVC - Algorithm';
        $this->render->view('algo/index', $data);
    }

    public function strmanipulation()
    {
        $data = [];
        $string = "testasd";
        $tmp = [];
        $i = 0;
        
        while (isset($string[$i])){
            $tmp[$string[$i]] = $i;
            $i++;
        }
        
        $result = '';
        foreach ($tmp as $k => $v) {
            $result .= $k;
        }
        $data['sample'] = $string;
        $data['result'] = $result;
        echo json_encode($data);
    }
}
?>