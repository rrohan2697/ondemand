<?php if(!empty($images)) { foreach($images as $image){ ?>
    <image src="<?php if(!empty($image['image_url'])) {echo base_url('uploads/category-banner-images/'.$image['image_url']);} ?>" alt="Image Not Found" class="img-thumbnail" style="width:160px; height:100px;">
    <span><a href="<?php echo base_url('category/banner-images-delete/'.$image['id']);?>" class="delete"><i class="fa fa-trash-o"></i></span>
<?php } } ?>