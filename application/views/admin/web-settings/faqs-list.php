            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">FAQs</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">FAQs</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">FAQs List</h2>
                                <h2 class="title pull-right"><a href="<?php echo base_url('settings/faqs-add');?>" class="btn btn-primary">Add New FAQ</a></h2>
                            </header>
                            <div class="content-body">    
                            <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <!--<th>Status</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <!--<th>Status</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                            <?php if(!empty($faqs)) { $i=1;?>
                                            <?php foreach($faqs as $faq) { ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php if(!empty($faq['title'])) { echo $faq['title']; }?></td>
                                                    <td><?php if(!empty($faq['description'])) { echo $faq['description']; }?></td>
                                                   
                                                    <td>
                                                        <a href="<?php echo base_url('settings/faqs-add/'.$faq['id']);?>"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                        <a href="<?php echo base_url('settings/do-delete-faqs/'.$faq['id']);?>" class="delete"><i class="fa fa-trash-o fa-2x"></i></a>
                                                    </td>
                                                </tr>
                                            <?php $i++; }?>
                                            <?php  } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </section>
            <!--CategoryCONTENT -->