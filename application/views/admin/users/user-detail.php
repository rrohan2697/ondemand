            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Users Management</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Users Management</a>
                                    </li>
                                </ol>
                            </div>
                            </div>

                        </div>
                    <!-- end page title -->
                     <div class="clearfix"></div>
                       <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left"></h2>
                                <a href="<?php echo base_url('users');?>" class="btn btn-primary pull-right">Back</a>
                            </header>
                            <div></div>
            
                    <div class="row">
                        <div class="assig_list boxs">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                           <div class="col-sm-3">
                                            <div class="form-group">
                                                <h5 class="font-size-14">Profile Image:
                                                    <!-- <input type="" name="name" class="form-control" id="name" value=" <?php if(!empty($User_information['full_name'])) { echo $User_information['full_name'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="form-group">
                                                    <h5 class="font-size-14"><img src="<?php if(!empty($usersdetail['profile_url'])) { echo base_url('uploads/users-profile/'.$usersdetail['profile_url']);} else { echo base_url('public/data/profile/profile.png');}?>" width="80px" height="60px" class="img-responsive img-circle"></h5>
                                                    <!-- <input type="" name="name" class="form-control" id="name" value=" <?php if(!empty($User_information['full_name'])) { echo $User_information['full_name'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                </div>

                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Name:- <?php if(!empty($usersdetail['user_name'])){ echo $usersdetail['user_name']; }?></h5>
                                                    <!-- <input type="" name="name" class="form-control" id="name" value=" <?php if(!empty($User_information['full_name'])) { echo $User_information['full_name'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Email :<?php if(!empty($usersdetail['email'])){ echo $usersdetail['email']; }?></h5>
                                                    <!--  <input type="text" name="email" class="form-control" id="email" value="<?php if(!empty($User_information['email_id'])) { echo $User_information['email_id'];}?>" readonly style="width:-webkit-fill-available;"> --> 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Mobile Number: <?php if(!empty($usersdetail['country_code'] || $usersdetail['phone_number'])){ echo $usersdetail['country_code'] . $usersdetail['phone_number'] ;}?></h5>
                                                    <!--  <input type="text" name="name" class= "form-control" id="name" value=" <?php if(!empty($User_information['weight'])) { echo $User_information['weight'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Message: <?php if(!empty($usersdetail['status'])){ echo $usersdetail['status'];}?></h5>
                                                    <!--  <input type="text" name="name" class= "form-control" id="name" value=" <?php if(!empty($User_information['goals'])) { echo $User_information['goals'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3>User Address</h3>
                    <div class="row">
                        <?php if(!empty($user_address)){foreach($user_address as $address){
                        ?>
                    
                        <div class="col-sm-3">

                      <div class="trendLeftInner">
                    <h5 class="font-size-14">Type:  <?php echo $address['type'];?> </h2>
                    
                    <div class="trendImg">
                        <h5 class="font-size-14">Address: <?php echo $address['address_line_1'] .$address['address_line_2'];?> </h2>

                    </div>
                    <div class="trendImg">
                        <h5 class="font-size-14">State: <?php echo $address['state'];?> </h2>

                    </div>
                    <div class="trendImg">
                        <h5 class="font-size-14">City: <?php echo $address['city'];?> </h2>

                    </div>
                    <div class="trendImg">
                        <h5 class="font-size-14">Zipcode: <?php echo $address['zipcode'];?> </h2>

                    </div>
                   
                    
                </div>
            </div>
        <?php } } ?>
                    </div>

                </div>
                </section>
            </section>
        </section>
            <!-- END CONTENT -->