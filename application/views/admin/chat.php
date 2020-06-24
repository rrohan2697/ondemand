<?php if(!empty($chatList)){   ?>
<!--    chat code start-->
    <div class="ChatAll boxs">
        <div class="container">
            <div class="chatInner boxs">
                <div class="row">
                    <div class="col-sm-4 bgColor4">
                        <div class="chatLeft">
                            <h2 class="heading">My Chats</h2>
                            <div class="chatTab">
                                <ul>
                                    <?php
                                   
                                    foreach($chatList as $list){   ?>
                                    <li><a href="<?php echo base_url('admin/chat/'.$list['user_id']);?>" class=" clicktab <?php  if($user_id == $list['user_id']){ $user_name= $list['user_name'];  echo "chatActive";}?>" data-id="<?php echo $list['user_id'];?>"><span class="clientImg">
                                         
                                        <img src="<?php echo base_url('public/assets/images/')  ?>user.png" class="img-fluid" alt="client">
                                        </span><span class="clientContent">
                                                <h5><?php echo $list['user_name']; ?></h5>
                                                <p><?php echo $list['message']; ?></p>
                                            </span><span class="chatDate"><?php echo $list['date'] ?></span></a></li>
                                    <?php }  ?>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8 bgColor8">
                        
                        
                        <div class="chatRight payDtl payDtl1">
                            <div class="personalHead">
                                <div class="profileImg">
                                    <img src="<?php echo base_url('public/assets/images/')  ?>user.png" class="img-fluid" alt="client">
                                </div>
                                <div class="profileName">
                                    <h5><?php echo $user_name;  ?></h5>
                                </div>
                            </div>
                            <div class="personalchatAll">
                                <div class="personalReviver">
                                    
                                    
                                </div>
                            </div>
                            <div class="personalFooter">
                                <form method="post" action="<?php echo base_url('Admin/chatInsert') ?>" id="admin_chat_form">
                                <div class="form-group chatGroup">
                                    <a href="javascript:void(0)"> <span class="chatSmile"></span></a>
                                    <input type="text" class="form-control message-input" placeholder="Write message" autocomplete="off" name="msg">
                                </div>
                                <div class="form-group chatBtn2">
                                    <button type="button" class="admin_chat_btn"><img src="<?php echo base_url('public/assets/images/') ?>plane.svg" class="img-fluid" alt="plane"></button>
                                </div>
                                </form>
                                </div>
                            </div>
                         
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<?php } else{  ?>
        <div class="ChatAll boxs">
        <div class="container">
          <div class="jumbotron">
            <center><img src="<?php echo base_url('public/assets/images/cry.png') ?>" height=100 width=100><h3>No chat Requests yet.</h3></center>      
            
          </div>
          
        </div>
        </div>
<?php } ?>
    <!--    chat code end-->
