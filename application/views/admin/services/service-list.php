            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Service Management</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Service Management</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Service  List</h2>
                                <a href="<?php echo base_url('services/add');?>" class="btn btn-primary pull-right">Add New Service</a>
                            </header>
                            <div class="content-body">    
                            <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Image</th>
                                                    <th>Service Title</th>
                                                    <th>Price(₹)</th>
                                                    <th>Category</th>
                                                    <!--<th>Status</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Image</th>
                                                    <th>Service Title</th>
                                                    <th>Price(₹)</th>
                                                    <th>Category</th>
                                                    <!--<th>Status</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                            <?php if(!empty($services)) { $i=1;?>
                                            <?php foreach($services as $service) { ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><img src="<?php if(!empty($service['icon_url'])) { echo base_url('uploads/service-icon/'.$service['icon_url']);} else { echo base_url('public/data/profile/profile.png');}?>" class="img-responsive img-circle" width="150px" height="150px"></td>
                                                    <td><?php if(!empty($service['service_title'])) { echo $service['service_title']; }?></td>
                                                    <td><?php if(!empty($service['price'])) { 
                                                         setlocale(LC_MONETARY, 'en_IN.UTF-8');
                                                     echo money_format('&#x20b9;%!n', $service['price']); }?></td>
                                                    <td><?php if(!empty($service['category_name'])) { echo $service['category_name']; }?></td>
                                                    
                                                    <td>
                                                        <a href="<?php echo base_url('services/add/'.$service['id']);?>"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                        <a href="<?php echo base_url('services/view/'.$service['id']);?>"><i class="fa fa-eye fa-2x"></i></a>
                                                        <a href="<?php echo base_url('services/do-delete/'.$service['id']);?>" class="delete"><i class="fa fa-trash-o fa-2x"></i></a>
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