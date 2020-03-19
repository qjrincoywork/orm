<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= isset($data['title']) ? $data['title'] : '' ;?></title>
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
<nav class="navbar navbar-expand-lg bg-secondary">
    <div class="col-lg-12">
        <ul class="navbar-nav">
            <div class="col-md-1">
                <li class="nav-item">
                    <a class="nav-link" href="<?=URL;?>/user">Home</a>
                </li>
            </div>
            <div class="col-md-1">
                <li class="nav-item">
                    <a class="nav-link" href="<?=URL;?>/Algorithm">Algorithm</a>
                </li>
            </div>
            <div class="col-md-2">
                <li class="nav-item">
                    <a class="nav-link" href="<?=URL;?>/SQLProblems">SQL Problems</a>
                </li>
            </div>
            <div class="offset-md-6 col-md-2">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <?=$_SESSION['User']['username'];?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="<?=URL;?>/user/logout">Logout</a>
                    </div>
                </li>
            </div>
        </ul>
    </div>
</nav>
