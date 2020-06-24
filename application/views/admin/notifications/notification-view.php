            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Notifications View</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Notifications View</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Notifications View List</h2>
                                <h2 class="title pull-right"><a href="<?php echo base_url('notifications');?>" class="btn btn-primary">Go Back</a></h2>
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
                                                    <th>Created</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Title</th>
                                                    <th>Description</th>
                                                    <th>Created</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                            <?php if(!empty($notifications)) { $i=1;?>
                                            <?php foreach($notifications as $notification) { ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php if(!empty($notification['title'])) { echo $notification['title']; }?></td>
                                                    <td><?php if(!empty($notification['body'])) { echo $notification['body']; }?></td>
                                                    <td><?php if(!empty($notification['created_at'])) { echo $notification['created_at']; }?></td>
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
            <!-- END CONTENT -->