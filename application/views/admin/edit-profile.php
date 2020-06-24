            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Edit Profile</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Edit Profile</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Your Details</h2>
                            </header>
                            <div class="content-body">
                                <div class="row">
                                    <div class="col-md-8 col-sm-9 col-xs-10">
                                        <form name="editProfile" id="editProfile" method="post" action="<?php echo base_url('admin/do-edit-profile/'.$admin_info['id']);?>" enctype='multipart/form-data'>
                                            <div id="error_msg"></div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-1">Username</label>
                                                <div class="controls">
                                                    <input type="text" name="username" class="form-control username" id="field-1" placeholder="Enter Your Username" value="<?php if(!empty($admin_info['username'])) { echo $admin_info['username']; } ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-1">Profile Title</label>
                                                <div class="controls">
                                                    <input type="text" name="profile_title" class="form-control profile_title" id="field-1" placeholder="Enter Your Profile Title" value="<?php if(!empty($admin_info['profile_title'])) { echo $admin_info['profile_title']; } ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-2">Email Id</label>
                                                <div class="controls">
                                                    <input type="Email" name="email_id" class="form-control email_id" id="field-2" placeholder="Enter Your Email Id" value="<?php if(!empty($admin_info['email'])) { echo $admin_info['email']; } ?>">
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="form-label" for="field-3">Profile Image</label>
                                                <div class="controls">
                                                    <input type="file" name="profile_url" class="form-control profile_url" id="field-3" >
                                                </div>
                                                <?php if(!empty($admin_info['profile_url'])) { ?>
                                                <image src="<?php if(!empty($admin_info['profile_url'])) {echo base_url('uploads/admin-profile/'.$admin_info['profile_url']);} ?>" alt="Image Not Found" class="img-thumbnail" style="width:250px; height:180px;">
                                                <?php } ?>
                                            </div>

                                            <div class="">
                                                <button type="submit" name="update_profile" class="btn btn-success">Update Profile</button>
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