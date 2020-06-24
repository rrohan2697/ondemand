<!DOCTYPE html>
<html class=" ">
<head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Hammer and Spanner <?php if(!empty($title)) { echo $title; } else{ echo 'Dashboard'; } ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <link rel="shortcut icon" href="<?php echo base_url('public/web/img/logo.svg'); ?>" type="image/x-icon" />    <!-- Favicon -->
        <link rel="apple-touch-icon-precomposed" href="<?php echo base_url('public/assets/images/apple-touch-icon-57-precomposed.png'); ?>">	<!-- For iPhone -->
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('public/assets/images/apple-touch-icon-114-precomposed.png'); ?>">    <!-- For iPhone 4 Retina display -->
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('public/assets/images/apple-touch-icon-72-precomposed.png'); ?>">    <!-- For iPad -->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('public/assets/images/apple-touch-icon-144-precomposed.png'); ?>">    <!-- For iPad Retina display -->

        <!-- CORE CSS FRAMEWORK - START -->
        <link href="<?php echo base_url('public/assets/plugins/pace/pace-theme-flash.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url('public/assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('public/assets/plugins/bootstrap/css/bootstrap-theme.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('public/assets/fonts/font-awesome/css/font-awesome.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('public/assets/css/animate.min.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('public/assets/plugins/perfect-scrollbar/perfect-scrollbar.css'); ?>" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS FRAMEWORK - END -->

        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        <!-- <link href="<?php echo base_url('public/assets/plugins/morris-chart/css/morris.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url('public/assets/plugins/jquery-ui/smoothness/jquery-ui.min.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url('public/assets/plugins/rickshaw-chart/css/graph.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url('public/assets/plugins/rickshaw-chart/css/detail.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url('public/assets/plugins/rickshaw-chart/css/legend.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url('public/assets/plugins/rickshaw-chart/css/extensions.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url('public/assets/plugins/rickshaw-chart/css/rickshaw.min.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url('public/assets/plugins/rickshaw-chart/css/lines.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url('public/assets/plugins/jvectormap/jquery-jvectormap-2.0.1.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
        <link href="<?php echo base_url('public/assets/plugins/icheck/skins/minimal/white.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>         -->
        
        <?php if(!empty($datatable)) { ?>
        <link href="<?php echo base_url('public/assets/plugins/datatables/css/jquery.dataTables.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
		<link href="<?php echo base_url('public/assets/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.min.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
		<link href="<?php echo base_url('public/assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
		<link href="<?php echo base_url('public/assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>
        <?php } ?>
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE CSS TEMPLATE - START -->
        <link href="<?php echo base_url('public/assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('public/assets/css/responsive.css'); ?>" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS TEMPLATE - END -->

    <?php if (!empty($editor) == 1) { ?>
        <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <?php } ?>
    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" "><!-- START TOPBAR -->
    <div class="loader"></div>
        <div class='page-topbar '>
            <a href="<?php echo base_url('Admin/dashboard') ?>"><div class='logo-area'>

            </div></a>
            <div class='quick-area'>
                <div class='pull-left'>
                    <ul class="info-menu left-links list-inline list-unstyled">
                        <li class="sidebar-toggle-wrap">
                            <a href="#" data-toggle="sidebar" class="sidebar_toggle">
                                
                            </a>
                        </li>
                        <li class="notify-toggle-wrapper">
                            <a href="#" data-toggle="dropdown" class="toggle">
                                <i class="fa fa-bell"></i>
                                <span class="badge badge-orange"><?php if(!empty($notications)){ echo '1';} else{ echo '';} ?></span>
                            </a>
                            <ul class="dropdown-menu notifications animated fadeIn">
                                <li class="total">
                                    <span class="small">
                                        <?php if(!empty($notications)) { ?>
                                        You have <strong>1</strong> new notifications.
                                    <?php } ?>
                                        
                                    </span>
                                </li>
                                <li class="list">

                                    <ul class="dropdown-menu-list list-unstyled ps-scrollbar">
                                        <!--<li class="unread available"> 
                                        <!--    <a href="javascript:;">-->
                                        <!--        <div class="notice-icon">-->
                                        <!--            <i class="fa fa-check"></i>-->
                                        <!--        </div>-->
                                        <!--        <div>-->
                                        <!--            <span class="name">-->
                                        <!--                <strong>Server needs to reboot</strong>-->
                                        <!--                <span class="time small">15 mins ago</span>-->
                                        <!--            </span>-->
                                        <!--        </div>-->
                                        <!--    </a>-->
                                        <!--</li>-->
                                        <!--<li class="unread away"> 
                                        <!--    <a href="javascript:;">-->
                                        <!--        <div class="notice-icon">-->
                                        <!--            <i class="fa fa-envelope"></i>-->
                                        <!--        </div>-->
                                        <!--        <div>-->
                                        <!--            <span class="name">-->
                                        <!--                <strong>45 new messages</strong>-->
                                        <!--                <span class="time small">45 mins ago</span>-->
                                        <!--            </span>-->
                                        <!--        </div>-->
                                        <!--    </a>-->
                                        <!--</li>-->
                                        <?php if(!empty($notications)){?>
                                        <li class=" offline"> <!-- available: success, warning, info, error -->
                                            <a href="<?php echo base_url('Orders'); ?>">
                                                <div class="notice-icon">
                                                    <i class="fa fa-user"></i>
                                                </div>
                                                <div>
                                                    <span class="name">
                                                        <strong><?php echo $notications; ?> New Booking</strong>
                                                    
                                                    </span>
                                                </div>
                                            </a>
                                        </li>
                                    <?php } ?>
                                       
                                       
                                       

                                    </ul>

                                </li>

                                <!--li class="external">
                                    <a href="javascript:;">
                                        <span>Read All Notifications</span>
                                    </a>
                                </li--->
                            </ul>
                        </li>
                    </ul>
                </div>				
                <div class='pull-right'>
                    <ul class="info-menu right-links list-inline list-unstyled">
                        <li class="profile">
                            <a href="#" data-toggle="dropdown" class="toggle">
                                <img src="<?php if(!empty($admin_info['profile_url'])){  echo base_url('uploads/admin-profile/'.$admin_info['profile_url']); }else{ echo base_url('public/data/profile/profile.png'); } ?>" alt="user-image" class="img-circle img-inline">
                                <span><?php if(!empty($admin_info['username'])) { echo $admin_info['username']; } else { echo 'Admin'; }?><i class="fa fa-angle-down"></i></span>
                            </a>
                            <ul class="dropdown-menu profile animated fadeIn">
                                <li>
                                    <a href="<?php echo base_url('admin/change-password');?>">
                                        <i class="fa fa-wrench"></i>
                                        Change Password
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('admin/profile/');?>">
                                        <i class="fa fa-user"></i>
                                        Profile
                                    </a>
                                </li>
                                <li class="last">
                                    <a href="<?php echo base_url('admin/logout'); ?>" id="logout">
                                        <i class="fa fa-lock"></i>
                                        Logout
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li></li>
                    </ul>			
                </div>		
            </div>

        </div>
        <!-- END TOPBAR -->
		