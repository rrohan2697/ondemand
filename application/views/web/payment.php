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
                            
                            
                        </div>
                    </div>
                    
                    <div class="radioAll radioAll2">
                        <div class="radioInner">
                            <div class="radio">
                                <input id="radio-6" name="radio" type="radio">
                                <label for="radio-6" class="radio-label">
                                    <span class="creditAll">
                                        <p>Credit / Debit Card</p>

                                    </span>

                                </label>
                                <div class="creditInput">
                                    <form action="<?php echo base_url('Web_booking/doPayment/'.$type='Online') ?>" method="POST">
                                    <script
                                        src="https://checkout.razorpay.com/v1/checkout.js"
                                        data-key="rzp_test_cCZzCEVjRLXiGh" // Enter the Key ID generated from the Dashboard
                                        data-amount= <?php echo $total *100; ?> // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
                                        data-currency="INR"
                                        //This is a sample Order ID. Pass the `id` obtained in the response of the previous step.
                                        data-buttontext="Continue to Pay"
                                        data-name="Ondemand"
                                        data-description="Test transaction"
                                        data-image="https://example.com/your_logo.jpg"
                                        data-prefill.name=""
                                        data-prefill.email=""
                                        data-prefill.contact=""
                                        data-theme.color="#F37254"
                                    ></script>
                                    <input type="hidden" custom="Hidden Element" name="hidden">
                                    </form>
                                </div>
                            </div>
                        </div>
                        
                        <div class="radioInner">
                            <div class="radio">
                                <input id="radio-5" name="radio" type="radio">
                                <label for="radio-5" class="radio-label">
                                    <span class="creditAll">
                                        <p>Cash on Delivery</p>

                                    </span>

                                </label>
                                <div class="creditInput">
                                    <form action="<?php echo base_url('Web_booking/doPayment/'.$type='Cod') ?>" method="POST">
                                        
                                        <div class="form-group payBtn22">
                                            <button type="submit" class="formBtn">Pay <span>&#x20b9 <?php echo $total;  ?></span></button>
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
<!--
                            <ul>
                                <li>Promo code</li>
                                <li class="promoCol">- Rs 150</li>
                            </ul>
-->
                            <ul>
                                <li>Payable Amount</li>
                                <li>&#x20b9 <?php echo $total;  ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <!--        payment code end-->