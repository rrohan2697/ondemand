				<button type="button" class="close closeAll" data-dismiss="modal"><img src="http://hammerandspanner.in/public/web/img/cross.svg" alt="Close_Button" class="img-fluid"></button>
				<form method="post" action="<?php echo base_url('Web_booking/doEditAddress/'.$address['address_id']) ?>" id="address">
				    <div id="error_msg"></div> 
					<div class="modal-body boxs">
						<div class="creditInput creditInputnew" style="display: block;">
							<div class="form-group">
								<label class="labelForm">Name</label>
								<input type="text" placeholder="name" class="inputForm" value="<?php echo $address['user_name'] ?>" name="edit_name" id="edit_name">
							</div>
							<div class="form-group ">
								<label class="labelForm">Pincode</label>
								<input type="text" placeholder="name" class="inputForm" value="<?php echo $address['zipcode'] ?>" name="edit_pincode" id="edit_pincode">
							</div>
							<div class="form-group ">
								<label class="labelForm">City</label>
								<input type="text" placeholder="name" class="inputForm" value="<?php echo $address['city'] ?>" name="edit_city" id="edit_city">
							</div>
							<div class="form-group ">
								<label class="labelForm">Locality</label>
								<input type="text" placeholder="name" class="inputForm" value="<?php echo $address['state'] ?>" name="edit_locality" id="edit_locality">
							</div>
							<div class="form-group ">
								<label class="labelForm">Address Line 1</label>
								<input type="text" placeholder="name" class="inputForm add1" value="<?php echo $address['address_line_1'] ?>" name="edit_add1" id="edit_add1">
							</div>
							<div class="form-group">
							    <label class="labelForm">Address Line 2</label>
								<input type="text" placeholder="name" class="inputForm" value="<?php echo $address['address_line_2'] ?>" name="edit_add2" id="edit_add2">
							</div>
							
							<div class="saveAs">
                                        

                                        <select name="type" id="type" class ="dropChange">
                                        <?php if(!empty($address['type'])) { ?> 
                                        <option value="<?php echo $address['type'] ?>"><?php echo $address['type'] ?></option>
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
				
					
	