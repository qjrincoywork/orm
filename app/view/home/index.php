<div class="container pt-4">
    <?php if(isset($data['error'])) {
        echo "<div class='alert alert-danger' role='alert'>" .$data['error']. "</div>";
    } else if(isset($data['success'])){
        echo "<div class='alert alert-success' role='alert'>" .$data['success']. "</div>";
    }
    ?>
    <div class="row">
        <div class="col-md-6">
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce consectetur odio justo, ut tincidunt risus porttitor quis. Pellentesque vestibulum, lacus quis rutrum sollicitudin, lectus elit dignissim purus, in venenatis augue tortor quis sapien. Vestibulum finibus porta orci vel posuere. Donec molestie convallis sollicitudin. Quisque bibendum ut lectus quis fringilla. Integer vel volutpat leo. Nunc fringilla, mauris nec consequat volutpat, mauris eros condimentum massa, tincidunt fringilla eros ligula dictum nunc. Proin mattis neque id interdum viverra. Pellentesque sodales, lectus eu interdum rhoncus, risus nisl tristique velit, eu eleifend elit nunc ut mi. Phasellus purus turpis, sollicitudin eget venenatis sit amet, accumsan a est. Fusce sed elit ac nisi vulputate lacinia sit amet non mauris. Morbi a nisl imperdiet, sagittis diam fermentum, laoreet eros.
            </p>
            <p>
                Praesent tincidunt dictum aliquet. Aliquam dapibus dui felis, dictum ullamcorper sapien malesuada vel. Duis suscipit felis sit amet massa posuere dapibus. Vivamus nec quam nunc. Vestibulum finibus libero sed nisl luctus consequat. Vestibulum eget magna nec augue pellentesque vehicula quis vitae mi. Vivamus quis dignissim lacus. Duis est nibh, luctus et mauris accumsan, pulvinar tempus enim. Mauris vitae pellentesque dui, sit amet tristique arcu. Vivamus lacus diam, molestie eget orci non, pulvinar luctus felis. Nullam et sagittis ante. In tortor lectus, volutpat at pharetra vel, accumsan sed libero.
            </p>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">Register</div>
                    <div class="card-body card-block">
                        <form id="form_register" action="<?=URL?>/home/register" method="post" class="form-modal" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nf-username" class="form-control-label">Username</label>
                                        <input type="text" id="nf-username" name="username" placeholder="Enter Username.." class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="nf-password" class="form-control-label">Password</label>
                                        <input type="password" id="nf-password" name="password" placeholder="Enter Password.." class="form-control " >
                                    </div>
                                    <div class="form-group">
                                        <label for="nf-email" class="form-control-label">Email</label>
                                        <input type="text" id="nf-email" name="email" placeholder="Enter Email.." class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="nf-mobile_number" class="form-control-label">Mobile Number</label>
                                        <input type="text" id="nf-mobile_number" name="mobile_number" placeholder="Enter Mobile Number" class="form-control" >
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nf-lastname" class="form-control-label">Last Name</label>
                                        <input type="text" id="nf-lastname" name="lastname" placeholder="Enter Last Name.." class="form-control" >
                                    </div>
                                    <div class="form-group">
                                        <label for="nf-firstname" class="form-control-label">First Name</label>
                                        <input type="text" id="nf-firstname" name="firstname" placeholder="Enter First Name.." class="form-control" >
                                    </div> 
                                    <div class="form-group">
                                        <label for="nf-middlename" class="form-control-label">Middle Name</label>
                                        <input  type="text" id="nf-middlename" name="middlename" placeholder="Enter Middle Name.." class="form-control">
                                    </div> 
                                    <div class="form-group">
                                        <label for="nf-suffix" class="form-control-label">Suffix</label>
                                        <input  type="text" id="nf-suffix" name="suffix" placeholder="Enter Suffix.." class="form-control">
                                    </div> 
                                </div>
                                <div class="col-12">
                                    <div class="form-group mt-3">
                                        <button type="submit" class="register_user btn btn-primary form-control">
                                            <i class="fas fa-dot-circle"></i> Register
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>