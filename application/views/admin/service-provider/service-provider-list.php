            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Service Providers List</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Service Providers List</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Service Providers List</h2>
                                <a href="<?php echo base_url('service-provider/add');?>" class="btn btn-primary pull-right">Add New Service provider</a>
                            </header>
                            <div class="content-body">    
                            <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone No.</th>
                                                    <th>Category</th>
                                                    <!--<th>Status</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone No.</th>
                                                    <th>Category</th>
                                                    <!--<th>Status</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                            <?php if(!empty($service_providers)) { $i=1;?>
                                            <?php foreach($service_providers as $service) { ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><img src="<?php if(!empty($service['profile_url'])) { echo base_url('uploads/service-provider-profile/'.$service['profile_url']);} else { echo base_url('public/data/profile/profile.png');}?>" width="80px" height="60px" class="img-responsive img-circle" width="150px" height="150px"></td>
                                                    <td><?php if(!empty($service['name'])) { echo $service['name']; }?></td>
                                                    <td><?php if(!empty($service['email'])) { echo $service['email']; }?></td>
                                                    <td><?php if(!empty($service['phone_number'])) { echo $service['phone_number']; }?></td>
                                                    <td><?php if(!empty($service['category_name'])) { echo $service['category_name']; }?></td>
                                                   
                                                    <td>
                                                        <a href="<?php echo base_url('service-provider/add/'.$service['id']);?>"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                        <a href="<?php echo base_url('service-provider/view/'.$service['id']);?>"><i class="fa fa-eye fa-2x"></i></a>
                                                        <a href="<?php echo base_url('service-provider/do-delete/'.$service['id']);?>" class="delete"><i class="fa fa-trash-o fa-2x"></i></a>
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
            <!-- END CONTENT -->