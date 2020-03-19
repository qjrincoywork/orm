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
</div>