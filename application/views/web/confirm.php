<section class="price_dscp topSpace boxs">
        <div class="container">
            <div class="price_box">
                <div class="row">
                    <div class="col-md-7">
                       <div class="cnfrmbook_head"> 
                            <h3>Booking Confirmation</h3>
                        </div>
                        <div class="booking_cnfrmation">
                            
                            <div class="cnfrm_id">
                                <span class="id_book">Booking Id :</span>
                                <span class="cnfrm_no"><?php echo  $bookingDetails['booking_id'];  ?></span>
                            </div>
                            <div class="e_messgae">
                                <div class="emsg_lft">
                                    <span class="e_crct">
                                        <i class="fas fa-check"></i>
                                    </span>
                                </div>
                                <div class="emsg_ryt">
                                    <span class="emsg_cont">Your service is successfully Scheduled. </span>
                                    <span class="eml_cnfrm">
                                        An Email confirmation has been sent to your account 
                                    </span>
                                </div>
                            </div>
                            <div class="booking_schedule">
                                <span class="scdl_lft">Booking schedule :</span>
                                <span class="schdl_ryt"><?php echo  $bookingDetails['service_time'];  ?> | <?php echo  $bookingDetails['service_date'];  ?></span>
                            </div>
                            <div class="booking_schedule booking_add">
                                <span class="scdl_lft">Booking Address :</span>
                                <span class="schdl_ryt"><?php echo  $bookingDetails['user_name'];  ?></span>
                                <span class="schdl_add"><?php echo  $bookingDetails['address_line_1'];  ?>,<?php echo  $bookingDetails['address_line_2'];  ?>,<?php echo  $bookingDetails['city'];  ?>,<?php echo  $bookingDetails['zipcode'];  ?></span>

                            </div>
                            
                        </div>
                        <div class="priceee_left">
                            <div class="priceee_service">
                                <h3>Services</h3>
                                <div class="serviceee_cont">
                                    <?php foreach($services as $service){   ?>
                                    <div class="ceilling">
                                        <span class="ceilling_img">
                                        <img src="<?php echo base_url('uploads/service-icon/'.$service['icon_url']) ?>" class="img-fluid" alt="image">
                                      </span>
                                        <span class="ceilling_txt">
                                          <?php echo $service['service_title']; ?>
                                      </span>
                                        <span class="ceilling_prc">
                                          &#x20b9 <?php echo $service['price']; ?>
                                      </span>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                </div>
                    <div class="col-md-5 priceee_ryt">
                        <div class="price_detailss">
                            <h3>Price Details</h3>
                            <div class="ttl_amnt top_amnt">
                                <span class="amnt">total Amount</span>
                                <span class="amnt_value">&#x20b9 <?php echo $bookingDetails['total_amount']; ?></span>
                            </div>
                            <div class="ttl_amnt">
                                <span class="amnt">Convenience Charges</span>
                                <span class="amnt_value">&#x20b9 <?php echo  $bookingDetails['convenience_charge'];  ?></span>
                            </div>
                            <div class="ttl_amnt">
                                <span class="amnt">Service Tax</span>
                                <span class="amnt_value">&#x20b9 <?php echo  $bookingDetails['service_tax'];  ?></span>
                            </div>
<!--
                            <div class="ttl_amnt amnt_brdr">
                                <span class="amnt">Promo code</span>
                                <span class="amnt_value promo"><span class="mnss">-</span>Rs 150</span>

                            </div>
-->
                            <div class="ttl_amnt payble">
                                <span class="amnt">Payable Amount</span>
                                <span class="amnt_value">&#x20b9 <?php echo  $bookingDetails['payable_amount'];  ?></span>

                            </div> 
                        </div>
                        
                        <div class="download_booking">
                            <a href="<?php echo base_url('Web_booking/invoice/'.$bookingDetails['booking_id']) ?>" target="_blank">Download Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>