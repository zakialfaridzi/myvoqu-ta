<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from mythemestore.com/friend-finder/newsfeed.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Jan 2020 15:59:32 GMT -->

    <head>
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="This is social network html5 template available in themeforest......" />
        <meta name="keywords" content="Social Network, Social Media, Make Friends, Newsfeed, Profile Page" />
        <meta name="robots" content="index, follow" />
        <title><?=$title;?></title>





        <!-- Stylesheets
    ================================================= -->

        <link rel="stylesheet" href="<?=base_url('assets_user/');?>css/star.css" />

        <link rel="stylesheet" href="<?=base_url('assets_user/');?>css/bootstrap.min.css" />





        <link href="<?=base_url('assets/');?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
        <!-- <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"> -->



        <link rel="stylesheet" href="<?=base_url('assets_user/');?>css/style.css" />
        <link rel="stylesheet" href="<?=base_url('assets_user/');?>css/ionicons.min.css" />
        <link rel="stylesheet" href="<?=base_url('assets_user/');?>css/font-awesome.min.css" />
        <link rel="stylesheet" href="<?=base_url('assets_user/');?>css/font-roboto.css" />
        <link href="<?=base_url('assets_user/');?>css/emoji.css" rel="stylesheet">







        <!--Google Font-->
        <!-- <link href="https://fonts.googleapis.com/css?family=Lato:300,400,400i,700,700i" rel="stylesheet"> -->

        <!--Favicon-->
        <link rel="shortcut icon" type="image/png" href="<?=base_url('assets_login/');?>images/mvq.png" />
    </head>

    <body style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif ">

        <!-- Header
    ================================================= -->

        <header id="header">
            <nav class="navbar navbar-default navbar-fixed-top menu" style="background-color: #0486FE;">
                <div class="container">

                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?=base_url('user')?>"><img
                                src="<?=base_url('assets_login/');?>images/mvqq.png" alt="logo"
                                style="width: 150px; margin-top: -10px;" /></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right main-menu">
                            <li class="dropdown">
                                <a href="<?=base_url('auth')?>">Beranda </a>

                            </li>

                            <li class="dropdown">
                                <a href="<?=base_url('profile/');?>">Profil</a>

                            </li>


                            <li class="dropdown">
                                <a href="<?=base_url('faq/')?>">FaQ </a>

                            </li>



                            <li class="dropdown">
                                <a href="<?=base_url('auth/logout');?>" class="dropdown-toggle">Keluar </a>

                            </li>


                        </ul>
                        <form class="navbar-form navbar-right hidden-sm">
                            <div class="form-group" style="display: <?=$search;?>;">
                                <i class="icon ion-android-search " style="color: <?=$colorSearch;?> ;"></i>
                                <input type="text" class="form-control" placeholder="Search People"
                                    style="background-color: white; color: #323232;" id="keyword">
                            </div>
                        </form>
                    </div><!-- /.navbar-collapse -->
                </div><!-- /.container -->
            </nav>
        </header>
