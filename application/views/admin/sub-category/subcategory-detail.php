            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Sub Category Detail</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Sub Category  Detail</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                       <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left"></h2>
                                <a href="<?php echo base_url('sub-category');?>" class="btn btn-primary pull-right">Back</a>
                            </header>
            
                    <div class="row">
                        <div class="assig_list boxs">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        

                                        <div class="row cat">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Sub Category Name:-</div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <h5 class="font-size-14"><?php if(!empty($subcategory['subcategory_name'])){ echo $subcategory['subcategory_name']; }?></h5>    <!-- <input type="" name="name" class="form-control" id="name" value=" <?php if(!empty($User_information['full_name'])) { echo $User_information['full_name'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                
                                                       
                                                <!--  <input type="text" name="email" class="form-control" id="email" value="<?php if(!empty($User_information['email_id'])) { echo $User_information['email_id'];}?>" readonly style="width:-webkit-fill-available;"> --> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                         <div class="row cat">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Sub Category Icon:-</h5>    <!-- <input type="" name="name" class="form-control" id="name" value=" <?php if(!empty($User_information['full_name'])) { echo $User_information['full_name'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <h5 class="font-size-14"> <?php if(!empty($subcategory['icon_url'])) { ?>
                                                <image src="<?php if(!empty($subcategory['icon_url'])) {echo base_url('uploads/sub-category-icon/'.$subcategory['icon_url']);} ?>" alt="Image Not Found" class="img-thumbnail" style="width:160px; height:100px;">
                                                     <?php } ?>
                                                       
                                                <!--  <input type="text" name="email" class="form-control" id="email" value="<?php if(!empty($User_information['email_id'])) { echo $User_information['email_id'];}?>" readonly style="width:-webkit-fill-available;"> --> 
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row cat">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14"> Category Name:-</h5>    <!-- <input type="" name="name" class="form-control" id="name" value=" <?php if(!empty($User_information['full_name'])) { echo $User_information['full_name'];}?>" readonly  style="width:-webkit-fill-available;"> -->
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                    <h5 class="font-size-14"> <?php if(!empty($subcategory['category_name'])){ echo $subcategory['category_name']; }?></h5>    
                                                
                                                       
                                                <!--  <input type="text" name="email" class="form-control" id="email" value="<?php if(!empty($User_information['email_id'])) { echo $User_information['email_id'];}?>" readonly style="width:-webkit-fill-available;"> --> 
                                                </div>
                                            </div>
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