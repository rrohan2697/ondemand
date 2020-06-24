            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title"><?php if(!empty($faqs['id'])) { echo "Edit";} else {echo "Add ";}?> FAQs</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;"><?php if(!empty($faqs['id'])) { echo "Edit";} else {echo "Add ";}?> FAQs</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left"><?php if(!empty($faqs['id'])) { echo "Edit";} else {echo "Add ";}?> FAQs</h2>
                                <h2 class="title pull-right"><a href="<?php echo base_url('settings/faqs');?>" class="btn btn-primary">Go Back</a></h2>
                            </header>
                            <div class="content-body">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <form name="common-form" id="common-form" method="post" action="<?php if(!empty($faqs['id'])) { echo base_url('settings/do-edit-faqs/'.$faqs['id']); } else { echo base_url('settings/do-add-faqs/'); } ?>">
                                            <div id="error_msg"></div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-1">Title</label>
                                                <div class="controls">
                                                    <input type="text" name="title" class="form-control title" id="field-1" placeholder="Enter FAQ's Title" value="<?php if(!empty($faqs['title'])) { echo $faqs['title']; } ?>">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-6">Description</label>
                                                <div class="controls">
                                                    <textarea class="form-control description summernote" name="description" cols="5" id="field-6" placeholder="Enter EAQ's Description..."><?php if(!empty($faqs['description'])) { echo $faqs['description']; } ?></textarea>
                                                </div>
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