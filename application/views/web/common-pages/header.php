<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="814060410939-7bjf5pekp78nem8ffjh7ir2fkg5hdvgj.apps.googleusercontent.com">
        <title>Hammer and Spanner | <?php if(!empty($title)) { echo $title; } else { echo "Home"; }?></title>
        <!-- Bootstrap -->
        <link href="<?php echo base_url('public/web/img/logo.svg');?>" rel="icon" type="icon/image">
        <link href="<?php echo base_url('public/web/css/bootstrap.min.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('public/web/css/slick.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('public/web/css/hamburgers.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('public/web/css/slick-theme.css');?>" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url('public/web/css/intlTelInput.css');?>">
        <link href="<?php echo base_url('public/web/css/style.css');?>" rel="stylesheet">
        <link href="<?php echo base_url('public/web/css/media.css');?>" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    </head>
    <body>
        <!-- Header Start -->
    <div class="header boxs">
        <div class="container">
            <nav class="navbar navbar-default">
                <nav class="navbar navbar-expand-md">
                    <a class="navbar-brand logoAll" href="<?php echo base_url(); ?>"><img src="<?php echo base_url('public/web/img/logo.svg');?>" class="img-fluid" alt="logo"></a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav"><span class="navIcon"></span></button>                                             
                    <div class="navbar-collapse" id="nav">
                        <div class="headerBox d-flex align-items-center float-right">   
                            <ul class="navbar-nav">
                                <li class="nav-item"><a class="nav-link <?php if(!empty($title ==="Home")) { echo "active"; }?>" href="<?php echo base_url();?>">Home</a></li>
                                <li class="nav-item afterLogin categoryBox"><a class="nav-link subMenu <?php if(!empty($title === "Category" )) {echo "active"; }?>" href="javascript:void(0)">All Categories</a>
                                    <div class="dropBox">
                                        <ul>
                                            <?php if(!empty($categorys)) { $i=0; foreach($categorys as $category){ ?>
                                            <li><a href="<?php echo base_url('web-category/show/'.$category['category_url']); ?>"><span><img src="<?php if(!empty($category['icon_url'])) { echo base_url('./uploads/category-icon/'.$category['icon_url']); } ?>" class="img-fluid" alt="icon"></span><?php if(!empty($category['category_name'])) { echo $category['category_name']; }?></a></li>
                                            <?php $i++; } } ?>
                                        </ul>
                                    </div>
                                </li>
                                 <li class="nav-item"><a class="nav-link <?php if(!empty($title ==="About-us")) { echo "active"; }?>" href="<?php echo base_url('Web/about_us');?>">About Us</a></li>
                                  <li class="nav-item"><a class="nav-link <?php if(!empty($title ==="FAQ\'s")) { echo "active"; }?>" href="<?php echo base_url('web/faqs');?>">FAQs</a></li>
                                     <li class="nav-item"><a class="nav-link <?php if(!empty($title ==="Contact Us")) { echo "active"; }?>" href="<?php echo base_url('Web/contactUs');?>">Contact Us</a></li>
                                
                                
                                
                                <!-- After Login profile Button Start -->
                                <?php if(!empty($this->session->userdata('user_email'))) { ?>
                                <li class="afterLogin userBox">
                                    <a class="loginAfter subMenu" href="javascript:void(0)"><span class="userImg">
                                        <?php if(!empty($user['profile_url'])){ ?>
                                        <img src="<?php echo base_url('uploads/users-profile/'.$user['profile_url']);?>" alt="image" class="img-fluid">
                                        <?php } else{ ?>
                                        <img src="<?php echo base_url('public/web/img/user.png');?>" alt="image" class="img-fluid">
                                        <?php } ?>
                                        </span>Hello, <?php echo $this->session->userdata('user_name'); ?><span class="dropIcon"><i class="fas fa-caret-down"></i></span></a>
                                    
                                    <div class="dropBox">
                                        <ul>
                                            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#profileModal">My Profile</a></li>
                                            <li><a class="notificationsList" href="javascript:void(0)">Notifications </a></li>
                                            <li><a class="sportClick">Support Chat</a></li>
                                            <li><a href="javascript:void(0)" data-toggle="modal" data-target="#changeModal">Change Password</a></li>
                                            <li><a href="<?php echo base_url('Web_booking');?>">My Bookings</a></li>
                                            <li><a class="logoutBtn" id="logout" href="<?php echo base_url('web-users/logout/');?>">Logout</a></li>
                                            
                                        </ul>
                                    </div>
                                </li>
                                <?php } else { ?>
                                    <li class="loginBtn"><a href="javascript:void(0)" data-toggle="modal" data-target="#signupModal">Login / Sign Up</a></li>
                                    
                                <?php } ?>
                                <li><a href ="#" data-toggle="modal" data-target="#contactModal" class ="fa fa-phone contactLogo"></a></li>
                                <!-- After Login profile Button Start -->
                                
                                
                    
                            </ul>  
                        </div>
                    </div>     
                </nav>

                <div class="notificationBox">
                    <div class="notificationTop boxs">
                        <p class="headingSize text-center">Notification</p>
                    </div>
                    <div class="notificationInner boxs">
                        <p class="subHeading"></p>
                        <div class="notoficInner boxs" id="notificScroll">
                        <?php
                        if(!empty($notifications)) {
                        foreach($notifications as $noti) {  ?>
                            <a href="#0">
                                <div class="notificBoxs boxs">
                                    <div class="notificTime boxs">
                                        <?php $min = explode(' ',$noti['created_at']) ?>
                                        <p><span><img src="<?php echo base_url('public/web/img/clock.svg');?>" class="img-fluid" alt="icon"></span><?php echo $min[0] ?></p>
                                    </div>
                                    <div class="notificDetail boxs">
                                       
                                        <div class="notificDescription">
                                            <p><?php echo $noti['body'] ?> </p>
                                        </div>
                                    </div>
                                </div>
                            </a>
                           <?php } } else{ ?> 
                           <p>No Notifications Yet!</p>
                           <?php } ?>
                        </div>
                    </div>
                </div>

            </nav>
            
        </div>
    </div>
    <!-- Header End -->
        
        