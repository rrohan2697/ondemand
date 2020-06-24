<!DOCTYPE html>
<html class=" ">
<head>
        <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
        <meta charset="utf-8" />
        <title>On-Demand: <?php if(!empty($title)) { echo $title; } else{ echo 'Dashboard'; } ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta content="" name="description" />
        <meta content="" name="author" />

       

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
        <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
    <?php } ?>
    </head>
    <!-- END HEAD -->

    <!-- BEGIN BODY -->
    <body class=" "><!-- START TOPBAR -->
    
        <!-- END TOPBAR -->
        <!-- END TOPBAR -->
        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

           

                    <div class="block1">
                        <div class="data">
                            
                        </div>
                        <div class="graph">
                            <span class="sidebar_orders">...</span>
                        </div>
                    </div>

                    <div class="block2">
                        <div class="data">
                            
                        </div>
                        <div class="graph">
                            <span class="sidebar_visitors">...</span>
                        </div>
                    </div>

                </div>



            </div>
            <!--  SIDEBAR - END -->
            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title"></h1>                           </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        
                                    </li>
                                    <li>
                                        
                                    </li>
                                    <li class="active">
                                        
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>


                    <div class="col-lg-6">
                        <section class="box ">
                            <header class="panel_header">
                                <h5 class="text-center">Reset Password</h5>
                                <div class="actions panel_actions pull-right">
                                   
                                </div>
                            </header>
                            <div class="content-body">
                             <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">


                                       <div id="error_msg"></div>
                                <?php
                                $content = array('id' => 'common-form', 'class' => "form-horizontal");
                                echo form_open('api/do_reset_passowrd/'.$user_id, $content);
                                ?>
                                       <div class="col-md-12">
                                        <div class="form-group mt-4">
                                            <label for="email">New Password</label>
                                            <input type="password" class="form-control newpassword" id="newpassword" name="newpassword" placeholder="Enter New Password">
                                        </div>
                                        <div class="form-group mt-4">
                                            <label for="email">Confirm Password</label>
                                            <input type="password" class="form-control cpassword" id="cpassword" name="cpassword" placeholder="Enter Confirm Password">
                                        </div>
                                        <div class="mt-4">
                                            <button class="btn btn-success btn-block waves-effect waves-light" type="submit">Change Password</button>
                                        </div>

                                    </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    


                    









                </section>
            </section>
            <!-- END CONTENT -->
            <div class="page-chatapi hideit">

                <div class="search-bar">
                    <input type="text" placeholder="Search" class="form-control">
                </div>

              
<!-- END CONTAINER -->
<!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


<!-- CORE JS FRAMEWORK - START --> 
<script src="<?php echo base_url('public/assets/js/jquery-1.11.2.min.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo base_url('public/assets/js/jquery.easing.min.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo base_url('public/assets/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script> 
<!-- <script src="<?php echo base_url('public/assets/plugins/pace/pace.min.js'); ?>" type="text/javascript"></script>   -->
<script src="<?php echo base_url('public/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js'); ?>" type="text/javascript"></script> 
<!-- <script src="<?php echo base_url('public/assets/plugins/viewport/viewportchecker.js'); ?>" type="text/javascript"></script>   -->

<!-- CORE JS FRAMEWORK - END --> 


<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
<!-- <script src="<?php echo base_url('public/assets/plugins/rickshaw-chart/vendor/d3.v3.js'); ?>" type="text/javascript"></script> <script src="assets/plugins/jquery-ui/smoothness/jquery-ui.min.js" type="text/javascript"></script> <script src="assets/plugins/rickshaw-chart/js/Rickshaw.All.js"></script><script src="assets/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script><script src="assets/plugins/easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script><script src="assets/plugins/morris-chart/js/raphael-min.js" type="text/javascript"></script><script src="assets/plugins/morris-chart/js/morris.min.js" type="text/javascript"></script><script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.1.min.js" type="text/javascript"></script><script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script><script src="assets/plugins/gauge/gauge.min.js" type="text/javascript"></script><script src="assets/plugins/icheck/icheck.min.js" type="text/javascript"></script><script src="assets/js/dashboard.js" type="text/javascript"></script>OTHER SCRIPTS INCLUDED ON THIS PAGE - END  -->

<?php if(!empty($datatable)) { ?>
<script src="<?php echo base_url('public/assets/plugins/datatables/js/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js'); ?>" type="text/javascript">
</script><script src="<?php echo base_url('public/assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
<?php } ?>


<!-- CORE TEMPLATE JS - START --> 
<script src="<?php echo base_url('public/assets/js/scripts.js'); ?>" type="text/javascript"></script> 
<!-- END CORE TEMPLATE JS - END --> 

<!-- Sidebar Graph - START --> 
<!-- <script src="<?php echo base_url('public/assets/plugins/sparkline-chart/jquery.sparkline.min.js'); ?>" type="text/javascript"></script> -->
<!-- <script src="<?php echo base_url('public/assets/js/chart-sparkline.js'); ?>" type="text/javascript"></script> -->
<!-- Sidebar Graph - END --> 

<script src="<?php echo base_url('public/assets/js/MyEvent.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/assets/js/sweetalert.min.js'); ?>" type="text/javascript"></script>

<?php if (!empty($editor) == 1) { ?>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote({
                height: "250px"
            });
            $('.heading').summernote({
                // height: "250px"
            });
        });
    </script>
<?php } ?>
</body>
</html>

<script type="text/javascript">

</script>