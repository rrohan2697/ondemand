<div class="producttabsList">
                    <div class="row">
                        <div class="col-sm-7">
                            
                            <div class="cartReview boxs">
                                <div class="cartReviewTop boxs">
                                    <h3 class="headingSize">Cart and Review</h3>
                                </div>
                                <div class="cartReviewMid1 boxs">
                                    <?php
                                    if(!empty($services)) { 
                                    foreach($services as $service) {
                                    ?>
                                    <div class="categoryProduct">
                                        <div class="productImage">
                                            <img src="<?php echo base_url('uploads/service-icon/'.$service['icon_url']) ?>" alt="Product Image" class="img-fluid">
                                        </div>
                                        <div class="productDetails">
                                            <p class="headingSize prodDescription"><?php echo $service['service_title'] ?></p>
                                            <p class="headingSize prodPrice">&#x20b9 <?php echo $service['price'] ?></p>
                                            <a href="<?php echo base_url('Web_category/serviceDetail/'.$service['id']) ?>">
                                                <p class="subHeading viewDetails">View details</p>
                                            </a>
                                        </div>
                                        
                                         <div class="addProduct addProduct1">
                                            <div class="vaulebox valuebox_add" data-url="">
                                                <button type="button" class="minus_btn">-</button>
                                                <input type="text" value="<?php echo $service['quantity']; ?>" class="qty">
                                                <p class="productAdd">Add</p>
                                                <button type="button" class="plus_btn">+</button>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <input type="hidden" name="service[]" value="<?php echo $service['id']; ?>">
                                    <input type="hidden" name="prices[]" value="<?php echo $service['price']; ?>">
                                    <input type="hidden" name="quantities[]" value="<?php echo $service['quantity']; ?>">
                                    <?php } } else {  ?>
                                    
                                    
                                    <?php 
                                        foreach($this->cart->contents() as $cart) {   ?>
                                    <div class="categoryProduct">
                                        <div class="productImage">
                                            <img src="<?php echo base_url('uploads/service-icon/'.$cart['image']) ?>" alt="Product Image" class="img-fluid">
                                        </div>
                                        <div class="productDetails">
                                            <p class="headingSize prodDescription"><?php echo $cart['name'] ?></p>
                                            <p class="headingSize prodPrice">&#x20b9 <?php echo $cart['price'] ?></p>
                                            <a href="<?php echo base_url('Web_category/serviceDetail/'.$cart['id']) ?>">
                                                <p class="subHeading viewDetails">View details</p>
                                            </a>
                                        </div>
                                        <div class="addProduct addProduct1">
                                            <div class="vaulebox valuebox_add" data-url="<?php echo base_url('Web_booking/addQuantity/'.$cart['rowid']);?>">
                                                <button type="button" class="minus_btn">-</button>
                                                <input type="text" value="<?php echo $cart['qty']; ?>" class="qty">
                                                <p class="productAdd">Add</p>
                                                <button type="button" class="plus_btn">+</button>
                                            </div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="service[]" value="<?php echo $cart['id']; ?>">
                                    <input type="hidden" name="prices[]" value="<?php echo $cart['price']; ?>">
                                    <input type="hidden" name="quantities[]" value="<?php echo $cart['qty']; ?>">
                                    <?php } } ?>
                                </div>
                                
                                <div class="cartReviewBtm boxs">
                                    <div class="proceedBtn">
                                        <?php if(!empty($this->session->userdata('user_email'))){  ?>
                                       <button  type="submit" class="btn_checkout">Proceed For Checkout <span>&#x20b9 <?php if(!empty($id)){ echo $bookingDetails['total_amount']; } else { echo $this->cart->total(); }  ?></span></button>
                                        
                                        <?php }else{   ?>
                                        <a href="javascript:;" data-toggle="modal" data-target="#signupModal">Proceed For Checkout <span>&#x20b9 <?php  echo $this->cart->total(); ?></span></a>

                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="bookingSchedule boxs">
                                <?php if(!empty($this->session->userdata('user_email'))) {  ?>
                                <div class="bookingTop boxs">
                                    <div id="error_msg"></div>
                                    <div class="cartReviewTop boxs">
                                        <h3 class="headingSize">Booking Schedule</h3>
                                    </div>
                                    <div class="bookingInfo boxs">
                                        <div class="form-group">
                                            <label class="labelForm">Booking Date</label>

                                            <input type="text" id="datepicker" name="datepicker" placeholder="Select Date" class="form-control " readonly autocomplete="off" data-url="<?php echo base_url('Web/getDateData') ?>">
                                            <a href="javascript:void(0)" class="dateClick"> <span><img src="<?php echo base_url('public/web/') ?>img/date.svg" aria-label="icon" class="img-fluid"></span> </a>
                                        </div>
                                        <div class="form-group">
                                            <label class="labelForm">Booking Time</label>
                                            <input type="text" id="timeOptn" name="timeOptn" placeholder="Select Time" class="form-control datePost TimeShow" data-toggle="modal" data-target="#timeSlotModal" readonly>
                                            <a href="javascript:void(0)" class="dateClick"> <span><img src="<?php echo base_url('public/web/') ?>img/time.svg" aria-label="icon" class="img-fluid"></span> </a>
                                        </div>
                                        <div class="form-group chooseAddress">
                                            <label class="labelForm">Address</label>
                                            <!-- <input type="button" class="form-control selectAdd" id="selectAdd"> -->
                                            <div class="selectAddress">
                                                
                                                <ul>
                                                    <li class="addrSection">Select from saved Address :</li>
                                                    <div class="addrInner box">
                                                        <ul>
                                                            <li class="addressChoose" data-val="">Select from saved Address :</li>
                                                            <?php foreach($address as $add) {  ?>
                                                            <li data-val="<?php echo $add['address_id'] ?>"><span class="nameInfo" ></span><?php echo $add['address_line_1'] ?>…<span class="addrLocation"><?php echo $add['type'] ?></span>
                                                            </li>
                                                            <?php } ?>
                                                            <input type="hidden" name="addressid" id="addressid" value="">
                                                            <li><a href="<?php echo base_url('Web_booking/address') ?>">Add Address</a></li>
                                                        </ul>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="priceDetails boxs">
                                    <div class="cartReviewTop boxs">
                                        <h3 class="headingSize">Price Details</h3>
                                    </div>
                                    <div class="priceInfo boxs">
                                        <?php if(!empty($id)) {  ?>
                                        <table class="amountDetails">
                                            <tr class="amountDesc">
                                                <td>Total Amount</td>
                                                <td class="amountRight">&#x20b9 <?php echo $bookingDetails['total_amount']; ?></td>
                                            </tr>
                                            <tr class="amountDesc">
                                                <td>Convenience Charges</td>
                                                <td class="amountRight">&#x20b9 <?php echo $bookingDetails['convenience_charge']; ?></td>
                                            </tr>
                                            <tr class="amountDesc">
                                                
                                                <td>Service Tax(<?php  echo $service_charges['tax_charge'];?>%)</td>
                                                <td class="amountRight">&#x20b9 <?php echo $bookingDetails['service_tax']; ?></td>
                                            </tr>
                                            <tr class="amountDesc totalAmount">
                                                <td>Payable Amount</td>                                                
                                                <td class="amountRight">&#x20b9 <?php echo $bookingDetails['payable_amount']; ?></td>
                                                <input type="hidden" name="total" value="<?php echo $bookingDetails['payable_amount']; ?>">
                                                <input type="hidden" name="service_tax" value="<?php echo $bookingDetails['service_tax']; ?>">
                                                <input type="hidden" name="charges" value="<?php echo $bookingDetails['convenience_charge']; ?>">
                                                <input type="hidden" name="total_amount" value="<?php echo $bookingDetails['total_amount']; ?>">
                                            </tr>
                                        </table>
                                        <?php } else {  ?>
                                        <table class="amountDetails">
                                            <tr class="amountDesc">
                                                <td>Total Amount</td>
                                                <td class="amountRight">&#x20b9 <?php echo $this->cart->total(); ?></td>
                                            </tr>
                                            <tr class="amountDesc">
                                                <td>Convenience Charges</td>
                                                <td class="amountRight">&#x20b9 <?php  echo $service_charges['delivery_charge'];?></td>
                                            </tr>
                                            <tr class="amountDesc">
                                                <?php 
                                                $tax = $service_charges['tax_charge'];
                                                $original = $this->cart->total();
                                                $tax_value = ($original/100) * $tax;
                                                $total = $this->cart->total() + $service_charges['delivery_charge'] + $tax_value
                                                ?>
                                                <td>Service Tax(<?php  echo $service_charges['tax_charge'];?>%)</td>
                                                <td class="amountRight">&#x20b9 <?php  echo $tax_value;?></td>
                                            </tr>
                                            <tr class="amountDesc totalAmount">
                                                <td>Payable Amount</td>                                                
                                                <td class="amountRight">&#x20b9 <?php echo $total;  ?></td>
                                                <input type="hidden" name="total" value="<?php echo $total; ?>">
                                                <input type="hidden" name="service_tax" value="<?php echo $tax_value; ?>">
                                                <input type="hidden" name="charges" value="<?php echo $service_charges['delivery_charge']; ?>">
                                            </tr>
                                        </table>
                                        <?php } ?>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
            