<!-- Banner Start -->

<div class="bannerBox categoryBanner topSpace boxs">
        <div class="bannerSlide boxs">
            <div class="bannerSlider boxs">
            <?php if(!empty($categorys_banners)) { $i = 0; foreach($categorys_banners as $categorys_banner) { ?>
                <div class="bannerInner">
                    <div class="bannerOverlay boxs"></div>
                    <img src="<?php if(!empty($categorys_banner['image_url'])){  echo base_url('uploads/category-banner-images/'.$categorys_banner['image_url']); } ?>" alt="image" class="img-fluid">
                </div>
            <?php $i++;} } ?>
            </div>
        </div>
        <div class="breadcrum boxs">
            <div class="container">
                <div class="breadcrumPath">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Home</a></li>
                          <li class="breadcrumb-item"><a href="">Category</a></li>
                          <li class="breadcrumb-item active" aria-current="page"><a><?php echo $category['category_name']; ?></a></li>
                        </ol>
                      </nav>
                </div>
            </div>
        </div>
        <div class="categoryTop boxs">
            <div class="container">
                <h2 class="mainHeading"><?php echo $category['category_banner_name']; ?></h2>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Categoty Details Start -->

    <div class="categoryBoxs boxs">
        <div class="categoryList boxs">
            <div class="container">
                <div class="categoryInner categoryInnernew">
                    <div class="productlistSlider commonSlides commonSlides2">
                        
                    <?php if(!empty($sub_categorys)) { $i = 0;$url=''; foreach($sub_categorys as $sub_category) { if($i == 0) {$url = base_url('Web_category/doCategoryFilter/'.$sub_category['id']);} ?>
                        
                        <div class="listsProduct"><p class="clickhere <?php if($i === 0){ echo "active"; }?>" data-type="<?php echo $sub_category['subcategory_url'];?>">
                            <a href="<?php echo base_url('Web_category/doCategoryFilter/'.$sub_category['id']) ?>" id="categoryFilter"><?php if(!empty($sub_category['subcategory_name'])) { echo $sub_category['subcategory_name']; } ?></a>
                            
                            </p></div>
                        
                    <?php $i++; } } else{  ?>
                    <div class="listsProduct"><p class="clickhere <?php if($i === 0){ echo "active"; }?>" >
                            
                            <p style="margin: 0 auto;">No services Found.
                            </p></div>
                    
                    <?php } ?>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="categoryListBox boxs">
            <div class="categoriesInner all allswitch">
                <div class="listproductInner sectionPadding boxs">
                    <div class="container">
                        <div class="producttabsList">
                            <?php if(!empty($url)){  ?>
                            <div class="row" id="category_wrapper" data-url="<?php echo $url; ?>">
                             </div>
                            <?php } ?>
                        </div>
                        
                        <?php if(!empty($sub_categorys)){ ?>
                        <div class="bookNowbox">
                            <?php if(!empty($this->cart->contents())) {  ?>
                            <a href="<?php echo base_url('web-category/cart-show/'); ?>" class="bookNow">Book Now</a>
                            <?php } else {  ?>
                            <a href="javascript:;" class="bookNow emptybook">Book Now</a>
                            <?php } }?>
                        </div>
                    </div>
                </div>
                
                
            </div>
        </div>

          
           

    <!-- Categoty Details End -->
