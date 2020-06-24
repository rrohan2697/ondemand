
<section class="price_dscp topSpace boxs ">
        <div class="container">
            
            <div class="price_box align-items-center">
                <div class="row">
                    
                    <form  id="address" class ="formCenter" method="post" action="<?php echo base_url('web-users/do_reset_passowrd/'.$user_id);?>">
                    <div class="modal-body boxs">
                        <div class="profileHead profileHead2 boxs">
                            <h3 class="headingSize">Reset Password</h3>
                        </div>
                        <div class="otpInner">
                            <div class="otpInput otpInputchan boxs">
                                <div class="form-group">
                                    <label class="labelForm">New Password</label>
                                    <input name="new_password" id="new_password" type="password" class="form-control inputForm new_password" placeholder="New Password">
                                </div>
                                <div class="form-group">
                                    <label class="labelForm">Confirm New Password</label>
                                    <input name="confirm_password" id="confirm_password" type="password" class="form-control inputForm confirm_password" placeholder="Confirm New Password">
                                </div>
                                <div class="otpBtn">
                                    <button type="submit" name="submit" class="formBtn forgetPass">Reset Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </section>


