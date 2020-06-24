            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Category Detail</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Category  Detail</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                     <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left"></h2>
                                <a href="<?php echo base_url('category');?>" class="btn btn-primary pull-right">Back</a>
                            </header>

                    <!-- end page title -->
        
                    <div class="row">
                        <div class="assig_list boxs">
                            <div class="col-lg-12">
                                <div class="card"> 
                                    <div class="card-body">
                                        

                                        <div class="row cat">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Category Name:-    </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <h5 class="font-size-14"><?php if(!empty($category['category_name'])){ echo $category['category_name']; }?></h5>    <!-- <input type="" name="name" class="form-control" id="name" value=" <?php if(!empty($User_information['full_name'])) { echo $User_information['full_name'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                             
                                                       
                                                <!--  <input type="text" name="email" class="form-control" id="email" value="<?php if(!empty($User_information['email_id'])) { echo $User_information['email_id'];}?>" readonly style="width:-webkit-fill-available;"> --> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row cat">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Category Icon:- </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <h5 class="font-size-14"> <?php if(!empty($category['icon_url'])) { ?>
                                                <image src="<?php if(!empty($category['icon_url'])) {echo base_url('uploads/category-icon/'.$category['icon_url']);} ?>" alt="Image Not Found" class="img-thumbnail" style="width:160px; height:100px;">
                                                     <?php } ?>
                                                       
                                                <!--  <input type="text" name="email" class="form-control" id="email" value="<?php if(!empty($User_information['email_id'])) { echo $User_information['email_id'];}?>" readonly style="width:-webkit-fill-available;"> --> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row cat">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Category Url:-    </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <h5 class="font-size-14"><?php if(!empty($category['category_url'])){ echo $category['category_url']; }?></h5>    <!-- <input type="" name="name" class="form-control" id="name" value=" <?php if(!empty($User_information['full_name'])) { echo $User_information['full_name'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                             
                                                       
                                                <!--  <input type="text" name="email" class="form-control" id="email" value="<?php if(!empty($User_information['email_id'])) { echo $User_information['email_id'];}?>" readonly style="width:-webkit-fill-available;"> --> 
                                                </div>
                                            </div>
                                        </div>
                                         <div class="row cat">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Category Banner Name:-   </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                          <h5 class = "font-size-14"><?php if(!empty($category['category_banner_name'])){ echo $category['category_banner_name']; }?></h5>    <!-- <input type="" name="name" class="form-control" id="name" value=" <?php if(!empty($User_information['full_name'])) { echo $User_information['full_name'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                              </h5>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                             <div class="form-group">
                                                    <h3 class="font-size-14" style="text-align: center;">Category Banner Images</h3>
                                        
                                                </div>
                                            </div>
                                            <div class="row">
                                        <?php if(!empty($banner)) { 
                                            foreach ($banner as $bannerImg){
                                                ?>
                                        <div class="col-sm-4">
                                            
                                        <image src="<?php if(!empty($bannerImg['image_url'])) {echo base_url('uploads/category-banner-images/'.$bannerImg['image_url']);} ?>" alt="Image Not Found" class="img-thumbnail" style="width:250px; height:100px;">
                                            
                                        </div>
                                        <?php }} ?> 
                                    </div>
                                          
                                          

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    
            </section>
            </section>
        </section>
            <!-- END CONTENT -->