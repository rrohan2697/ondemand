            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Banner Images</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Banner Images</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Banner Images List</h2>
                            </header>
                            <div class="content-body">    
                            <div class="row">
                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                        <div id="banner-images" data-url="<?php echo base_url('settings/banner-images-wrapper'); ?>" enctype="multipart/form-data">
                                        </div>        
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <form name="uploadImages" id="uploadImages" method="post" action="<?php if(!empty($images['id'])) { echo base_url('settings/do-edit-banner-images/'.$images['id']); } else { echo base_url('settings/do-add-banner-images/'); } ?>">
                                            <div id="error_msg"></div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-1"><?php if(!empty($images['id'])){ echo "Edit "; } else { echo "Add ";}?> Image</label>
                                                <div class="controls">
                                                    <input type="file" name="image_url" class="form-control image_url" id="field-1">
                                                </div>
                                                <?php if(!empty($images['image_url'])) { ?>
                                                <image src="<?php if(!empty($images['image_url'])) {echo base_url('uploads/main-banner-images/'.$images['image_url']);} ?>" alt="Image Not Found" class="img-thumbnail" style="width:250px; height:180px;">
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
            <!--CategoryCONTENT -->