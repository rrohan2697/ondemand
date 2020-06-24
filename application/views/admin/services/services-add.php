            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title"><?php  if(!empty($service['id'])) { echo "Edit ";} else { echo "Add"; }?> Services</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;"><?php  if(!empty($service['id'])) { echo "Edit ";} else { echo "Add"; }?> Services</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left"><?php  if(!empty($service['id'])) { echo "Edit ";} else { echo "Add"; }?> Services</h2>
                                <a href="<?php echo base_url('services');?>" class="btn btn-primary pull-right">Go Back</a>
                            </header>
        
                            <div class="content-body">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                        <form name="uploadImages" id="uploadImages" method="post" action="<?php if(!empty($service['id'])){  echo base_url('services/do-edit/'.$service['id']); }else{  echo base_url('services/do-add/'); }?>" enctype="multipart/form-data">
                                            <div id="error_msg"></div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-1">Select Category Name</label>
                                                <div class="controls">
                                                    <select name="category_name" class="form-control category_name" id="category_name" style="width:100%;" data-url="<?php echo base_url('services/changesubcategory');?>">
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
                                                    <select name="sub_category_name" class="form-control sub_category_name" id="sub_cat" style="width:100%;">
                                                        <option value="">Select Sub-Category</option>
                                                        <?php if(!empty($subcategorys)) { foreach($subcategorys as $subcategory){ ?>
                                                        <option value="<?php if(!empty($subcategory['id'])){ echo $subcategory['id']; } ?>" <?php if(!empty($service['subcategory_id'])){ if($service['subcategory_id'] === $subcategory['id']) { echo "selected";} } ?>><?php if(!empty($subcategory['subcategory_name'])){ echo $subcategory['subcategory_name']; } ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-3">Service Title</label>
                                                <div class="controls">
                                                    <input type="text" name="service_title" class="form-control service_title" id="field-3" placeholder="Enter Service Title" value="<?php if(!empty($service['service_title'])) { echo $service['service_title']; }?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-4">Price (₹)</label>
                                                <div class="controls">
                                                    <input type="text" name="price" class="form-control price" id="field-4" placeholder="Enter service price" value="<?php if(!empty($service['price'])) { echo $service['price']; }?>">
                                                </div>
                                            </div>
                                             <div class="form-group">
                                                <label class="form-label" for="field-4">Time (minutes)</label>
                                                <div class="controls">
                                                    <input type="number" name="time" class="form-control time" id="field-4" placeholder="Enter service time" value="<?php if(!empty($service['time'])) { echo $service['time']; }?>">
                                                </div>
                                            </div>
                                            <div class="form-group recommended_chk">
                                                <label class="form-label" for="field-4">Recommended</label>
                                                <div class="controls">
                                            <input type="radio" name="recommended" value="1" <?php if(!empty($service['recommended'])){ echo ($service['recommended']== '1')?  "checked" : "" ;  }?>/>Yes
                                           <input type="radio" name="recommended" value="0"<?php if(!empty($service['recommended'])){ echo ($service['recommended']== '0')?  "checked" : "" ;  }?>/>No
                                                
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-5">Description</label>
                                                <div class="controls">
                                                    <textarea class="form-control description" name="description" cols="5" rows="5" id="field-5" placeholder="Enter Description of Service.."><?php if(!empty($service['description'])) { echo $service['description']; } ?></textarea>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-6">Service Image</label>
                                                <span class="pull-right text-danger">You can choose single files. (Less then 2MB)</span>
                                                <div class="controls">
                                                    <input type="file" name="icon_url" class="form-control icon_url" id="field-6" >
                                                </div>
                                                <?php if(!empty($service['icon_url'])) { ?>
                                                <image src="<?php if(!empty($service['icon_url'])) {echo base_url('uploads/service-icon/'.$service['icon_url']);} ?>" alt="Image Not Found" class="img-thumbnail" style="width:160px; height:100px;">
                                                <?php } ?>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-3">Service Banner Images</label>
                                                <span class="pull-right text-danger">You can choose multiple files. (Less then 2MB)</span>
                                                <div class="controls">
                                                    <input type="file" name="images_url[]" class="form-control images_url" id="field-3" multiple="" accept="image/*">
                                                </div>
                                                <?php if(!empty($service['id'])){ ?>
                                                    <div id="banner-images" data-url="<?php echo base_url('services/banner-image-wrapper/'.$service['id']); ?>"></div>
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