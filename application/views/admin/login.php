
<!DOCTYPE html>
<html class=" ">
<head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>Hammer & Spanner: <?php if(!empty($title)) { echo $title; } ?></title>
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
        <link href="<?php echo base_url('public/assets/plugins/icheck/skins/square/orange.css'); ?>" rel="stylesheet" type="text/css" media="screen"/>        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 

        <!-- CORE CSS TEMPLATE - START -->
        <link href="<?php echo base_url('public/assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('public/assets/css/responsive.css'); ?>" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS TEMPLATE - END -->

    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" login_page">
        <div class="login-wrapper">
            <div id="login" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-0 col-xs-12">
                <h1><a href="#" title="Login Page" tabindex="-1">On-Demand Admin</a></h1>
                <div class="head" style="    font-size: 33px;text-align: -webkit-center;" > Admin Login</div>

                <form name="loginform" id="loginform" action="<?php echo base_url('admin/do-login');?>" method="post">
                    <div id="error_msg"></div>
                    <p>
                        <label for="email">Username<br/>
                        <input type="email" name="email" id="email" class="input" value="" size="20" /></label>
                    </p>
                    <p>
                        <label for="password">Password<br/>
                        <input type="password" name="password" id="password" class="input" value="" size="20" /></label>
                    </p>
                    <p class="forgetmenot">
                        <label class="icheck-label form-label" for="rememberme"><input name="rememberme" type="checkbox" id="rememberme" value="forever" class="skin-square-orange" checked> Remember me</label>
                    </p>
                    <p class="submit">
                        <input type="submit" name="wp-submit" id="wp-submit" class="btn btn-orange btn-block" value="Sign In" />
                    </p>
                </form>

                <p id="nav">
                    <a class="pull-left" href="<?php echo base_url('admin/forgot_password');?>" title="Password Lost and Found">Forgot password?</a>
                </p>
            </div>
        </div>

        <!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->
        <!-- CORE JS FRAMEWORK - START --> 
        <script src="<?php echo base_url('public/assets/js/jquery-1.11.2.min.js'); ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url('public/assets/js/jquery.easing.min.js'); ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url('public/assets/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url('public/assets/plugins/pace/pace.min.js'); ?>" type="text/javascript"></script>  
        <script src="<?php echo base_url('public/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js'); ?>" type="text/javascript"></script> 
        <script src="<?php echo base_url('public/assets/plugins/viewport/viewportchecker.js'); ?>" type="text/javascript"></script>  
        <!-- CORE JS FRAMEWORK - END --> 


        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
        <script src="<?php echo base_url('public/assets/plugins/icheck/icheck.min.js'); ?>" type="text/javascript"></script><!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 


        <!-- CORE TEMPLATE JS - START --> 
        <script src="<?php echo base_url('public/assets/js/scripts.js'); ?>" type="text/javascript"></script> 
        <!-- END CORE TEMPLATE JS - END --> 

        <!-- Sidebar Graph - START --> 
        <script src="<?php echo base_url('public/assets/plugins/sparkline-chart/jquery.sparkline.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/assets/js/chart-sparkline.js'); ?>" type="text/javascript"></script>
        <!-- Sidebar Graph - END --> 

        <script src="<?php echo base_url('public/assets/js/MyEvent.js'); ?>" type="text/javascript"></script> 
    </body>
</html>