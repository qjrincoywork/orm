<div class="container pt-4">
    <div class="card">
        <div class="card-header">Register</div>
            <div class="card-body card-block">
                <form id="form_register" action="<?=URL?>/home/register" method="post" class="form-modal" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nf-username" class="form-control-label">Username</label>
                                <input type="text" id="nf-username" name="username" placeholder="Enter Username.." class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nf-password" class="form-control-label">Password</label>
                                <input type="password" id="nf-password" name="password" placeholder="Enter Password.." class="form-control " required>
                            </div>
                            <div class="form-group">
                                <label for="nf-email" class="form-control-label">Email</label>
                                <input type="text" id="nf-email" name="email" placeholder="Enter Email.." class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nf-mobile_number" class="form-control-label">Mobile Number</label>
                                <input type="text" id="nf-mobile_number" name="mobile_number" placeholder="Enter Mobile Number" class="form-control" required>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nf-lastname" class="form-control-label">Last Name</label>
                                <input type="text" id="nf-lastname" name="lastname" placeholder="Enter Last Name.." class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="nf-firstname" class="form-control-label">First Name</label>
                                <input type="text" id="nf-firstname" name="firstname" placeholder="Enter First Name.." class="form-control" required>
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
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group mt-3">
                                <button type="submit" class="register_user btn btn-primary form-control">
                                    <i class="fas fa-dot-circle"></i> Register
                                </button>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group pt-4">
                                <a href="<?=URL;?>/home/login" class="text-info pt-1"> User Login </a>
                            </div>
                        </div>
                    </div>
                </form>
             </div>
        </div>
    </div>
</div>