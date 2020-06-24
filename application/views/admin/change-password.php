            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Change Password</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Change Password</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Change Your Password</h2>
                            </header>
                            <div class="content-body">
                                <div class="row">
                                    <div class="col-md-8 col-sm-9 col-xs-10">
                                        <form name="changePassword" id="changePassword" method="post" action="<?php echo base_url('admin/do-change-password/'.$admin_info['id']);?>">
                                            <div id="error_msg"></div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-1">Current Password</label>
                                                <div class="controls">
                                                    <input type="password" name="current_password" class="form-control current_password" id="field-1" placeholder="Enter Current Password">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-2">New Password</label>
                                                <div class="controls">
                                                    <input type="password" name="new_password" class="form-control new_password" id="field-2" placeholder="Enter New Password">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label" for="field-3">Confirm Password</label>
                                                <div class="controls">
                                                    <input type="password" name="confirm_password" class="form-control confirm_password" id="field-3" placeholder=" Confirm New Password">
                                                </div>
                                            </div>

                                            <div class="">
                                                <button type="submit" name="change_password" class="btn btn-success">Change Password</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </section>
            <div class="chatapi-windows "></div>    
        </div>
        <!-- END CONTAINER -->