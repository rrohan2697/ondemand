<section class="price_dscp topSpace boxs">
        <div class="container">
            <div class="price_box">
                <div class="row">
                    <div class="col-md-7 priceee_left">
                        <div class="priceee_img">
                            <img src="<?php echo base_url('public/web/') ?>img/review_banner.png" class="img-fluid" alt="image">
                        </div>
                        <div class="priceee_cont">
                            <div class="booking_box">
                                <div class="booking_lft">

                                    <div class="boking_txt">
                                        <span class="bkng_id">
                                            Booking Id : <?php echo $bookingDetails['booking_id'] ?>
                                            </span>
                                        <span class="bkng_prc">
                                            &#x20b9 <?php echo $bookingDetails['payable_amount'] ?>
                                            </span>
                                    </div>
                                </div>
                                <div class="booking_cntr">
                                    <span class="bkng_tym">
                                            <img src="<?php echo base_url('public/web/') ?>img/clock-2.svg" class="img-fluid" alt="image"><?php echo date('h:ia', strtotime($bookingDetails['service_time'])); ?>
                                        </span>
                                    <span class="bkng_date">
                                            <img src="<?php echo base_url('public/web/') ?>img/calendar-3.svg" class="img-fluid" alt="image"><?php echo $bookingDetails['service_date']; ?>

                                        </span>
                                </div>
                                <div class="booking_status">
                                    <span class="bkng_sts">
                                            Status
                                        </span>
                                    <span class="booking_dscp">
                                            <?php echo $bookingDetails['status'] ?>
                                        </span>

                                </div>
                            </div>
                        </div>
                        <hr>
                        <?php foreach($services as $service){   ?>
                        <div class ="ongoingAlnew">
                        <div class="priceee_service">
                            <h3><?php echo $service['service_title']; ?></h3>
                            
                            <div class="serviceee_cont">
                                    <div class="ceilling">
                                        <span class="ceilling_img">
                                        <img src="<?php echo base_url('uploads/service-icon/'.$service['icon_url']) ?>" class="img-fluid" alt="image">
                                      </span>
                                      <div class ="onLineDiv">
                                        <span class="ceilling_txt">
                                          
                                      </span>
                                        <span class="ceilling_prc">
                                          &#x20b9 <?php echo $service['price']; ?>
                                      </span>
                                      <div class="booking_status booking_statusnew2">
                                    <!--<span class="booking_dscp booking_dscp2">-->
                                    <?php if($service['service_status'] == 'Cancelled'){ ?>
                                    <?php }else{ ?>
                                    
                                    
                                    <p  class="text-success"><?php echo $service['service_status']; ?></p>
                                    
                                    
                                    <?php } ?>
                                            <!--</span>-->

                                </div>
                                      </div>
                                    </div>
                                    
                                    
                                   
                            </div>
                        </div>
                                  
                                      
                                      
                           <?php  if(!empty($service['provider_name'])) {  ?>
                            <div class="provider_details">
                            <h3>Service Provider Details</h3>
                            <div class="ceilling">
                                    <span class="ceilling_img">
                                    <img src="<?php echo base_url('uploads/service-provider-profile/'.$service['provider_image']) ?>" class="img-fluid" alt="image">
                                  </span>
                                    <span class="ceilling_txt">
                                      <?php echo $service['provider_name']; ?>
                                  </span>
                                    <span class="ceilling_prc">
                                      (+91) <?php echo $service['provider_no']; ?>
                                  </span>
                                  <div class ="cancelBtn2">
                                      <a href ="<?php echo base_url('Web_booking/cancelService/'.$service['orderId']) ?>" class="cancel">Cancel</a>
                                      </div>
                                </div>
                        </div>
                        <?php }else { 
                        if($service['service_status'] != 'Cancelled'){
                        ?>
                        
                        <div class ="cancelBtn2">
                                      <a href ="<?php echo base_url('Web_booking/cancelService/'.$service['orderId']) ?>" class="cancel">Cancel</a>
                                      </div>
                        <?php } else{ ?>
                        <p class="text-danger"><?php echo $service['service_status']; ?></p>
                        
                        <?php  }  } ?>
                        </div>
                        <hr>
                         <?php } ?>
                    </div>
                    <div class="col-md-5 priceee_ryt">
                        <div class="price_detailss">
                            <h3>Price Details</h3>
                            <div class="ttl_amnt top_amnt">
                                <span class="amnt">total Amount</span>
                                <span class="amnt_value">&#x20b9 <?php echo $bookingDetails['total_amount'] ?></span>
                            </div>
                            <div class="ttl_amnt">
                                <span class="amnt">Convenience Charges</span>
                                <span class="amnt_value">&#x20b9 <?php echo $bookingDetails['convenience_charge'] ?></span>
                            </div>
                            <div class="ttl_amnt">
                                <span class="amnt">Service Tax</span>
                                <span class="amnt_value">&#x20b9 <?php echo $bookingDetails['service_tax'] ?></span>
                            </div>
<!--
                            <div class="ttl_amnt amnt_brdr">
                                <span class="amnt">Promo code</span>
                                <span class="amnt_value promo"><span class="mnss">-</span>Rs 150</span>

                            </div>
-->
                            <div class="ttl_amnt payble">
                                <span class="amnt">Payable Amount</span>
                                <span class="amnt_value">&#x20b9 <?php echo $bookingDetails['payable_amount'] ?></span>

                            </div> 
                        </div>

                        <div class="prvdr_dtls">
                            <div class="prvdr_lft">
                                <span class="adrss">Address :</span>
                            </div>
                            <div class="prvdr_ryt">
                                    <span class="prvdr_nm"><?php echo $bookingDetails['user_name'] ?></span>
                                    <span class="prvdr_ads">
                                        <?php echo $bookingDetails['address_line_1'] ?>,<?php echo $bookingDetails['address_line_2'] ?></span>
                                    <span class="prvdr_ads uttrpradesh"> <?php echo $bookingDetails['city'] ?>, <?php echo $bookingDetails['zipcode'] ?>
                                    </span>
                            </div>
                        </div>
                        <div class="download_booking">
                            <a href="<?php echo base_url('Web_booking/cancelBooking/'.$bookingDetails['order_id']) ?>" class="cancel">Cancel Booking</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>