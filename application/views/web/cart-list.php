<!-- Categoty Details Start -->

<form method="post" action="<?php if(!empty($id)){ echo base_url('Web_booking/booking/'.$id); } else{ echo base_url('Web_booking/booking/'); }  ?>" id="booking">

<div class="categoryListBox MycartBox topSpace boxs">
        <div class="categoriesInner">
            <div class="producttabsLists sectionPadding boxs">
                <?php if(empty($id)){ $id = "";}?>
                <div class="container" id="conent_cart_wrapper" data-url="<?php echo base_url('Web_booking/cart_wrapper/'.$id);?>">
                 </div>
            </div>
        </div>
    </div>
    
</form>
    <!-- Categoty Details End -->

<!-- Start of Popup Modal of time slot-->
    <div class="modal  otpPassword timeSlot fade" id="timeSlotModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close closeAll" data-dismiss="modal"><img src="<?php echo base_url('public/web/') ?>img/cross.svg" alt="Close_Button" class="img-fluid"></button>
                <form>
                    <div class="modal-body boxs">
                        <div class="profileHead profileHead2 boxs">
                            <h3 class="headingSize">Select Available Time Slot</h3>
                        </div>
                        <div class="otpInner">
                            <div class="otpInput boxs">
                                <div class="timeSlotAll">
                                    <label class="labelForm">Time Slot</label>
                                    <div class="timeAll">
                                        <?php foreach($slots as $slot) {  ?>
                                        <?php
                                        
                                        if($slot['start_time'] <= date("H:i:s")) { 
                                        
                                        ?>
                                        
                                        <button type="button" class="btn btn-light  disable_btn" disabled><?php echo
                                        date('h:ia', strtotime($slot['start_time'])); 
                                         ?></button>
                                         
                                         <?} else {?>
                                         
                                         <button type="button" class="btnBack"><?php echo
                                        date('h:ia', strtotime($slot['start_time'])); 
                                         ?></button>
                                         
                                         <?php } ?>
                                         
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="otpBtn">
                                    <button type="button" class="formBtn clickBtn2">Continue</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Popup Modal of time slot-->

<div class="modal  bookingModal calenderModal fade" id="dateModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--                    <button type="button" class="close" data-dismiss="modal"><img src="img/close.png" alt="Close_Button" class="img-responsive"></button>-->
                <form>
                    <div class="modal-body boxs">
                        <form>
                        <div class="calenderAll">
                            <div id="calendari"></div>
                        </div>
                            <div class="CalBtn">
                                <button type="button" data-dismiss="modal">Cancel</button>
                                 <button type="button"> Ok</button>
                            </div>
                        </form>
                    </div>
                </form>
            </div>
        </div>
    </div>