<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $data['title'];?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- css -->
    <!-- Font Face -->
    <link href="<?=URL;?>/public/css/font-face.css" rel="stylesheet">
    <link href="<?=URL;?>/public/css/all.min.css" rel="stylesheet">
    <link href="<?=URL;?>/public/css/fontawesome.min.css" rel="stylesheet">

    <link href="<?=URL;?>/public/css/material-design-iconic-font.min.css" rel="stylesheet">
    <link href="<?=URL;?>/public/css/fonts.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="<?=URL;?>/public/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=URL;?>/public/css/app.css" rel="stylesheet">
</head>
<body>
<!-- header -->
<nav class="navbar navbar-light bg-secondary">
    <!-- Navbar content -->
    <div class="col-md-6 offset-md-6">
        <form class="form-login form-inline" method="POST" action="<?=URL;?>/home/login">
            <div class="row">
                <div class="form-group">
                    <label for="username" class="col-form-label text-md-right">Username</label>
                    <input id="username" type="text" class="form-control form-control-sm" name="username" autofocus required>
                </div>

                <div class="form-group">
                    <label for="password" class="col-form-label text-md-right">Password</label>
                        <input id="password" type="password" class="form-control form-control-sm" name="password" required>
                </div>

                <div class="form-group">
                    <button type="submit" class="login_user btn btn-primary btn-sm">
                        Login
                    </button>
                </div>
            </div>
        </form>
    </div>
</nav>
