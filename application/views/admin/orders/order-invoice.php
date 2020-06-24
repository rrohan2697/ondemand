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
                     <div class="clearfix"></div>
                       <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left"></h2>
                                <a href="<?php echo base_url('Orders');?>" class="btn btn-primary pull-right">Back</a>
                            </header>
                            <div></div>
                               <div class="row">
                                        <div class="col-md-6">
                                            Customer:<br/>
                                            <?php echo '<b>' . $order['user_name'] . '</b>'; ?><br/>
                                            <?php
                                           
                                                echo $addresses['address_line_1'] . ',' . $addresses['address_line_2'] . '-' . $addresses['zipcode'];
                                           
                                            ?><br/>

                                            Phone: <?php echo $order['country_code'] . $order['phone_number']; ?><br/>
                                            Email: <?php echo $order['email']; ?>
                                        </div>
                                        <div class="col-md-3">
                                            <br/>
                                            <b>Order Id:</b> <?php echo $order['booking_id']; ?><br>
                                            <b>Order Date:</b> <?php echo $order['service_date']; ?><br>
                                            <b>Order Time:</b> <?php echo $order['service_time']; ?><br>
                                            <b>Payment Mode:</b> <?php echo $order['order_type']; ?>
                                        </div>
                                        <div class="col-md-3">
                                            <br/>
                                            <b>Order Status:</b> <?php
                                            
                                                echo $order['status'];
                                            
                                            ?></br>
                                            <b>Download Invoice:</b> <a href="<?php echo base_url('Orders/invoice/' . $order['booking_id']."/".$order['order_id']); ?>" target="_blank">Download</a>
                                        </div>
                                      </div>
                                
                            <div class="content-body">    
                            <div class="row">
                                        <div class="col-md-12">

                                            <table width="100%" class="table table-bordered table-responsive table_chain" style="margin-bottom: 0px">
                                                <tbody class="boxs table_row">
                                                <div class="col-sm-6">
                                                    <div class="boxs">
                                                        <tr style="border-bottom: 1px solid black">
                                                            <td class="table_td"style="text-align: left">
                                                                Buyer</br>
                                                                <?php echo '<b>' . $order['user_name'] . '</b>'; ?><br/>
                                                                <?php
                                                            
                                                                    echo $addresses['address_line_1'] . ',' . $addresses['address_line_2'] . '-' . $addresses['zipcode'];
                                                                   
                                                                
                                                                ?><br/>
                                                                City: <?php echo $addresses['city']; ?><br/>
                                                                Phone: <?php echo $order['country_code'] . $order['phone_number']; ?><br/>
                                                                Email: <?php echo $order['email']; ?>
                                                            </td>
                                                            <td>
                                                                <table width="100%">
                                                                    <tr style="text-align: left; border-bottom: 1px solid black">
                                                                        <td  class ="table_td" style="text-align: left; border-right: 1px solid black;width: 50%">Invoice No.<br> <?php echo $order['order_id']; ?></td>
                                                                        <td>Dated: <br> <b><?php echo $order['service_date']; ?></b></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="text-align: left">Mode/Terms of Payment  </td>
                                                                        <td><?php echo $order['order_type']; ?></td>
                                                                    </tr>   
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </div>
                                                </div>
                                                
                                                </tbody>
                                            </table>
                                            <table width="100%" class="table table-bordered table-responsive">
                                                <tr style="border-bottom: 1px solid black">
                                                    <th>SI No.</th>
                                                    <th>Service Name</th>
                                                    <th>Price</th>
                                                    <th>Quantity</th>
                                                    <th>Rate</th>
                                                </tr>
                                                <?php
                                                $i = 1;
                                                $quantity = 0;
                                                $total = 0;
                                                foreach ($booking_order_detail as $booking_order_details) {
                                                    ?>
                                                    <tr style="border-bottom: 1px solid black">
                                                        <td><?php echo $i; ?></td>
                                                        <td><?php echo $booking_order_details['service_title']; ?></td>
                                                        
                                                        <td><b><?php echo '₹' . number_format($booking_order_details['price'], 2); ?></b></td>
                                                        <td><b><?php
                                                                echo $booking_order_details['quantity'];
                                                               
                                                                ?></b></td>
                                                        <td> <?php
                                                             $sub_total = $booking_order_details['quantity'] * $booking_order_details['price'];
                                                            $total = $order['total_amount'];
                                                             echo '₹' . number_format($sub_total, 2);
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                               
                                                ?>
                                                <tr style="border-bottom: 1px solid black">
                                                    <td colspan="4" style="text-align: right"><b>Subtotal</b></td>
                                                    <td> <?php echo '₹' . number_format($total, 2); ?> </td>
                                                </tr>
                                                <tr style="border-bottom: 1px solid black">
                                                    <td colspan="4" style="text-align: right"><b>Convenience Charge</b></td>
                                                    <td> <?php
                                                        if (!empty($order['convenience_charge'])) {
                                                            echo ' ₹' . number_format($order['convenience_charge'], 2);
                                                        } else {
                                                            echo '0.00';
                                                        }
                                                        ?> </td>
                                                </tr>
                                                 <tr style="border-bottom: 1px solid black">
                                                    <td colspan="4" style="text-align: right"><b>Service Tax</b></td>
                                                    <td> <?php
                                                        if (!empty($order['service_tax'])) {
                                                            echo '₹' .  $order['service_tax'];
                                                        } else {
                                                            echo '₹' . '0.00';
                                                        }
                                                        ?> </td>
                                                </tr>
                                                <tr style="border-bottom: 1px solid black">
                                                    <td colspan="4" style="text-align: right"><b>Total</b></td>
                                                    <td> <?php if (!empty($order['payable_amount'])) { echo '₹' . number_format($order['payable_amount'], 2); } ?> </td>
                                                </tr>

                                            </table>

                                        </div>
                                    </div>
                            </div>

                        </section>

                </section>
            </section>
            <!-- END CONTENT -->