<?php if(!empty($getServices)){ 
foreach($getServices as $service){
$added = '';  $qty = '';  
if(!empty($this->cart->contents())){ foreach($this->cart->contents() as $cart) {  if($cart['id'] == $service['id']){
 $added = "true"; 
 $qty = $cart['qty'];
}  }  }
?>
                                <div class="col-sm-6 ">
                                    <div class="categoryProduct">
                                        <div class="productDescription">
                                            <div class="categoryLeft">
                                                <div class="productImage">
                                                    <img src="<?php echo base_url('uploads/service-icon/'.$service['icon_url'])?>" alt="Product Image" class="img-fluid">
                                                </div>
                                                <div class="productDetails">
                                                    <p class="headingSize prodDescription"><?php echo $service['service_title'] ?></p>
                                                    <p class="headingSize prodPrice">&#x20b9 <?php echo $service['price'] ?></p>
                                                    <a href="<?php echo base_url('Web_category/serviceDetail/'.$service['id']) ?>"><p class="subHeading viewDetails">View details</p></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="addProduct">
                                            <div class="vaulebox">
                                                <button type="button" class="minus_btn">-</button>
                                                <input type="text" value="1" class="qty">
                                                <?php if(!empty($added)) {  ?>
                                                <a href="javascript:;" class="productAdd"><?php echo $qty; ?> Added</a>
                                                <?php }else{  ?>
                                                <a href="<?php echo base_url('Web_booking/addToCart/'.$service['id'].'/'.$service['service_title'].'/'.$service['price'].'/'.$service['icon_url']) ?>" class="productAdd productAddToCart">Add</a>
                                                <button type="button" class="plus_btn">+</button>
                                                <?php } ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
<?php } } else{ ?>
<p style="margin: 0 auto;">No services Found.</p>
<?php } ?>