            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Time Slot</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Time Slot</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Time Slot List</h2>
                            </header>
                            <div class="content-body">    
                            <div class="row">
                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                        <div id="banner-images" data-url="<?php echo base_url('settings/time-slot-wrapper'); ?>" enctype="multipart/form-data"> 
                                        </div>        
                                    </div>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <form name="uploadImages" id="uploadImages" method="post" action="<?php if(!empty($times['id'])) { echo base_url('settings/do_edit_time_slot/'.$times['id']); } else { echo base_url('settings/do_add_time_slot/'); } ?>">
                                            <div id="error_msg"></div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-1"><?php if(!empty($times['id'])){ echo "Edit "; } else { echo "Add ";}?> Start Time</label>
                                            
                                                <div class="controls">
                                                    <input type="time" name="start_time" class="form-control start_time" id="field-1" value="<?php if(!empty($times['start_time'])){ echo $times['start_time']; } ?>">
                                                </div>
                                            </div>
                                            <!--<div class="form-group">-->
                                            <!--    <label class="form-label" for="field-2"><?php if(!empty($times['id'])){ echo "Edit "; } else { echo "Add ";}?>End Time</label>-->
                                            <!--    <div class="controls">-->
                                            <!--        <input type="time" name="end_time" class="form-control end_time" id="field-2" value="<?php if(!empty($times['end_time'])){ echo $times['end_time']; } ?>"> -->
                                            <!--    </div>-->
                                            <!--</div>-->

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