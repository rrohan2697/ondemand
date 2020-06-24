   
    <!-- Banner Start -->
    <div class="bannerBox topSpace boxs">
        <div class="bannerSlide boxs">
            <div class="bannerSlider boxs">
                <?php if(!empty($banners)) { $i = 0; foreach($banners as $banner){ ?>
                <div class="bannerInner">
                    <div class="bannerOverlay boxs"></div>
                    <img src="<?php if(!empty($banner['image_url'])){ echo base_url('./uploads/main-banner-images/'.$banner['image_url']); } ?>" alt="image" class="img-fluid">
                </div>
                <?php $i++; }  } ?>
            </div>
        </div>
        
        <div class="bannerSearch boxs">
            <div class="container">
                <div class="searchBox boxs">
                    <h2 class="subHeading">Get instant access to reliable and affordable services</h2>
                    <div class="searchForm">
                        <!--<div class="sectctCity"> -->
                        <!--    <div class="form-group">-->
                        <!--        <select class="citySelect" name="city">-->
                        <!--            <option>Select City</option>-->
                        <!--            <option>Delhi</option>-->
                        <!--            <option>Noida</option>-->
                        <!--            <option>G. Noida</option>-->
                        <!--            <option>Okhla</option>-->
                        <!--        </select>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <form method="post" action="<?php echo base_url('Web_category/search') ?>">
                        <div class="searchMain">
                            <div class="form-group formSearch">

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
    </div>
    <!-- Banner End -->

    <!-- Services Offered Start -->
    <div class="serviceOffered sectionPadding boxs">
        <div class="container">
            <div class="topHeadings boxs">
                <h2 class="headingSize">Services Offered</h2>
            </div>
            <div class="servicesInner boxs">
                <div class="servicesSlider homeSliders commonSlides boxs">
                    <?php if(!empty($categorys)) { $i=0; foreach($categorys as $category){ ?>
                    <a href="<?php echo base_url('web-category/show/'.$category['category_url']); ?>">
                        <div class="serviceSlide">
                            <div class="serviceImages"><img src="<?php if(!empty($category['icon_url'])) { echo base_url('./uploads/category-icon/'.$category['icon_url']); } ?>" alt="image" class="img-fluid"></div>
                            <span><?php if(!empty($category['category_name'])) { echo $category['category_name']; }?></span>
                        </div>
                    </a>
                    <?php $i++; } } ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Services Offered End -->

    <!-- Recommended for you start-->
   <div class="recommendedForyou boxs">
        <div class="container">
            <div class="recommendedBox sectionPadding boxs">
                <div class="topHeadings boxs">
                    <h2 class="headingSize">Recommended for you</h2>
                </div>
                <div class="recommendedFor boxs">
                    <div class="recommendedSlider homeSliders commonSlides">
                        <?php foreach($getRandomServices as $rand) {  ?>
                        <a href="<?php echo base_url('Web_category/serviceDetail/'.$rand['id']) ?>">
                        <div class="recommendedSlide">
                            <div class="recommendedImg">
                                <img src="<?php echo base_url('uploads/service-icon/'.$rand['icon_url']) ?>" alt="image" class="img-fluid">
                            </div>
                            <div class="recommendedDetails boxs">
                                <p class="headingSize"><?php echo $rand['service_title'] ?></p>
                                <p class="smallSize">Experienced & Professionals Team </p>
                                <span class="flatOff">&#x20b9 <?php echo $rand['price'] ?></span>
                            </div>
                        </div></a>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="getApp boxs">
                <div class="getappInner boxs">
                    <div class="row">
                        <div class="col-sm-4">
                            <div class="getappLeft">
                                <img src="<?php echo base_url('public/web/') ?>img/mockup.svg" alt="image" class="img-fluid">
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="getappRight">
                                <div class="getappTpop boxs">
                                    <h2 class="heading">Get the On Demand Service App</h2>
                                    <h3 class="headingSize">Get Instant access to reliable and Affordable services </h3>
                                    <p class="headingSize">We’ll send you a link, open it on your phone to download the app</p>
                                </div>
                                <div class="getappLink boxs">
                                    <form method="post" action="<?php echo base_url('Web/sendSms') ?>" id="address">
                                        <div id="error_msg"></div>
                                        <div class="form-group getLink numberOptn">
                                            <input id="phone2" type="tel" class="form-control"  name="phone2"  required placeholder="Enter Phone number" />
                                            
                                            <!--<a href="<?php echo base_url('Web/otp') ?>" class="btn btn-primary" id="send-otp">Get App Link-->
                                                <button type="submit" id="send-otp">Get App Link</button>
                                                <!--</a>-->
                                        </div>
                                        <!--<div id="recaptcha-container"></div>-->
                                    </form>
                                    <div class="linksApp boxs"><div class="linksSpace"><p class="smallSize"><span>Or</span></p></div></div>
                                    <form method="post" action="<?php echo base_url('Web/sendEmail') ?>" id="address">
                                        
                                        <div class="form-group getLink">
                                            <input type="email" class="form-control" placeholder="Enter Your Email ID" id="email" name="email">
                                            <button type="submit">Get App Link</button>
                                        </div>
                                        <div id="error_msg"></div>
                                    </form>
                                </div>
                                <div class="storeLink boxs">
                                    <a href="javascript:void(0)"><img src="<?php echo base_url('public/web/') ?>img/appstore.svg" class="img-fluid" alt="image"></a>
                                    <a href="javascript:void(0)"><img src="<?php echo base_url('public/web/') ?>img/googleplay.svg" class="img-fluid" alt="image"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Recommended for you end-->


