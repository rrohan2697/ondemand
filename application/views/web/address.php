    <!--        paymentAll code start-->

    <section class="paymentAll topSpace  boxs">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="paymentOption">
                        <div class="paymentIn">
                            <div class="paymnetHead">
                                <h3 class="headingSize">Booking Address</h3>
                            </div>
                            <!--
                            <div class="promoCode">
                                <div class="promoIn">
                                    <p class="subHeading">Promode Applied</p>
                                    <p class="savedPara">You have saved 30% on your Booking</p>
                                </div>
                                <div class="remomeAll">
                                    <a href="javascript:void(0)" class="removeCs">Remove</a>
                                </div>
                            </div>
-->
                        </div>
                    </div>
                    <div class="radioAll radioAllnew">
                        <?php if(!empty($address)){ 
                        foreach($address as $add) {  
                        ?>
                        <div class="radioInner">
                            <div class="radio">
                                <!--<input id="radio-1" name="radio" type="radio" >-->
                                <label for="radio-1" class="radio-label"><span class="bankDetail bankDetail2">
                                        <ul>
                                            <li><?php echo $add['user_name'] ?><span class="workAll"><?php echo $add['type'] ?></span></li>
                                            <li><?php echo $add['address_line_1'] ?>, <?php echo $add['address_line_2'] ?></li>
                                        </ul>
                                    </span></label>
                            </div>
                            <div class="remomeAll">
                                <a href="<?php echo base_url('Web_booking/removeAddress/'.$add['address_id']) ?>" class="removeCs removeAddress">Remove</a>
                                <a href="#" data-toggle="modal" class="removeCs" data-target="#editModal<?php echo $add['address_id']; ?>" data-url="<?php echo base_url('Web_booking/addressWrapper/'. $add['address_id']);?>">Edit</a>
                               
                            </div>
                        </div>
                        <div class="modal  bookingModal fade" id="editModal<?php echo $add['address_id']; ?>" role="dialog">
                    		<div class="modal-dialog">
                    			<div class="modal-content" id="address_wrapper">
                                    				<button type="button" class="close closeAll" data-dismiss="modal"><img src="http://hammerandspanner.in/public/web/img/cross.svg" alt="Close_Button" class="img-fluid"></button>
				<form method="post" action="<?php echo base_url('Web_booking/doEditAddress/'.$add['address_id']) ?>" id="address">
				    <div id="error_msg"></div> 
					<div class="modal-body boxs">
						<div class="creditInput creditInputnew" style="display: block;">
							<div class="form-group">
								<label class="labelForm">Name</label>
								<input type="text" placeholder="Name" class="inputForm" value="<?php echo $add['user_name'] ?>" name="edit_name" id="edit_name">
							</div>
							<div class="form-group ">
								<label class="labelForm">Pincode</label>
								<input type="text" placeholder="Pincode" class="inputForm" value="<?php echo $add['zipcode'] ?>" name="edit_pincode" id="edit_pincode">
							</div>
							<div class="form-group ">
								<label class="labelForm">City</label>
								<input type="text" placeholder="City" class="inputForm" value="<?php echo $add['city'] ?>" name="edit_city" id="edit_city">
							</div>
							<div class="form-group ">
								<label class="labelForm">Locality</label>
								<input type="text" placeholder="Locality" class="inputForm" value="<?php echo $add['state'] ?>" name="edit_locality" id="edit_locality">
							</div>
							<div class="form-group ">
								<label class="labelForm">Address Line 1</label>
								<input type="text" placeholder="Address Line 1" class="inputForm add1" value="<?php echo $add['address_line_1'] ?>" name="edit_add1" id="edit_add1">
							</div>
							<div class="form-group">
							    <label class="labelForm">Address Line 2</label>
								<input type="text" placeholder="Address Line 2" class="inputForm" value="<?php echo $add['address_line_2'] ?>" name="edit_add2" id="edit_add2">
							</div>
							
							<div class="saveAs">
                                        

                                        <select name="type" id="type" class ="dropChange">
                                        <?php if(!empty($add['type'])) { ?> 
                                        <option value="<?php echo $add['type'] ?>"><?php echo $add['type'] ?></option>
                                        <?php } ?>
                                        <option value="Home">Home</option>
                                        <option value="Work">Work</option>
                                        <option value="Other">Others</option>
                                        </select>

                                    </div>

							<div class="addressBtn">
								<button type="submit" class="formBtn">Save Address</button>
								<button type="button" class="formBtn"  data-dismiss="modal">Cancel</button>
							</div>
						</div>
					</div>
				</form>
				
					
	
                    			</div>
                    		</div>
                    	</div>
                       <?php } }else{  ?>
                        <p class="text-center">No address Found!</p>
                        <?php } ?>
                        
                    </div>
                    <div class="radioAll radioAll2">
                        <div class="radioInner">
                            <div class="radio radioadd">
                                <input id="radio-4" name="radio" type="radio" >
                                <label for="radio-4" class="radio-label"><span class="creditAll creditAll2">
                                        <p>Add New Address</p>
                                    </span></label>
                                <div class="creditInput creditInput2">
