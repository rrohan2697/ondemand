            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title"><?php  if(!empty($sub_category['id'])) { echo "Edit ";} else { echo "Add"; }?> Sub-Category</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;"><?php  if(!empty($sub_category['id'])) { echo "Edit ";} else { echo "Add"; }?> Sub-Category</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left"><?php  if(!empty($sub_category['id'])) { echo "Edit ";} else { echo "Add"; }?> Sub-Category</h2>
                                <a href="<?php echo base_url('sub_category');?>" class="btn btn-primary pull-right">Go Back</a>
                            </header>
                            <div class="content-body">
                                <div class="row">
                                    <div class="col-md-8 col-sm-9 col-xs-10">
                                        <form name="uploadImages" id="uploadImages" method="post" action="<?php if(!empty($sub_category['id'])){  echo base_url('sub-category/do-edit-sub-category/'.$sub_category['id']); }else{  echo base_url('sub-category/do-add-sub-category/'); }?>" enctype="multipart/form-data">
                                            <div id="error_msg"></div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-1">Select Category Name</label>
                                                <div class="controls">
                                                    <select name="category_name" class="form-control category_name" style="width:100%;">
                                                        <option value="">Select Category</option>
                                                        <?php if(!empty($categorys)) { foreach($categorys as $category){ ?>
                                                        <option value="<?php if(!empty($category['id'])){ echo $category['id']; } ?>" <?php if(!empty($sub_category['category_id']) == $category['id']) { echo "selected";}?>><?php if(!empty($category['category_name'])){ echo $category['category_name']; } ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-1">Sub-Category Name</label>
                                                <div class="controls">
                                                    <input type="text" name="sub_category_name" class="form-control sub_category_name" id="field-1" placeholder="Enter Sub-Category Name" value="<?php if(!empty($sub_category['subcategory_name'])) { echo $sub_category['subcategory_name']; }?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-2">Sub-Category Icon</label>
                                                <div class="controls">
                                                    <input type="file" name="icon_url" class="form-control icon_url" id="field-2" >
                                                </div>
                                                <?php if(!empty($sub_category['icon_url'])) { ?>
                                                <image src="<?php if(!empty($sub_category['icon_url'])) {echo base_url('uploads/sub-category-icon/'.$sub_category['icon_url']);} ?>" alt="Image Not Found" class="img-thumbnail" style="width:160px; height:100px;">
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