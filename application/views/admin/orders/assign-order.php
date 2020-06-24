            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Assign Order to service Provider</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Services list</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Services List</h2>
                                 <a href="<?php echo base_url('Orders');?>" class="btn btn-primary pull-right">Go Back</a>
                                
                            </header>
                            <div class="content-body">    
                            <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Booking Id</th>
                                                    <th>Service Name</th>
                                                    <th>Image</th>
                                                    <th>Quantity</th>
                                                    <th>Price(₹)</th>
                                                    <th>Service Status</th>
                                                    <th>Assign Service Provider</th>
                                                    
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                   <th>Id</th>
                                                    <th>Booking Id</th>
                                                    <th>Service Name</th>
                                                    <th>Image</th>
                                                    <th>Quantity</th>
                                                    <th>Price(₹)</th>
                                                    <th>Service Status</th>
                                                    <th>Assign Service Provider</th>
                                                    
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                                
                                            <?php $i=1; foreach($services as $service) { ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php echo $service['booking_id']; ?></td>
                                                    <td><?php echo $service['service_title']; ?></td>
                                                    <td><img src="<?php echo base_url('uploads/service-icon/'.$service['icon_url']) ?>" class="img-responsive img-circle" style="width: 150px;height: 78px;"></td>
                                                    <td><?php echo $service['quantity']; ?></td>
                                                    <td><?php echo '₹' . $service['price']; ?></td>
                                                    <td> <?php if ($service['service_status'] == 'Completed' || $service['service_status'] == 'Cancelled') {
                                                                echo $service['service_status'];
                                                            } else { ?>
                                                       
                                                           

            <?php echo form_dropdown(['name' => 'service_status', 'id' => 'service_status', 'class' => 'form-control', 'data-url' => base_url('Orders/changeServiceStatus/' . $service['id'])], ['Ongoing' => 'Ongoing', 'Cancelled' => 'Cancelled', 'Completed' => 'Completed'], $service['service_status']); ?>
                                              <?php } ?>
                                                            </td>
                                                    <td><div class="form-group">
                                                <div class="controls">
                                                    <select name="category_name" class="form-control"  style="width:100%;" id="service_provider" data-url="<?php echo base_url('orders/assignServiceProvider/'.$service['id']) ?>">
                                                        <option value="">Select Service Provider</option>
                                                        
                                                        <?php if(!empty($serviceprovider)) { foreach($serviceprovider as $providername){ ?>
                                                        <option value="<?php echo $providername['id'] ?>" <?php if($providername['id'] == $service['service_provider_id']) { echo 'selected'; } ?>><?php if(!empty($providername['name'])){ echo $providername['name']; } ?></option>
                                                        <?php } } ?>
                                                    </select>
                                                </div>
                                            </div></td>
                                                    
                                                </tr>
                                            <?php $i++; } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </section>
            <!--Assign order -->