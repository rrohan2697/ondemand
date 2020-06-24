            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Orders Management</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Orders Management</a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="#error_msg"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Orders List</h2>
                            </header>
                            <div class="content-body">    
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Order Id</th>
                                                    <th>User Name</th>
                                                    <th>Order Type</th>
                                                    <th>Order Status</th>
                                                    <th>Action</th>
                                                    <!-- <th>Action</th> -->
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php if(!empty($orders)) { 
                                                    $i=1;
                                                    ?>
                                                    <?php foreach($orders as $order) { 
                                                    ?>
                                                        <tr>
                                                            <td><?php echo $i; ?></td>
                                                            <td><?php if(!empty($order['booking_id'])) { echo $order['booking_id']; }?></td>
                                                            <td><?php if(!empty($order['user_name'])) { echo $order['user_name']; }?></td>
                                                            <td><?php if(!empty($order['order_type'])) { echo $order['order_type']; }?></td>
                                                            <td><?php
                                                            if ($order['status'] == 'Completed' || $order['status'] == 'Cancelled') {
                                                                echo $order['status'];
                                                            } else { ?>

                                                                <?php echo form_dropdown(['name' => 'order_status', 'id' => 'order_status', 'class' => 'form-control change-order-status', 'data-url' => base_url('Orders/changeOrderStatus/' . $order['order_id'] . '/' .$order['booking_id'])], ['Ongoing' => 'Ongoing', 'Cancelled' => 'Cancelled', 'Completed' => 'Completed'], $order['status']); ?>

                                                            <?php } ?>
                                                        </td>
                                                    
                                                    <td>
                                                        <a href="<?php echo base_url('orders/order_detail/' . $order['booking_id']); ?>" data-toggle="tooltip" data-placement="top" title="View Order" class="btn btn-primary btn-sm">View <i class="fa fa-eye"></i></a>
                                                        <a href="<?php echo base_url('orders/assignOrder/'.$order['booking_id']); ?>" data-toggle="tooltip" data-placement="top" title="View Order" class="btn btn-primary btn-sm">Assign Order <i class="fa fa-tasks" aria-hidden="true"></i></a>
                                                    </td>
                                                    <!-- <td></td> -->
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