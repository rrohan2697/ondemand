    <section class="faq_sec topSpace boxs">
        <div class="container">
            <div class="row faq_content">
                <div class="col-md-12 fqa_ryt">
                    <div class="tab-content">
                        <div class="tab-pane active" id="bookings" role="tabpanel">
                            <p>Dashboard - FAQs</p>
                            <h3>What issue are you facing ?</h3>
                            <?php if(!empty($faqs)){ $i = 0; foreach($faqs as $faq) { ?>
                            <button class="accordion  active">
                            	<span class=""><?php if(!empty($faq['title'])) { echo $faq['title']; } ?></span>
                                 <a href="javascript:void(0)" class="pluss"><i class="fa fa-angle-right"></i></a>
                                <a href="javascript:void(0)" class="minuss"><i class="fa fa-angle-down"></i></a>
                            </button>
                            <div class="panel text-justify" style="display: block;">
                                <p><?php if(!empty($faq['description'])) { echo $faq['description']; } ?></p>
                            </div>
                            <?php $i++; } } ?>
                            <!-- <button class="accordion">
                            	<span class="">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                                <a href="javascript:void(0)" class="pluss"><i class="fa fa-angle-right"></i></a>
                                <a href="javascript:void(0)" class="minuss"><i class="fa fa-angle-down"></i></a>
                            </button>
                            <div class="panel" >
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            </div>

                            <button class="accordion">
                            	<span class="">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                                 <a href="javascript:void(0)" class="pluss"><i class="fa fa-angle-right"></i></a>
                                <a href="javascript:void(0)" class="minuss"><i class="fa fa-angle-down"></i></a>
                            </button>
                            <div class="panel">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            </div>

                            <button class="accordion">
                           	<span class="">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</span>
                                 <a href="javascript:void(0)" class="pluss"><i class="fa fa-angle-right"></i></a>
                                <a href="javascript:void(0)" class="minuss"><i class="fa fa-angle-down"></i></a>
                            </button>
                            <div class="panel">
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                            </div>
 -->
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>