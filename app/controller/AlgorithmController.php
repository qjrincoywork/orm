<?php

class AlgorithmController extends Controller
{
    public function index()
    {
        /* if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $data['error'] = "Invalid email format";
        }
        
        $username = substr($email, 0, strpos($email, '@'));
        if (strpos($username, ".") !== false) {
            $res = explode('.', $username);
            $username = '';
            foreach ($res as $v) {
                $username .= $v[0];
            }
            return $username;
        } else {
            return $username;
        } */
        $data['title'] = 'MVC - Algorithm';
        $this->render->view('algo/index', $data);
    }

    public function therapists()
    {
        $db = new DB;
        $sql = "SELECT t.id, t.name, d.target_date, d.start_time, d.end_time,
                    CASE
                        WHEN d.start_time <= '05:59:59' THEN CONVERT(CONCAT(DATE_ADD(d.target_date, INTERVAL 1 DAY), ' ', d.start_time), DATETIME)
                        ELSE CONVERT(CONCAT(d.target_date, ' ', d.start_time), DATETIME)
                    END work_schedule
                FROM therapists t
                INNER JOIN daily_work_shifts d
                    ON t.id = d.therapist_id
                ORDER BY work_schedule";
        
        $data['data'] = $db->select($sql);
        echo json_encode($data);
    }

    public function positions()
    {
        $db = new DB;
        $sql = "SELECT e.id,e.first_name,e.last_name,e.middle_name,
                    CASE
                        WHEN p.id = 1 THEN 'Chief Executive officer'
                        WHEN p.id = 2 THEN 'Chief Technical officer'
                        WHEN p.id = 3 THEN 'Chief Financial officer'
                        ELSE p.name
                    END position_name
                    FROM employees e 
                    LEFT JOIN employee_positions ep
                        ON e.id = ep.employee_id
                    LEFT JOIN positions p
                        ON ep.position_id = p.id";
        
        $data['data'] = $db->select($sql);
        echo json_encode($data);
    }

    public function logic()
    {
        $db = new DB;
        $sql = "SELECT * FROM logic_table l 
                    WHERE l.id IS NOT NULL 
                    ORDER BY l.parent_id , l.id";
        
        $data['data'] = $db->select($sql);
        echo json_encode($data);
    }
}



?>