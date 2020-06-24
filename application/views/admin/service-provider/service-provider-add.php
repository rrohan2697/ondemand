            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title"><?php  if(!empty($service['id'])) { echo "Edit ";} else { echo "Add"; }?> Services Provider</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;"><?php  if(!empty($service['id'])) { echo "Edit ";} else { echo "Add"; }?> Services Provider</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left"><?php  if(!empty($service['id'])) { echo "Edit ";} else { echo "Add"; }?> Services Provider</h2>
                                <a href="<?php echo base_url('service-provider');?>" class="btn btn-primary pull-right">Go Back</a>
                            </header>
                            <div class="content-body">
                                <div class="row">
                                    <div class="col-md-8 col-sm-9 col-xs-10">
                                        <form name="uploadImages" id="uploadImages" method="post" action="<?php if(!empty($service['id'])){  echo base_url('service-provider/do-edit/'.$service['id']); }else{  echo base_url('service-provider/do-add/'); }?>" enctype="multipart/form-data">
                                            <div id="error_msg"></div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-1">Select Category Name</label>
                                                <div class="controls">
                                                    <select name="category_name" class="form-control category_name" style="width:100%;">
                                                        <option value="">Select Category</option>
                                                        <?php if(!empty($categorys)) { foreach($categorys as $category){ ?>
                                                        <option value="<?php if(!empty($category['id'])){ echo $category['id']; } ?>" <?php if(!empty($service['category_id'])){ if($service['category_id'] === $category['id']) { echo "selected";} } ?>><?php if(!empty($category['category_name'])){ echo $category['category_name']; } ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-2">Sub-Category Name</label>
                                                <div class="controls">
                                                    <select name="sub_category_name" class="form-control sub_category_name" style="width:100%;">
                                                        <option value="">Select Sub-Category</option>
                                                        <?php if(!empty($subcategorys)) { foreach($subcategorys as $subcategory){ ?>
                                                        <option value="<?php if(!empty($subcategory['id'])){ echo $subcategory['id']; } ?>" <?php if(!empty($service['subcategory_id'])){ if($service['subcategory_id'] === $subcategory['id']) { echo "selected";} } ?>><?php if(!empty($subcategory['subcategory_name'])){ echo $subcategory['subcategory_name']; } ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-3">Service Provider Name</label>
                                                <div class="controls">
                                                    <input type="text" name="name" class="form-control name" id="field-3" placeholder="Enter Name" value="<?php if(!empty($service['name'])) { echo $service['name']; }?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-4">Email Id</label>
                                                <div class="controls">
                                                    <input type="text" name="email" class="form-control email" id="field-4" placeholder="Enter Email Id" value="<?php if(!empty($service['email'])) { echo $service['email']; }?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-5">Phone Number</label>
                                                <div class="controls">
                                                    <input type="text" name="phone_number" class="form-control phone_number" id="field-5" placeholder="Enter Phone Number" value="<?php if(!empty($service['phone_number'])) { echo $service['phone_number']; }?>">
                                                </div>
                                            </div>

                                            
                                            <div class="form-group">
                                                <label class="form-label" for="field-5">Address Line1</label>
                                                <div class="controls">
                                                    <input type="text" name="addressline1" class="form-control phone_number" id="field-5" placeholder="Address Line1" value="<?php if(!empty($service['addressline1'])) { echo $service['addressline1']; }?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-5">Address Line2</label>
                                                <div class="controls">
                                                    <input type="text" name="addressline2" class="form-control phone_number" id="field-5" placeholder="Address Line2" value="<?php if(!empty($service['addressline2'])) { echo $service['addressline2']; }?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-5">City</label>
                                                <div class="controls">
                                                    <input type="text" name="city" class="form-control phone_number" id="field-5" placeholder="Enter City" value="<?php if(!empty($service['city'])) { echo $service['city']; }?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-5">Post Code</label>
                                                <div class="controls">
                                                    <input type="text" name="postcode" class="form-control phone_number" id="field-5" placeholder="Enter Post Code" value="<?php if(!empty($service['postcode'])) { echo $service['postcode']; }?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-5">Service Provider Profile Image</label>
                                                <div class="controls">
                                                    <input type="file" name="profile_url" class="form-control profile_url" id="field-5" >
                                                </div>
                                                <?php if(!empty($service['profile_url'])) { ?>
                                                <image src="<?php if(!empty($service['profile_url'])) {echo base_url('uploads/service-provider-profile/'.$service['profile_url']);} ?>" alt="Image Not Found" class="img-thumbnail" style="width:160px; height:100px;">
                                                <?php } ?>
                                            </div>

                                            <div class="">
                                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
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