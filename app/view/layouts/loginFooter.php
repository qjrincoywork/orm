<?php if(isset($data['error'])) {
        echo "<div class='container pt-4'><div class='alert alert-danger' role='alert'>" .$data['error']. "</div></div>";
    } else if(isset($data['success'])){
        echo "<div class='container pt-4'><div class='alert alert-success' role='alert'>" .$data['success']. "</div></div>";
    }
?>

        <div class='modal fade' tabindex='-1' role='dialog'>
            <div class='modal-dialog' role='document'>
                <div class='modal-content'>
                    <div class='modal-header'>
                        <h5 class='modal-title' id='myModalLabel'></h5>
                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                    </div>
                    <div class='modal-body pt-2'>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="<?=URL;?>/public/js/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="<?=URL;?>/public/js/scripts-exercise.js"></script>
    </body>
</html>