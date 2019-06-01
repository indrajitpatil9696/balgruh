<?php
/**
 * Created by PhpStorm.
 * User: indrajit
 * Date: 5/12/19
 * Time: 4:50 PM
 */?>
<!DOCTYPE html >
<html>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $title;?> </title>
        <!--Bootstrap CSS-->

        <link href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('bootstrap/css/navchaitanya.css');?>" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('bootstrap/newjs/chart/Chart.min.css');?>">
        <!--Bootstrap CSS-->
        <script src="<?php echo base_url('bootstrap/newjs/popper.min.js');?>"></script>
        <script src="<?php echo base_url('bootstrap/newjs/jquery.min.js');?>"></script>
        <script src="<?php echo base_url('bootstrap/newjs/bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('bootstrap/newjs/chart/Chart.js');?>"></script>

    <link href="<?php echo base_url('css/jquery.dataTables.min.css');?>" rel="stylesheet">
    <script type="text/javascript" src="<?php echo base_url('js/jquery-3.3.1.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/dataTables.bootstrap.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/jquery.dataTables.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/dataTables.buttons.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/buttons.flash.min.js');?>"></script>
<!--    <script type="text/javascript" src="--><?php //echo base_url('js/jszip.min.js');?><!--"></script>-->
<!--    <script type="text/javascript" src="--><?php //echo base_url('js/pdfmake.min.js');?><!--"></script>-->
    <script type="text/javascript" src="<?php echo base_url('js/vfs_fonts.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/buttons.html5.min.js');?>"></script>
    <script type="text/javascript" src="<?php echo base_url('js/buttons.print.min.js');?>"></script>
</head>
<body class="container-fluid ">

<?php if($this->session->userdata('logged_in')):?>
<nav class="navbar navbar-expand-md navbar-custom navbar-dark fixed-top">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="#">Navchaitanya Balgruha</a>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav">

            <!-- Dropdown -->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    मुलांची माहिती
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="<?php echo site_url('student');?>">प्रोफाईल्स नोंद/बदल</a>
                    <a class="dropdown-item" href="<?php echo site_url('marks');?>">मार्कलिस्ट भरा/काढून टाका</a>
                    <a class="dropdown-item" href="<?php echo site_url('mudatvadh');?>">मुदतवाढ भरा/काढून टाका</a>
                    <a class="dropdown-item" href="#">रिपोर्ट</a>
                    <a class="dropdown-item" href="<?php echo site_url('student/import');?>">प्रवेशित CSV इम्पोर्ट</a>
                    <a class="dropdown-item d-none"  href="<?php echo site_url('student/export');?>">प्रवेशित CSV एक्स्पोर्ट </a>
                </div>
            </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    देणगी रजिस्टर
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">देणगी नोंद/बदल</a>
                    <a class="dropdown-item" href="#">रिपोर्ट</a>
                </div>
            </li>
<!--ADMIN MENUE-->
            <li class="nav-item dropdown ">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    युजर
                </a>
                <div class="dropdown-menu ">
                    <a class="dropdown-item" href="#">नवीन युजर</a>
                    <a class="dropdown-item" href="#">युजर लिस्ट</a>
                </div>
            </li>
<!--            ADMIN MENUE END-->
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                    कर्मचारी
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#">प्रोफाईल्स नोंद/बदल</a>
                    <a class="dropdown-item" href="#">रिपोर्ट</a>
                </div>
            </li>
            <li class="nav-item ">
                <a class="nav-link logout-link" href="<?php echo site_url('login/logout')?>">लॉग आऊट</a>
            </li>
        </ul>


    </div>
</nav>

<div class="container-fluid content">
<?php else:

    if($launch[0]['status']!=0) {
        ?>

        <div class="container-fluid login-div">
            <div class="d-flex justify-content-center">
                <div class="user_card">
                    <div class="d-flex justify-content-center">
                        <div class="brand_logo_container">
                            <img src="<?php echo base_url('images/login_img.gif'); ?>" class="brand_logo" alt="Logo">
                        </div>
                    </div>
                    <div class="row title-login">
                        <h4 class="">नवचैतन्य बालगृह</h4>
                    </div>
                    <div class="d-flex justify-content-center form_container">
                        <form action="<?php echo site_url('login/verifylogin') ?>" method="post">
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <span class="input-group-text"><img
                                                src="<?php echo base_url('bootstrap/images/icons/man-user.png'); ?>"/></span>
                                </div>
                                <input type="text" name="username" class="form-control input_user" value=""
                                       placeholder="username" required>
                            </div>
                            <div class="input-group mb-2">
                                <div class="input-group-append">
                                    <span class="input-group-text"><img
                                                src="<?php echo base_url('bootstrap/images/icons/key.png'); ?>"/></span>
                                </div>
                                <input type="password" name="password" class="form-control input_pass" value=""
                                       placeholder="password" required>
                            </div>
                            <button type="submit" name="button" class="btn login_btn">Login</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <?php
    }
    else{
    ?>

        <div id="overlay">
            <div class="container">


                <div id="center"><a href="<?php echo site_url('login/launch')?>"> <img width="200px" height="200px" src="<?php echo base_url('images/launchbtn.png')?>"></a>
                <br>
                    <p style="text-align: center">Launch</p>
                </div>

            </div>

        </div>

        <?php
    }
endif;?>
