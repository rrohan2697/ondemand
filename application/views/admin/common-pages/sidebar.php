        <!-- START CONTAINER -->
        <div class="page-container row-fluid">

            <!-- SIDEBAR - START -->
            <div class="page-sidebar ">

                <!-- MAIN MENU - START -->
                <div class="page-sidebar-wrapper" id="main-menu-wrapper"> 

                    <!-- USER INFO - START -->
                    <div class="profile-info row">
          
                        <div class="profile-image col-md-4 col-sm-4 col-xs-4">
                            <a href="<?php echo base_url('admin/dashboard'); ?>">
                                <img src="<?php if(!empty($admin_info['profile_url'])){  echo base_url('uploads/admin-profile/'.$admin_info['profile_url']); }else{ echo base_url('public/data/profile/profile.png'); } ?>" class="img-responsive img-circle">
                            </a>
                        </div>

                        <div class="profile-details col-md-8 col-sm-8 col-xs-8">
                            <h3>
                                <a href="<?php echo base_url('admin/dashboard'); ?>"><?php if(!empty($admin_info['username'])) { echo $admin_info['username']; } else { echo 'Admin'; }?></a>
                                <!-- Available statuses: online, idle, busy, away and offline -->
                                <span class="profile-status online"></span>
                            </h3>
                            <p class="profile-title"><?php if(!empty($admin_info['profile_title'])) { echo $admin_info['profile_title']; } else { echo 'Admin'; }?></p>
                        </div>

                    </div>
                    <!-- USER INFO - END -->

                    <ul class='wraplist'>	
                        <li class="<?php if(!empty($title === 'Dashboard' || $title === 'Change Password' || $title === 'Edit Profile')) { echo "open"; }?>"> 
                            <a href="<?php echo base_url('admin/dashboard'); ?>">
                                <i class="fa fa-dashboard"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="<?php if(!empty($title === 'Users Management')) { echo "open"; }?>"> 
                            <a href="<?php echo base_url('users'); ?>">
                                <i class="fa fa-lock"></i>
                                <span class="title">Users Management</span>
                            </a>
                        </li>
                        <li class="<?php if(!empty($title === 'Contact')) { echo "open"; }?>"> 
                            <a href="<?php echo base_url('users/contactUs'); ?>">
                                <i class="fa fa-lock"></i>
                                <span class="title">Contact Management</span>
                            </a>
                        </li>
                        <li class="<?php if(!empty($title === 'Categorys Management' || $title === 'Add Category' || $title === 'Edit Category')) { echo "open"; }?>"> 
                            <a href="<?php echo base_url('category'); ?>">
                                <i class="fa fa-suitcase"></i>
                                <span class="title">Categories Management</span>
                            </a>
                        </li>
                        <li class="<?php if(!empty($title === 'Sub-Categorys Management' || $title === 'Add Sub-Category' || $title === 'Edit Sub-Category')) { echo "open"; }?>"> 
                            <a href="<?php echo base_url('sub-category'); ?>">
                                <i class="fa fa-sliders"></i>
                                <span class="title">Sub-Categories Management</span>
                            </a>
                        </li>
                        <li class="<?php if(!empty($title === 'Services Management' || $title === 'Add Service' || $title === 'Edit Service')) { echo "open"; }?>"> 
                            <a href="<?php echo base_url('services'); ?>">
                                <i class="fa fa-columns"></i>
                                <span class="title">Service Management</span>
                            </a>
                        </li>
                        <li class="<?php if(!empty($title === 'Service Providers Mgmt' || $title === 'Add Service Provider' || $title === 'Edit Service Provider')) { echo "open"; }?>"> 
                            <a href="<?php echo base_url('service-provider'); ?>">
                                <i class="fa fa-bar-chart"></i>
                                <span class="title">Service Providers</span>
                            </a>
                        </li>
                        <li class="<?php if(!empty($title === 'Orders Management')) { echo "open"; }?>"> 
                            <a href="<?php echo base_url('Orders'); ?>">
                                <i class="fa fa-gift"></i>
                                <span class="title">Orders Management</span>
                            </a>
                        </li>
                        <li class="<?php if(!empty($title === 'Notifications Management' || $title ==='View Notification')) { echo "open"; }?>"> 
                            <a href="<?php echo base_url('notifications'); ?>">
                                <i class="fa fa-envelope"></i>
                                <span class="title">Notifications</span>
                            </a>
                        </li>
                        <li class="<?php if(!empty($title === 'Chat Management')) { echo "open"; }?>"> 
                            <a href="<?php echo base_url('Admin/chat'); ?>">
                                <i class="fa fa-comment"></i>
                                <span class="title">Chat</span>
                            </a>
                        </li>
                         <li class="<?php if(!empty($title === 'Social')) { echo "open"; }?>"> 
                            <a href="<?php echo base_url('users/sociallink'); ?>">
                                <i class="fa fa-envelope"></i>
                                <span class="title">Social Management</span>
                            </a>
                        </li>
                        <li class="<?php if(!empty($title === 'Service Charges' || $title === 'Banner Images' || $title === 'About-us' || $title === 'Terms and Conditions' || $title === 'FAQ\'s')) { echo "open"; }?>"> 
                            <a href="javascript:;">
                                <i class="fa fa-folder-open"></i>
                                <span class="title">Settings</span>
                                <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu">
                                <li>
                                    <a class="<?php if(!empty($title === 'Time Slots')) { echo "active"; }?>" href="<?php echo base_url('settings/time-slots');?>" >Time Slot</a>
                                </li>
                                <li>
                                    <a class="<?php if(!empty($title === 'Service Charges')) { echo "active"; }?>" href="<?php echo base_url('settings/service-charges');?>" >Service Charges</a>
                                </li>
                                <li>
                                    <a class="<?php if(!empty($title === 'Banner Images')) { echo "active"; }?>" href="<?php echo base_url('settings/banner-images');?>" >Banner Images</a>
                                </li>
                                <li>
                                    <a class="<?php if(!empty($title === 'About-us')) { echo "active"; }?>" href="<?php echo base_url('settings/about-us');?>" >About-us</a>
                                </li>
                                <li>
                                    <a class="<?php if(!empty($title === 'Terms and Conditions')) { echo "active"; }?>" href="<?php echo base_url('settings/terms-conditions');?>" >Terms and Conditions</a>
                                </li>
                                <li>
                                    <a class="<?php if(!empty($title === 'FAQ\'s')) { echo "active"; }?>" href="<?php echo base_url('settings/faqs');?>" >FAQs</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- MAIN MENU - END -->
            </div>
            <!--  SIDEBAR - END -->
			