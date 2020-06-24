            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title"><?php  if(!empty($category['id'])) { echo "Edit ";} else { echo "Add"; }?> Category</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;"><?php  if(!empty($category['id'])) { echo "Edit ";} else { echo "Add"; }?> Category</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left"><?php  if(!empty($category['id'])) { echo "Edit ";} else { echo "Add"; }?> Category</h2>
                                <a href="<?php echo base_url('category');?>" class="btn btn-primary pull-right">Go Back</a>
                            </header>
                            <div class="content-body">
                                <div class="row">
                                    <div class="col-md-8 col-sm-12 col-xs-12">
                                        <form name="uploadImages" id="uploadImages" method="post" action="<?php if(!empty($category['id'])){  echo base_url('category/do-edit-category/'.$category['id']); }else{  echo base_url('category/do-add-category/'); }?>" enctype="multipart/form-data">
                                            <div id="error_msg"></div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-1">Category Name</label>
                                                <div class="controls">
                                                    <input type="text" name="category_name" class="form-control category_name" id="field-1" placeholder="Enter Category Name" value="<?php if(!empty($category['category_name'])) { echo $category['category_name']; }?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-2">Category Icon</label>
                                                <div class="controls">
                                                    <input type="file" name="icon_url" class="form-control icon_url" id="field-2" >
                                                </div>
                                                <?php if(!empty($category['icon_url'])) { ?>
                                                <image src="<?php if(!empty($category['icon_url'])) {echo base_url('uploads/category-icon/'.$category['icon_url']);} ?>" alt="Image Not Found" class="img-thumbnail" style="width:160px; height:100px;">
                                                <?php } ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-1">Category Url</label>
                                                <div class="controls">
                                                    <input type="text" name="category_url" class="form-control category_url" id="field-1" placeholder="Enter Category Url" value="<?php if(!empty($category['category_url'])) { echo $category['category_url']; }?>">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-1">Category Banner Name</label>
                                                <div class="controls">
                                                    <input type="text" name="Category_banner_name" class="form-control Category_banner_name" id="field-1" placeholder="Enter Category Banner Name" value="<?php if(!empty($category['category_banner_name'])) { echo $category['category_banner_name']; }?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-3">Category Banner Images</label>
                                                <div class="controls">
                                                    <input type="file" name="images_url[]" class="form-control images_url" id="field-3" multiple="" accept="image/x-png,image/gif,image/jpeg">
                                                </div>
                                                <?php if(!empty($category['id'])){ ?>
                                                    <div id="banner-images" data-url="<?php echo base_url('category/banner-image-wrapper/'.$category['id']); ?>"></div>
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