<?php
    $middleInitial = isset($data[0]['middle_name']) ? ucfirst($data[0]['middle_name']) : null;
    $suffix = isset($data[0]['suffix']) ? ucfirst($data[0]['suffix']) : null;
?>
<div class="container pt-4">
    <div class="card">
        <div class="card-header">
            <strong class="card-title">Profile</strong>
        </div>
        <div class="card-body">
            <div class="col-md-6 offset-md-3">
                <dl class="row desc">
                    <?php
                        $profile = "";
                        $profile .= "<dt class='col-5'>Email Address</dt>";
                        $profile .= "<dd class='col-7'>". $data[0]['email'] ."</dd>";
                        $profile .= "<dt class='col-5'>Name</dt>";
                        $profile .= "<dd class='col-7'>". ucfirst($data[0]['last_name']) .', '. ucfirst($data[0]['first_name']) . ' ' .$middleInitial. ' ' .$suffix."</dd>";
                        $profile .= "<dt class='col-5'>Mobile Number</dt>";
                        $profile .= "<dd class='col-7'>". $data[0]['mobile_number'] ."</dd>";
                        echo $profile;
                    ?>
                </dl>
            </div>
        </div>
    </div>
    <div class="container pt-4">
    <?php
        if(isset($data['users'])){
            $table = '<table class="table table-striped" style="width:100%" ><tr>';
            $header = '';
            
            if(isset($data['users'][0]))
            {
                foreach ($data['users'][0] as $eKey => $eVal)
                {
                    $header .= "<th>".ucwords(str_replace('_', ' ', $eKey))."</th>";
                }
                $header .= "<th colspan=2>Actions</th>";
            }

            $header .= "</tr>";
            $table .= $header;
            $table .= "<tr><tbody>";
            foreach($data['users'] as $key => $employee) 
            {
                if($employee['is_active']) {
                    $actionClass = "confirm_delete_user";
                    $icon = "<i class='far fa-trash-alt'></i>";
                    $actionTitle = "Delete";
                    $employee['is_active'] = 'Active';
                } else {
                    $actionClass = "confirm_restore_user";
                    $icon = "<i class='fas fa-recycle'></i>";
                    $actionTitle = "Restore";
                    $employee['is_active'] = 'Deactivated';
                }

                foreach ($employee as $key => $value)
                {
                    if(!$value) {
                        $value = "NULL";
                    }
                    
                    $table .= "<td>".$value."</td>";
                }
                
                $buttons = " <a href='".URL."/user/delete?id=" . $employee['id'] . "' id = '" . $employee['id'] . "' data-toggle='tooltip' data-placement='left' title='" . $actionTitle . "' type='submit' class='" . $actionClass . " btn btn-primary text-secondary btn-sm'>" . $icon . "</a> ";
                // $buttons .= "<button href='".URL."/user/edit?id=" . $employee['id'] . "' data-toggle='tooltip' data-placement='left' title='Edit' type='submit' class='edit_user btn btn-primary text-secondary btn-sm'><i class= 'fas fa-edit'></i></button>  ";
                $table .= "<td>".$buttons."</td>";
                $table .= "</tr>";
            }

            $table .= "</tbody></table>";
            echo $table;
        }
    ?>
    </div>
</div>