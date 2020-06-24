

<section class="contusAll topSpace boxs">
<form method="post" action="<?php echo base_url('Web/doAddContactUs') ?>" id="address">
    <div id="error_msg"></div>
<div class="container">
<div class="contacIn">
<h2 class="headingSize">Contact Us</h2>
<div class="contactForm">
<div class="form-group">
<label class="labelForm">Full Name</label>
<input type="text" class="form-control inputForm" placeholder="Full Name" name="name" id="name">
</div>

<div class="form-group">
<label class="labelForm">Email</label>
<input type="email" class="form-control inputForm" placeholder="Email" name="email" id="email">
</div>
<div class="form-group">
<label class="labelForm">Phone Number</label>
<input type="number" class="form-control inputForm" placeholder="Phone Number" name="phone" id="phone">
</div>
<div class="form-group">
<label class="labelForm">Message</label>
<textarea class="form-control" placeholder="message" rows="8" name="text" id="text"></textarea>
</div>

<div class="contactBtn">
<button type="submit" class="formBtn" >Send</button>
</div>
</div>
</div>
</div>
</form>
</section>


</html>