<!--
                                    <div class="locationBtn">
                                        <a href="javascript:void(0)"><span><img src="img/location.svg" class="img-fluid" alt="location"></span>Current Location</a>
                                    </div>
-->
                                    <form method="post" action="<?php echo base_url('Web_booking/doAddAddress') ?>" id="address">
                                       
                                    <div class="form-group">
                                        <div id="error_msg"></div> 
                                        <label class="labelForm">Name</label>
                                        <input type="text" placeholder="name" class="inputForm" name="name" id="name">
                                    </div>
                                    <div class="form-group floatRight">
                                        <label class="labelForm">Pincode</label>
                                        <input type="number" placeholder="Pincode" class="inputForm" name="pincode" id="pincode">
                                    </div>
                                    <div class="form-group">
                                        <input type="text" placeholder="City" class="inputForm" name="city" id="city">
                                    </div>
                                    <div class="form-group floatRight">
                                        <input type="text" placeholder="Locality" class="inputForm" name="locality" id="locality">
                                    </div>
                                    <div class="form-group frAl">
                                        <input type="text" placeholder="Address Line 1" class="inputForm add1" name="add1" id="add1">
                                    </div>
                                        <div class="form-group frAl">
                                        <input type="text" placeholder="Address Line 2" class="inputForm" name="add2" id="add2">
                                    </div>
                                    <div class="saveAs">
                                        <label class="labelForm">Save as</label>

                                        <select name="type" id="type" class ="dropChange">
                                        <option value="Home">Home</option>
                                        <option value="Work">Work</option>
                                        <option value="Other">Others</option>
                                        </select>
<!--
                                        <button type="button" class="savAct">Home</button>
                                         <button type="button">Work</button>
                                         <button type="button">Others</button>
-->
                                    </div>
                                    
                                    <div class="addressBtn">
                                        <button type="submit" class="formBtn">Save Address</button>
                                         <button type="button" class="formBtn formBtnnew">Cancel</button>
                                    </div>
                                    </form>    
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="priceDetail">
                        <h3 class="headingSize">Price Details</h3>
                        <div class="detailAlll">
                            <ul>
                                <li>Total Amount</li>
                                <li>&#x20b9 <?php echo $this->cart->total(); ?></li>
                            </ul>
                            <ul>
                                <li>Convenience Charges</li>
                                <li>&#x20b9 <?php  echo $service_charges['delivery_charge'];?></li>
                            </ul>
                            <ul>
                                <?php 
                                  $tax = $service_charges['tax_charge'];
                                  $original = $this->cart->total();
                                  $tax_value = ($original/100) * $tax;
                                  $total = $this->cart->total() + $service_charges['delivery_charge'] + $tax_value
                                ?>
                                <li>Service Tax(<?php  echo $service_charges['tax_charge'];?>%)</li>
                                
                                <li>&#x20b9 <?php  echo $tax_value;?></li>
                            </ul>
                            
                            <ul>
                                <li>Payable Amount</li>
                                <li>&#x20b9 <?php  echo $total;?></li>
                            </ul>
                        </div>
                    </div><br>
                    <div class="form-group payBtn22">
                                            <a href="<?php echo base_url('web-category/cart-show/') ?>"><button type="submit" class="formBtn">Proceed For checkout </span></button></a>
                                        </div>
                </div>
                
                
            </div>
        </div>

    </section>