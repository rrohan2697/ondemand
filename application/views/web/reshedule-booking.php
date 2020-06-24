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
                                            <img src="<?php echo base_url('public/web/') ?>img/clock-2.svg" class="img-fluid" alt="image"><?php echo $bookingDetails['service_time'] ?>
                                        </span>
                                    <span class="bkng_date">
                                            <img src="<?php echo base_url('public/web/') ?>img/calendar-3.svg" class="img-fluid" alt="image"><?php echo $bookingDetails['service_date'] ?>

                                        </span>
                                </div>
                                <div class="booking_status booking_statusnew rebook">
<!--
                                    <span class="bkng_sts">
                                            Status
                                        </span>
                                    <span class="booking_dscp">
                                            Ongoing
                                        </span>
-->
                                   
                                    <!--<a href="<?php echo base_url('Web_category/cart_show/'.$bookingDetails['order_id']) ?>"><span class="bkng_sts reschued">-->
                                    <!--        Reschedule-->
                                    <!--        </span></a>-->
                                            <a href="<?php echo base_url('Web_booking/cartReschedule/'.$bookingDetails['booking_id']) ?>"><span class="bkng_sts reschued">
                                            Reschedule
                                            </span></a>

                                </div>
                            </div>
                        </div>
                        <?php foreach($services as $service){   ?>
                        <div class="priceee_service">
                            <h3><?php echo $service['service_title']; ?></h3>
                            <div class="serviceee_cont serviceee_contnew serviceee_contnew_chk">
                                
                                    <div class="ceilling">
                                        <span class="ceilling_img">
                                        <img src="<?php echo base_url('uploads/service-icon/'.$service['icon_url']) ?>" class="img-fluid" alt="image">
                                      </span>
                                        <span class="ceilling_txt">
                                          
                                      </span>
                                        <span class="ceilling_prc">
                                          &#x20b9 <?php echo $service['price']; ?>
                                      </span>
                                      <div class="booking_status booking_statusnew2">
                                    <?php if($service['service_status'] == 'Cancelled'){ ?>
                                    
                                    <?php }else{ ?>
                                    <p  class="text-success"><?php echo $service['service_status']; ?></p>
                                    <?php } ?>
                                      </div> 
                                      
                                      <?php if($service['service_status'] != 'Cancelled') { ?>
                                        <div class="ReviewTab"><a href="javascript:void(0)" data-toggle="modal" data-target="#reviewModal">Review</a></div>
                                      <?php }else{ ?> 
                                      <p class="text-danger"><?php echo $service['service_status']; ?></p>
                                      <?php } ?>
                                        <div class="modal  otpPassword fade" id="reviewModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
<!--              <button type="button" class="close closeAll" data-dismiss="modal"><img src="img/cross.svg" alt="Close_Button" class="img-fluid">-->
                <form method="post" action="<?php echo base_url('Web_booking/doAddReviews/'.$service['id']) ?>" id="address">
                    <div id="error_msg"></div>
                    <div class="modal-body boxs">
                        <div class="profileHead profileHead2 boxs">
                            <h3 class="headingSize">Review and Rating</h3>
                        </div>
                        <div class="otpInner">
                            <div class="otpInput reviewAll boxs">
                                <div class="reviewAllnew">
                                    <ul class="rating_chk">
                                        <li ><a data-rating="1" href="#" class="fas fa-star"></a></li>
                                        <li><a data-rating="2" href="#" class="fas fa-star"></a></li>
                                        <li><a href="#" data-rating="3" class="fas fa-star"></a></li>
                                        <li><a href="#" class="fas fa-star" data-rating="4"></a></li>
                                        <li><a href="#" class="fas fa-star"  data-rating="5"></a></li>
                                    </ul>
                                    
                                </div>
                                <div class="rateExp">
                                    <input type="hidden" name="rating" id="rating" value="">
                                    <p class="headingSize"> Rate Your Experience</p>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control inputForm" rows="4" name="review" id="review"></textarea>
                                </div>
                                <div class="otpBtn">
                                    <button type="submit" class="formBtn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
                                    </div>
                                    
                            </div>
                            
                        </div>
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
                            <a href="<?php echo base_url('Web_booking/invoice/'.$bookingDetails['booking_id']) ?>" target="_blank">Download Invoice</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


