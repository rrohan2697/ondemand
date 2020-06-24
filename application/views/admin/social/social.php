            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Social link</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Social link</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
        
                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Social link</h2>
                            </header>
                            <div class="content-body">    
                            <div class="row">
                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                        <div id="banner-images" data-url="<?php echo base_url('users/social_wrapper'); ?>" enctype="multipart/form-data">
                                        </div>        
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <div id="error_msg"></div>

                                        <form name="uploadImages" id="uploadImages" method="post" action="<?php if(!empty($social['id'])) { echo base_url('users/do_edit_social/'.$social['id']); } else { echo base_url('users/do_add_social/'); } ?>">
                                            <div id="error_msg"></div>
                                            <div class="form-group">
                                            <label for="coupon_value">Name</label>
                                            <?php echo form_input(['name' => 'name', 'placeholder' => 'Enter Name', 'id' => 'name', 'class' => 'form-control name'], isset($social['name']) ? $social['name'] : '') ?>
                                        </div>

                                             <div class="form-group">
                                            <label for="coupon_value">social link</label>
                                            <?php echo form_input(['name' => 'social_link', 'placeholder' => 'Enter Social link', 'id' => 'social_link', 'class' => 'form-control social_link'], isset($social['sociallink']) ? $social['sociallink'] : '') ?>
                                        </div>
                                         <?php if(!empty($social['id'])) { ?>
                                            <div class="">
                                                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                                            </div>
                                            <?php } ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </section>
            <!--CategoryCONTENT -->