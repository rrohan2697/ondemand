<style>
    *, *:before, *:after {

    }
</style>
<table  border="0" cellspacing="0" cellpadding="0" style="background: #fff; border: none;font-family: 'Roboto', sans-serif;">

    <tr>
        <td style="padding: 20px 20px 0px;">
            Hello <?php echo $user['user_name']; ?>
        </td>
        <td style="padding: 20px 20px 0px;">
    Your Order Placed On: <?php echo date('d-m-Y'); ?>
           
        </td>
    </tr>

    <tr>
        <td style="padding: 20px 20px 0px;">
            Your Order has been placed successfully and Order id: <?php echo $order['booking_id']; ?>
        </td>
        <td style="padding: 20px 20px 0px;">
            
        </td>
    </tr>

    <tr>
        <td style="padding: 20px 20px 0px;">
            Your Order Details
        </td>
    </tr>
    <?php
    foreach ($services as $service) {
        $total = 0;
        ?>
        <tr style="margin-left: 10px; display: block;">
            <td style="padding: 20px 20px 0px;  width: 15%;">
                <img src="<?php echo base_url('uploads/service-icon/' . $service['icon_url']); ?>" height="150px" width="100px"/>
            </td>
            <td>
                <table border="0" cellspacing="0" cellpadding="0" style="background: #fff; border: none;font-family: 'Roboto', sans-serif; display: block; margin-left: 80px;">
                    <tr><td style="padding: 5px 0;"><?php echo $service['service_title']; ?></td></tr>
                    <tr><td style="padding: 5px 0;">Qty: <?php echo $service['quantity']; ?></td></tr>
                    <tr><td style="padding: 5px 0;">Price: <?php echo $service['price']; ?></td></tr>
                    <?php $sub_total = $service['quantity'] * $service['price'];
                    $total += $sub_total; ?>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-top: 20px"></td>
        </tr>
        <tr>
            <td style="border: 1px solid #cccccc80;"></td>
            <td style="border: 1px solid #cccccc80;"></td>
        </tr>
        <?php
    }
    ?>

    <tr>
        <!-- <td></td> -->
        <td style="float: right; margin-right: 25px;">
            <table border="0" cellspacing="0" cellpadding="0" style="background: #fff; border: none;font-family: 'Roboto', sans-serif;">
                <tr><td style="padding: 5px 0; text-align: right;">Subtotal: </td></tr>
                <tr><td style="padding: 5px 0; text-align: right;">Convenience charge:</td></tr>
                <tr><td style="padding: 5px 0; text-align: right;">Service charge:</td></tr>
                <tr><td style="padding: 5px 0; text-align: right;">Total:</td></tr>
            </table>
        </td>
        <td style="margin-right: 50px; text-align: right;">
            <table border="0" cellspacing="0" cellpadding="0" style="background: #fff; border: none;font-family: 'Roboto', sans-serif;">
                <tr><td style="padding: 5px 0; text-align: left;">Rs. <?php echo round($order['total_amount']); ?></td></tr>
                <tr><td style="padding: 5px 0; text-align: left;">Rs. <?php echo round($order['convenience_charge']); ?></td></tr>
                <tr><td style="padding: 5px 0; text-align: left;">Rs. <?php echo $services_tax = round($order['service_tax']);?>
                <tr><td style="padding: 5px 0; text-align: left;">Rs. <?php 
                echo round($order['payable_amount']);
                        
                        ?></td></tr>
            </table>
        </td>
    </tr>
</table>