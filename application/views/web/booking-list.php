<section class="faq_sec topSpace boxs">
        <div class="container">
            <div class="row faq_content">
                <div class="col-md-3 faq_lft book_lftt tabs">
                    <h4>Bookings</h4>
                    <ul class="nav nav-tabs booking myTab" id="myTab" role="tablist">
                        <li>
                            <a class="nav-link bookactive active" data-toggle="tab" href="#home" role="tab" aria-controls="home">Ongoing Bookings</a>
                        </li>
                        <li>
                            <a class="nav-link" data-toggle="tab" href="#profile" role="tab" aria-controls="profile">Past Bookings</a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-9 fqa_ryt booking_ryt">
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel">
                            <h3>The list of Ongoing Bookings</h3>
                            <div class="booking_cont">
                                <?php 
                                if(!empty($getBookings)){ 
                                foreach($getBookings as $ongoing){
                                 
                                ?>
                                <a href="<?php echo base_url('web-booking/ongoing/'.$ongoing['order_id']);?>">
                                    <div class="booking_box booking_boxnew">

                                        <div class="booking_lft">
                                            <div class="booking_img">
                                                <img src="<?php echo base_url('public/web/') ?>img/fan.png" class="img-fluid" alt="image">

                                            </div>
                                            <div class="boking_txt">
                                                <span class="bkng_id">
                                                    Booking Id : <?php echo $ongoing['booking_id'] ?>
                                                </span>
                                                <span class="bkng_prc">
                                                    &#x20b9 <?php echo $ongoing['payable_amount'] ?>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="booking_cntr">
                                            <span class="bkng_tym">
                                                <img src="<?php echo base_url('public/web/') ?>img/clock-2.svg" class="img-fluid" alt="image"><?php echo date('h:ia', strtotime($ongoing['service_time'])); ?>
                                            </span>
                                            <span class="bkng_date">
                                                <img src="<?php echo base_url('public/web/') ?>img/calendar-3.svg" class="img-fluid" alt="image"><?php echo $ongoing['service_date']; ?>

                                            </span>
                                        </div>
                                        <div class="booking_status">
                                            <span class="bkng_sts">
                                                Status
                                            </span>
                                            <span class="booking_dscp">
                                                <?php echo $ongoing['status'] ?>
                                            </span>

                                        </div>
                                    </div>
                                </a>
                                <?php } } else{  ?>
                                <p>No Ongoing Bookings yet.</p>
                                <?php } ?>
                              </div>

                        </div>
                        <div class="tab-pane" id="profile" role="tabpanel">
                            <h3>The list of Past Bookings</h3>
                            <div class="booking_cont">
                                 
                                <?php
                                if($getCancelledBooking){ 
                                foreach($getCancelledBooking as $cancel){  ?>
                                <div class="booking_box">
                                    <div class="booking_lft">
                                        <div class="booking_img">
                                            <img src="<?php echo base_url('public/web/') ?>img/fan.png" class="img-fluid" alt="image">

                                        </div>
                                        <div class="boking_txt">
                                            <span class="bkng_id">
                                                Booking Id : <?php echo $cancel['booking_id'] ?>
                                            </span>
                                            <span class="bkng_prc">
                                                &#x20b9 <?php echo $cancel['payable_amount'] ?>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="booking_cntr">
                                        <span class="bkng_tym">
                                            <img src="<?php echo base_url('public/web/') ?>img/clock-2.svg" class="img-fluid" alt="image"><?php echo date('h:ia', strtotime($cancel['service_time'])); ?>
                                        </span>
                                        <span class="bkng_date">
                                            <img src="<?php echo base_url('public/web/') ?>img/calendar-3.svg" class="img-fluid" alt="image"><?php echo $cancel['service_date']; ?>

                                        </span>
                                    </div>
                                    <div class="booking_status rebook">
                                        <a href="<?php echo base_url('web-booking/reshedule/'.$cancel['order_id']);?>" class="reshudBtn"><span class="bkng_sts reschued">
                                                Reschedule
                                            </span></a>


                                    </div>
                                </div>
                                <?php } } else { ?>
                                <p>No Past Bookings yet.</p>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
