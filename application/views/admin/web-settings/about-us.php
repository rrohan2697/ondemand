            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">About-us</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">About-us</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">About-us</h2>
                            </header>
                            <div class="content-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <form name="common-form" id="common-form" method="post" action="<?php if(!empty($about_us['id'])) { echo base_url('settings/edit-about-us/'.$about_us['id']); } ?>">
                                            <div id="error_msg"></div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-6">About-us</label>
                                                <div class="controls">
                                                    <textarea class="form-control content_description summernote" name="content_description" cols="5" id="field-6" placeholder="Enter About-us of Description "><?php if(!empty($about_us['content_description'])) { echo $about_us['content_description']; } ?></textarea>
                                                </div>
                                            </div>

                                            <div class="">
                                                <button type="submit" name="submit" class="btn btn-success">Save Changes</button>
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