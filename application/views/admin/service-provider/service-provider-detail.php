            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Service Provider Details</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Service Provider Details</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                     <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left"></h2>
                                <a href="<?php echo base_url('service-provider');?>" class="btn btn-primary pull-right">Back</a>
                            </header>

                    <!-- end page title -->
                    <div class="row">
                        <div class="assig_list boxs">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                           <div class="col-sm-3">
                                            <div class="form-group">
                                                <h5 class="font-size-14">Profile Image:</h5>
                                                    <!-- <input type="" name="name" class="form-control" id="name" value=" <?php if(!empty($User_information['full_name'])) { echo $User_information['full_name'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                </div>
                                            </div>
                                            <div class="col-sm-9">
                                                <div class="form-group">
                                                    <h5 class="font-size-14"><img src="<?php if(!empty($serviceprovider['profile_url'])) { echo base_url('uploads/service-provider-profile/'.$serviceprovider['profile_url']);} else { echo base_url('public/data/profile/profile.png');}?>" width="80px" height="60px" class="img-responsive img-circle"></h5>
                                                   
                                                </div>

                                            </div>
                                        </div>
                                      

                                          <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Name:- <?php if(!empty($serviceprovider['name'])){ echo $serviceprovider['name']; }?></h5>
                                                    <!-- <input type="" name="name" class="form-control" id="name" value=" <?php if(!empty($User_information['full_name'])) { echo $User_information['full_name'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Email :<?php if(!empty($serviceprovider['email'])){ echo $serviceprovider['email']; }?></h5>
                                                    <!--  <input type="text" name="email" class="form-control" id="email" value="<?php if(!empty($User_information['email_id'])) { echo $User_information['email_id'];}?>" readonly style="width:-webkit-fill-available;"> --> 
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Mobile Number :<?php if(!empty($serviceprovider['phone_number'])){ echo $serviceprovider['phone_number']; }?></h5>
                                                    <!--  <input type="text" name="email" class="form-control" id="email" value="<?php if(!empty($User_information['email_id'])) { echo $User_information['email_id'];}?>" readonly style="width:-webkit-fill-available;"> --> 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Address: <?php if(!empty($serviceprovider['addressline1'] || $serviceprovider['addressline2'])){ echo $serviceprovider['addressline1'] . $serviceprovider['addressline2'] ;}?></h5>
                                                    <!--  <input type="text" name="name" class= "form-control" id="name" value=" <?php if(!empty($User_information['weight'])) { echo $User_information['weight'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">City: <?php if(!empty($serviceprovider['city'])){ echo $serviceprovider['city'];}?></h5>
                                                    <!--  <input type="text" name="name" class= "form-control" id="name" value=" <?php if(!empty($User_information['goals'])) { echo $User_information['goals'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Postcode: <?php if(!empty($serviceprovider['postcode'])){ echo $serviceprovider['postcode'];}?></h5>
                                                    <!--  <input type="text" name="name" class= "form-control" id="name" value=" <?php if(!empty($User_information['goals'])) { echo $User_information['goals'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Category Name: <?php if(!empty($serviceprovider['category_name'])){ echo $serviceprovider['category_name'];}?></h5>
                                                    <!--  <input type="text" name="name" class= "form-control" id="name" value=" <?php if(!empty($User_information['weight'])) { echo $User_information['weight'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">SubCategory Name: <?php if(!empty($serviceprovider['subcategory_name'])){ echo $serviceprovider['subcategory_name'];}?></h5>
                                                    <!--  <input type="text" name="name" class= "form-control" id="name" value=" <?php if(!empty($User_information['goals'])) { echo $User_information['goals'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                </div>
                                            </div>
                                           
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                   

                </div>
            </section>
        </section>
            <!-- END CONTENT -->