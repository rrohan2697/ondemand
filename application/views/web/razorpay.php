<html>
<head>
    <meta name="viewport" content="width-device-width">
    </head>
    <body>
    <form action="<?php echo base_url('Web_booking/doPayment') ?>" method="POST"> // Replace this with your website's success callback URL
<script
    src="https://checkout.razorpay.com/v1/checkout.js"
    data-key="rzp_test_cCZzCEVjRLXiGh" // Enter the Key ID generated from the Dashboard
    data-amount="50000" // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise
    data-currency="INR"
    //This is a sample Order ID. Pass the `id` obtained in the response of the previous step.
    data-buttontext="Pay with Razorpay"
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
    
    </body>
    
    
</html>