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
                <div class="card-header">User Login</div>
                    <div class="card-body card-block">
                        <form class="form-login" method="POST" action="<?=URL;?>/home/login">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="username" class="col-form-label text-md-right">Username</label>
                                        <input id="username" type="text" class="form-control form-control-sm" name="username" autofocus required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="password" class="col-form-label text-md-right">Password</label>
                                            <input id="password" type="password" class="form-control form-control-sm" name="password" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group pt-2">
                                        <button type="submit" class="login_user btn btn-primary btn-sm">
                                            Login
                                        </button>
                                        <a href="<?=URL;?>/home/register" class="text-info pt-1"> Register Now! </a>
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