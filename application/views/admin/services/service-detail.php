            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Service Detail</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Service  Detail</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <section class="box ">
                        <header class="panel_header">
                            <h2 class="title pull-left"></h2>
                            <a href="<?php echo base_url('services');?>" class="btn btn-primary pull-right">Back</a>
                        </header>
                        <div></div>

                        <div class="row">
                            <div class="assig_list boxs">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row cat">
                                                <div class="col-sm-4">
                                                    <div class="form-group">
                                                        <h5 class="font-size-14">Service Name:- </h5>    
                                                    </div>
                                                </div>
                                                <div class="col-sm-8">
                                                    <div class="form-group">
                                                       <h5 class="font-size-14"><?php if(!empty($servicesdata['service_title'])){ echo $servicesdata['service_title']; }?></h5>    
                                                   </div>

                                               </div>


                                           </div>
                                           <div class="row cat">
                                            <div class="col-sm-4">
                                                <div class="form-group">
                                                    <h5 class="font-size-14">Price (₹):- </h5>    
                                                </div>
                                            </div>
                                            <div class="col-sm-8">
                                                <div class="form-group">
                                                   <h5 class="font-size-14"><?php if(!empty($servicesdata['price'])){ echo '₹' . $servicesdata['price']; }?></h5>    
                                               </div>

                                           </div>


                                       </div>
                                       <div class="row cat">
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <h5 class="font-size-14">Time(minutes):- </h5>    
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                               <h5 class="font-size-14"><?php if(!empty($servicesdata['time'])){ echo $servicesdata['time'] .' minute'; }?></h5>    
                                           </div>

                                       </div>


                                   </div>

                                   <div class="row cat">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <h5 class="font-size-14">Recommended:- </h5>    
                                        </div>
                                    </div>
                                    <div class="col-sm-8">
                                        <div class="form-group">
                                           <h5 class="font-size-14"><?php if(empty($servicesdata['recommended'])){ 
                                            echo "No";
                                        }
                                        else{
                                            echo "Yes";
                                        } 
                                        ?> </h5>    
                                    </div>

                                </div>


                            </div>
                            <div class="row cat">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <h5 class="font-size-14">Description:- </h5>    
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                       <h5 class="font-size-14"><?php if(!empty($servicesdata['description'])){ echo $servicesdata['description']; }?> </h5>    
                                   </div>

                               </div>


                           </div>
                           <div class="row cat">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5 class="font-size-14">Service Ican:- </h5>    
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                   <h5 class="font-size-14"><?php if(!empty($servicesdata['icon_url'])) { ?>
                                    <image src="<?php if(!empty($servicesdata['icon_url'])) {echo base_url('uploads/service-icon/'.$servicesdata['icon_url']);} ?>" alt="Image Not Found" class="img-thumbnail" style="width:160px; height:100px;">
                                       <?php } ?> </h5>    
                                   </div>

                               </div>


                           </div>
                           <div class="row cat">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <h5 class="font-size-14">Category Name:- </h5>    
                                </div>
                            </div>
                            <div class="col-sm-8">
                                <div class="form-group">
                                   <h5 class="font-size-14"><?php if(!empty($servicesdata['category_name'])){ echo $servicesdata['category_name']; }?> </h5>    
                               </div>

                           </div>


                       </div>

                       <div class="row cat">
                        <div class="col-sm-4">
                            <div class="form-group">
                                <h5 class="font-size-14">Subategory Name:- </h5>    
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="form-group">
                               <h5 class="font-size-14"><?php if(!empty($servicesdata['subcategory_name'])){ echo $servicesdata['subcategory_name']; }?> </h5>    
                           </div>

                       </div>


                   </div>
              <div class="row">

                    <div class="form-group">
                        <h3 class="font-size-14" style="text-align: center;">Service Banner Images</h3>

                    </div>

                </div>
                <div class="row">
                    <?php if(!empty($servicebannerImg)) { 
                        foreach ($servicebannerImg as $servicebannerImgdata){
                            ?>
                            <div class="col-sm-4">

                                <image src="<?php if(!empty($servicebannerImgdata['image_url'])) {echo base_url('uploads/service-banner-images/'.$servicebannerImgdata['image_url']);} ?>" alt="Image Not Found" class="img-thumbnail" style="width:300px; height:100px;">

                                </div>
                            <?php }} ?> 
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>
</section>
</section>
            <!-- END CONTENT -->