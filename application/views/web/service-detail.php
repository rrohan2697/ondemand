 <!--banner start-->
    <div class="bannerBox categoryBanner topSpace boxs">
        <div class="bannerSlide boxs">
            <div class="bannerSlider boxs">
                <?php foreach($serviceBanner as $banner){  ?>
                <div class="bannerInner">
                    <div class="bannerOverlay boxs"></div>
                    <img src="<?php echo base_url('uploads/service-banner-images/'.$banner['image_url']) ?>" alt="image" class="img-fluid">
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="breadcrum boxs">
            <div class="container">
                <div class="breadcrumPath">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('web-category/show/'.$service['category_url']); ?>"><?php echo $service['category_name']; ?></a></li>
                            <li class="breadcrumb-item"><a href="<?php echo base_url('web-category/show/'.$service['category_url']); ?>"><?php echo $service['subcategory_name']; ?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a><?php echo $service['service_title']; ?></a></li>

                        </ol>
                    </nav>
                </div>
            </div>
        </div>
<!--
        <div class="categoryTop boxs">
            <div class="container">
                <h2 class="mainHeading">Fan</h2>
            </div>
        </div>
-->
    </div>
    <!--banner end-->
    <!--fan description starts here-->
    <!--fan description ends here-->
     <div class="fan_descp">
        <div class="container">
            <div class="fandesc_head">
                <div class="fandescp_left">
                    <h3><?php echo $service['service_title']; ?>
                    <span class="dscp_price">&#x20b9 <?php echo $service['price']; ?></span></h3>
                </div>
                <div class="fandescp_ryt">
                    <div class="addProduct">
                                            <div class="vaulebox">
<!--
                                                <button type="button" class="minus_btn">-</button>
                                                <input type="text" value="1" class="qty">
-->
                                                <?php if(!empty($this->cart->contents())){ foreach($this->cart->contents() as $cart) {  if($cart['id'] == $service['id']){
 $added = "true"; 
 $qty = $cart['qty'];
}  }  } ?>

                                                <?php if(!empty($added)) {  ?>
                                                <a href="javascript:;" class="btn btn-primary btn-sm productAddToCart"><i class="fa fa-plus" aria-hidden="true"></i><?php echo $qty; ?> Added</a>
                                                <?php }else { ?>
                                                <a href="<?php echo base_url('Web_booking/addToCart/'.$service['id'].'/'.$service['service_title'].'/'.$service['price'].'/'.$service['icon_url']) ?>" class="btn btn-primary btn-sm productAddToCart"><i class="fa fa-plus" aria-hidden="true"></i> Add Service</a>
                                                <?php } ?>
                                                
<!--                                                <button type="button" class="plus_btn">+</button>-->
                                            </div>
                                        </div>
                                        <!--<span class="dscp_time"><img src="<?php echo base_url('public/web/') ?>img/clock-3.svg" class="img-fluid" alt="image">20 min</span>-->
                </div>
            </div>
            <ul class="fan_services" style="list-style-type:none;">
                <h3>The Service Includes :</h3>
                <li><?php echo $service['description']; ?></li>
                
            </ul>
            
        </div>         
     </div>
    <!--review section start-->

    <section class="review_head boxs">
        <div class="container">
            <div class="review_title">
                <div class="reviews">
                    <h3>Reviews (<?php echo $totalReview ?>)</h3>
                </div>
                <div class="rating">
                    <p>Average Rating</p> <span class="rat_num"><?php echo  round($averageRating['AVG(rating)']) ?>.0<i class="fas fa-star"></i></span>
                </div>
            </div>
        </div>
    </section>
    <!--revoiew box start here-->
    <section class="review_cont boxs">
        <div class="container">
            <div class="review_bgclr">
                <div class="row">
                    <?php foreach($getAllReviews as $review) {  ?>
                    <div class="col-md-6 rvw_box">
                        <div class="rvw_img">
                            <span class="clynt_img">
                                <?php if(!empty($review['profile_url'])) {  ?>
                                <img src="<?php echo base_url('uploads/users-profile/'.$review['profile_url']) ?>" class="img-fluid img-circle" alt="image">
                                <?php } else { ?>
                                <img src="<?php echo base_url('public/web/') ?>img/user.png" class="img-fluid" alt="image">
                                <?php } ?>
                            </span>
                            <div class="clnt_dtls">
                                <span class="clnt_nm"><?php echo $review['user_name'] ?></span>
                                
                            </div>
                        </div>
                        <div class="rvw_ryt">
                            <?php $min = explode(' ',$review['created_at']) ?>
                            <span class="rvw_date"><?php echo $min[0] ?></span>
                            <span class="client_rating">
                                <i class="fas fa-star"></i><?php echo $review['rating'] ?>
                            </span>
                        </div>
                        <div class="rvw_txt">
                            <p><?php echo $review['review'] ?></p>
                        </div>
                    </div>
                    <?php } ?>
                    
                </div>
            </div>
        </div>
    </section>
    <div class="bookNowbox">
                            <?php if(!empty($this->cart->contents())) {  ?>
                            <a href="<?php echo base_url('web-category/cart-show/'); ?>" class="bookNow">Book Now</a>
                            <?php } else {  ?>
                            <a href="javascript:;" class="bookNow emptybook">Book Now</a>
                            <?php } ?>
                        </div>
    <!--review box end-->
    <!--review section end-->
