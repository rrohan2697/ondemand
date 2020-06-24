 <section class="searchAll boxs">

        <div class="bannerSearch bannerSearchnew2 boxs">
            <div class="container">
                <div class="searchBox boxs">
                    <h2 class="subHeading">Get Instant access to reliable and Affordable services</h2>
                    <div class="searchForm">
                        <form method="post" action="<?php echo base_url('Web_category/search') ?>">
                        <div class="searchMain">
                            <div class="form-group formSearch formSearchsearch">
                                <input type="text" class="form-control" id="search" name="search" placeholder="Search for a service" autocomplete="off">
                                <span><i class="fas fa-search"></i></span>
                                <button type="submit">Search</button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
           <div class="categoriesInner all allswitch">
                <div class="categoriesHeading boxs">
                    <div class="container">
                        <div class="categoryHeading">
                        </div>
                    </div>
                </div>
                <div class="listproductInner sectionPadding boxs">
                    <div class="container">
                        <div class="producttabsList">
                            <div class="row">
                                <?php
                                if(!empty($search)){
                                foreach($search as $ser){
                                if(!empty($this->cart->contents())){ foreach($this->cart->contents() as $cart) {  if($cart['id'] == $ser['id']){
 $added = "true";
 $qty = $cart['qty'];
}  }  }
                                ?>
                                <div class="col-sm-6 ">
                                    <div class="categoryProduct">
                                        <div class="productDescription">
                                            <div class="categoryLeft">
                                                <div class="productImage">
                                                    <img src="<?php echo base_url('uploads/service-icon/'.$ser['icon_url']) ?>" alt="Product Image" class="img-fluid">
                                                </div>
                                                <div class="productDetails">
                                                    <p class="headingSize prodDescription"><?php echo $ser['service_title'] ?></p>
                                                    <p class="headingSize prodPrice">Rs <?php echo $ser['price'] ?></p>
                                                    <a href="<?php echo base_url('Web_category/serviceDetail/'.$ser['id']) ?>"><p class="subHeading viewDetails">View details</p></a>
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
                                                <a href="<?php echo base_url('Web_booking/addToCart/'.$ser['id'].'/'.$ser['service_title'].'/'.$ser['price'].'/'.$ser['icon_url']) ?>" class="productAdd productAddToCart">Add</a>
                                                <button type="button" class="plus_btn">+</button>
                                                <?php } ?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               <?php } } else{ ?>
                              <p style="margin: 0 auto;">No records matching to your search.</p>
                               <?php } ?>
                                
                            </div>
                        </div>
                        
                        <?php if(!empty($search)){ ?>
                        <div class="bookNowbox">
                            <?php if(!empty($this->cart->contents())) {  ?>
                            <a href="<?php echo base_url('web-category/cart-show/'); ?>" class="bookNow">Book Now</a>
                            <?php } else {  ?>
                            <a href="javascript:;" class="bookNow emptybook">Book Now</a>
                            <?php } } ?>
                        </div>
                    </div>
                </div>
            </div>
    </section>