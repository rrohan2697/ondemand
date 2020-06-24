<!--        paymentAll code start-->

    <section class="paymentAll topSpace  boxs">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="paymentOption">
                        <div class="paymentIn">
                            <div class="paymnetHead">
                                <h3 class="headingSize">Payment Options</h3>
                            </div>
                            <div class="promoShow">
                                <div class="promoCode">
                                    <div class="promoIn">
                                        <p class="subHeading">Promode Applied</p>
                                        <p class="savedPara">You have saved 30% on your Booking</p>
                                    </div>
                                    <div class="remomeAll">
                                        <a href="javascript:void(0)" class="removeCs removePromo">Remove</a>
                                    </div>
                                </div>
                            </div>
                            <div class="AddPromo">
                                <a href="javascript:void(0)" class="plus"><span><i class="fa fa-plus" aria-hidden="true"></i></span>Add Promo Code</a>

                                <div class="referPromo">
                                    <div class="form-group">
                                        <label class="labelForm">Enter Code</label>
                                        <input type="text" placeholder="enter code" class="form-control inputForm">
                                    </div>
                                    <div class="referBtn">
                                        <button type="button" class="formBtn">Apply</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="radioAll">
                        <?php foreach($getCardDetails as $card){  ?>
                        <div class="radioInner">
                            <div class="radio">
                                <input id="radio-1" name="radio" type="radio">
                                <label for="radio-1" class="radio-label"><span class="bankDetail">
                                        <ul>
                                            <li><?php echo substr($card['card_no'], 0, 2) . '************' . substr($card['card_no'], -2); ?></li>
                                            <li><?php echo $card['name']; ?></li>
                                            <li>Expires On <?php echo $card['expiry']; ?></li>
                                        </ul>
                                    </span></label>
                                <form>
                                <div class="enterCvv">
                                    <input type="number" placeholder="Enter Cvv" class="form-control inputForm">
                                    <div class="cvvBtn">
                                        <button type="button" class="formBtn">Continue</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                            <div class="remomeAll">
                                <a href="javascript:void(0)" class="removeCs">Remove</a>
                            </div>
                        </div>
                       <?php } ?>
                    </div>
                    <div class="radioAll radioAll2">
                        <div class="radioInner">
                            <div class="radio">
                                <input id="radio-4" name="radio" type="radio">
                                <label for="radio-4" class="radio-label">
                                    <span class="creditAll">
                                        <p>Credit Card</p>



                                    </span></label>
                                                                        <div class="creditInput creditInputnew">
                                            <form action="<?php echo base_url('Web_booking/doPayment') ?>" method="post" id="payment">
                                                <div class="form-group">
                                                    <input type="number" placeholder="8564   2568   2156   2546" class="inputForm" name="number" id="number">
                                                </div>
                                                <div class="form-group">
                                                    <input type="text" placeholder="Card holder Name" class="inputForm" name="name" id="name">
                                                </div>
                                                <div class="form-group expiry">
                                                    <input type="text" placeholder="Expiry Date" class="inputForm" name="expiry" id="expiry">
                                                </div>
                                                <div class="form-group cvv">
                                                    <input type="number" placeholder="CVV" class="inputForm" name="cvv" id="cvv">
                                                </div>
                                                <div class="form-group payBtn22">
                                                    <button type="submit" class="formBtn">Pay <span>Rs 498</span></button>
                                                </div>
                                            </form>
                                        </div>

                            </div>
                        </div>
                        
                        <div class="radioInner">
                            <div class="radio">
                                <input id="radio-6" name="radio" type="radio">
                                <label for="radio-6" class="radio-label">
                                    <span class="creditAll">
                                        <p>Cash On Service</p>

                                    </span>

                                </label>
                                <div class="creditInput">
                                    <form action="/action_page.php" method="get">
                                        
                                        <div class="form-group payBtn22">
<!--                                            <button type="submit"  class="formBtn">Pay <span>Rs 498 at Location</span></button>-->
                                            <a class="formBtn" href="">Pay <span>Rs 498 at Location</span></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
<!--
                        <div class="radioInner">
                            <div class="radio">
                                <input id="radio-7" name="radio" type="radio">
                                <label for="radio-7" class="radio-label"><span class="creditAll">
                                        <p>Cash on Service</p>

                                    </span></label>
                            </div>
                        </div>
-->
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="priceDetail">
                        <h3 class="headingSize">Price Details</h3>
                        <div class="detailAlll">
                            <ul>
                                <li>Total Amount</li>
                                <li>Rs 348</li>
                            </ul>
                            <ul>
                                <li>Convenience Charges</li>
                                <li>Rs 99</li>
                            </ul>
                            <ul>
                                <li>Service Tax</li>
                                <li>Rs 100</li>
                            </ul>
                            <ul>
                                <li>Promo code</li>
                                <li class="promoCol">- Rs 150</li>
                            </ul>
                            <ul>
                                <li>Payable Amount</li>
                                <li>Rs 498</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!--        payment code end-->