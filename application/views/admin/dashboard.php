            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box nobox">
                            <div class="content-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="r1_graph1 db_box">
                                            <a href="<?php echo base_url('users');?>">
                                            
                                            <span class='bold'><?php if(!empty($total_users)){ echo $total_users;} ?></span>
                                                <span class='pull-right'><small>Total Number of User</small></span>
                                            <div class="clearfix"></div>
                                            <span class="db_dynamicbar"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="r1_graph2 db_box">
                                             <a href="<?php echo base_url('Orders');?>">
                                            <span class='bold'><?php if(!empty($booking)){ echo $booking;} ?></span>
                                            <span class='pull-right'><small>Total Number of Booking</small></span>
                                            <div class="clearfix"></div>
                                            <span class="db_linesparkline"></span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="r1_graph3 db_box hidden-xs">
                                             <a href="<?php echo base_url('Orders');?>">
                                            <span class='bold'><?php if(!empty($ongoingbooking)){ echo $ongoingbooking;} ?></span>
                                            <span class='pull-right'><small>Total Number of Ongoing Booking</small></span>
                                            </a>
                                            <div class="clearfix"></div>
                                            <span class="db_compositebar"></span>
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-4">
                                        <div class="r1_graph1 db_box">
                                            <span class='bold'>50</span>
                                            <span class='pull-right'><small>Total Users</small></span>
                                            <div class="clearfix"></div>
                                            <span class="db_dynamicbar">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="r1_graph2 db_box">
                                            <span class='bold'>10</span>
                                            <span class='pull-right'><small>Total Service Provider</small></span>
                                            <div class="clearfix"></div>
                                            <span class="db_linesparkline">Loading...</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="r1_graph3 db_box hidden-xs">
                                            <span class='bold'>25</span>
                                            <span class='pull-right'><small>Total Booking</small></span>
                                            <div class="clearfix"></div>
                                            <span class="db_compositebar">Loading...</span>
                                        </div>
                                    </div> -->
                                </div> <!-- End .row -->
                            </div>
                        </section>
                    </div>
                </section>
            </section>
            <!-- END CONTENT -->