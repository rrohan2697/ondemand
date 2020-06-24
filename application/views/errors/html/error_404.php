<?php
    $ci = new CI_Controller();
    $ci =& get_instance();
    $ci->load->helper('url');
?>

<!DOCTYPE html>
<html class=" ">
<head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>On-Demand: 404 Error Page</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />

        <link rel="shortcut icon" href="<?php echo base_url('public/assets/images/favicon.png'); ?>" type="image/x-icon" />    <!-- Favicon -->
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
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 

        <!-- CORE CSS TEMPLATE - START -->
        <link href="<?php echo base_url('public/assets/css/style.css'); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url('public/assets/css/responsive.css'); ?>" rel="stylesheet" type="text/css"/>
        <!-- CORE CSS TEMPLATE - END -->

    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" ">

        <div class="col-lg-12">
            <section class="box nobox">
                <div class="content-body">    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">

                            <h1 class="page_error_code text-primary">404</h1>
                            <h1 class="page_error_info">Oops! Page Not Found</h1>

                            <div class="col-md-6 col-sm-6 col-xs-8 col-md-offset-3 col-sm-offset-3 col-xs-offset-2">
                                <form action="javascript:;" method="post" class="page_error_search">
                                    <!-- <div class="input-group transparent">
                                        <span class="input-group-addon">
                                            <i class="fa fa-search icon-primary"></i>
                                        </span>
                                        <input type="text" class="form-control" placeholder="Try a new search">
                                        <input type='submit' value="">
                                    </div> -->
                                    <div class="text-center page_error_btn">
                                        <a class="btn btn-primary btn-lg" href='<?php echo base_url(); ?>'><i class='fa fa-location-arrow'></i> &nbsp; Back to Home</a>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
            </section></div>
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
        <!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - END --> 

        <!-- CORE TEMPLATE JS - START --> 
        <script src="<?php echo base_url('public/assets/js/scripts.js'); ?>" type="text/javascript"></script> 
        <!-- END CORE TEMPLATE JS - END --> 

        <!-- Sidebar Graph - START --> 
        <script src="<?php echo base_url('public/assets/plugins/sparkline-chart/jquery.sparkline.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/assets/js/chart-sparkline.js'); ?>" type="text/javascript"></script>
        <!-- Sidebar Graph - END --> 
    </body>
</html>