
<!-- footer Start -->
    <div class="footer boxs">
        <div class="container"> 
            <div class="footerInner boxs">
                <div class="footerLogo boxs">
                    <div class="fotLogo"><a href="<?php echo base_url('/') ?>"><img src="<?php echo base_url('public/web/img/logo.svg') ?>"></a></div>
                </div>
                <div class="footerBtm boxs">
                    <div class="footerSocial">
                        <ul>
                            <li><a href="<?php  echo $socialLinks[0]['sociallink'] ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a href="<?php  echo $socialLinks[1]['sociallink'] ?>" target="_blank"><i class="fab fa-instagram"></i></a></li>
                            <li><a href="<?php  echo $socialLinks[2]['sociallink'] ?>" target="_blank"><i class="fab fa-twitter"></i></a></li>
                            
                        </ul>
                    </div>
                    <div class="footerMenu">
                        <ul>
                            <li><a href="<?php echo base_url('web/terms-and-conditions');?>">Terms & Conditions</a></li>
                             <li><a href="<?php echo base_url('web/privacy');?>">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer End -->

<!--        chatbox code start-->

    <div class="chatBox">
        <div class="chatHead">
            <div class="chatLogo">
                <a href ="javascript:void(0)"><img src="<?php echo base_url('public/web/')?>img/logo.svg" class="img-fluid" alt="logo"></a>
            </div>
            <div class="chatIcon">
                <a href ="javascript:void(0)" class="min minus1"><i class="fa fa-minus"></i></a>
                <a href ="javascript:void(0)" class="hideChat"><i class="fa fa-times"></i></a>
            </div>
        </div>
        <div class="chatBody boxs">
            
        </div>
        <div class="chatFooter boxs">
            
                <div class="chatFootAll">
                    <form method="post" action="<?php echo base_url('Web_users/chatInsert') ?>" id="chat_form">
                        <div class="form-group chatInput">
                    <input type ="text" class="form-control message-input" placeholder ="How can I help you ?" name="msg" id="msg" required autocomplete="off">
                            <!--<a href ="javascript:void(0)"> <span class="smile"><img src ="<?php echo base_url('public/web/')?>img/smile.svg" class="img-fluid" alt ="smile"></span></a>-->
                        </div>
                        <div class="form-group chatBtn">
                            <button type ="button" class="chat_btn"><span class="sendBt">Send</span><span class="sendImg"><img src ="<?php echo base_url('public/web/')?>img/send.svg" class="img-fluid" alt="send"></span></button>
                        </div>
                    </form>
                </div>

        </div>
    </div>
    <!--        chatbox code end-->
    <script src="<?php echo base_url('public/web/js/jquery.js');?>"></script>
    <script>
        $(document).on('click','.sportClick' ,function(){
           $('.chatBox').slideDown();
            $('.dropBox').slideUp();
        });
        $(document).on('click','.min',function(){
    if($('.min').hasClass('minus1')){
$('.min').removeClass('minus1').addClass('plus1');
        $('.min i').removeClass('fa fa-minus').addClass('fa fa-plus');
        $('.chatBox').animate({'top':'84%'});
    }
    else{
       $('.min').removeClass('plus1').addClass('minus1');
        $('.min i').removeClass('fa fa-plus').addClass('fa fa-minus'); 
        $('.chatBox').animate({'top':'15%'});
    }
});

$(document).on('click','.hideChat' ,function(){
   $('.chatBox').hide();
});
    </script>
        <script src="<?php echo base_url('public/web/js/bootstrap.min.js');?>"></script>
        <script src="<?php echo base_url('public/web/js/slick.js');?>"></script>
        <script src="<?php echo base_url('public/web/js/intlTelInput.js');?>"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        <script src='https://1cf5229636340d3e1dd5-0eccc4d82b7628eccb93a74a572fd3ee.ssl.cf1.rackcdn.com/testing/intlTelInput.min.js'></script>
        <script src='https://1cf5229636340d3e1dd5-0eccc4d82b7628eccb93a74a572fd3ee.ssl.cf1.rackcdn.com/testing/jquery.formatter.min.js'></script>
        <script src="<?php echo base_url('public/web/js/countryscript.js?v=1.1.1');?>"></script>
        <script src="<?php echo base_url('public/assets/js/sweetalert.min.js'); ?>" type="text/javascript"></script>
        <script src="<?php echo base_url('public/web/js/custom.js');?>"></script>
        <script src="<?php echo base_url('public/web/js/MyWeb.js');?>"></script>
        <script src="<?php echo base_url('public/web/') ?>js/new.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script>
        $('.select2').select2();

        $(".boto-next").attr('type', 'button');

    </script>

    </body>
</html>



    <!-- Start of Popup Modal of profile -->
    <div class="modal profileInner fade" id="profileModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
         <button type="button" class="close closeAll" data-dismiss="modal"><img src="<?php echo base_url('public/web/img/cross.svg');?>" alt="Close_Button" class="img-fluid"></button>
                <form method="post" action="<?php echo base_url('Web_users/doProfileUpdate') ?>" id="address"  enctype="multipart/form-data">
                  
                    <div class="modal-body">
                        <div class="profileHead boxs">
                            <h3 class="headingSize">Profile</h3>
                        </div>
                        <br><br><div id="error_msg"></div>
                        <div class="profileAll boxs">

                            <div class="profileLeft">
                                <div class="avatar-upload">
                                    <div class="avatar-edit">
                                        <input type='file' id="imageUpload" name="imageUpload" accept=".png, .jpg, .jpeg" />
                                        <label for="imageUpload" class="profLab">Change Profile<br>
                                            Photo</label>
                                    </div>
                                    <div class="avatar-preview">
                                        <?php if(!empty($user['profile_url'])) {  ?>
                                        <div id="imagePreview" style="background-image: url(<?php echo base_url('uploads/users-profile/'.$user['profile_url']);?>);">
                                        </div>
                                        <?php } else {  ?>
                                        <div id="imagePreview" style="background-image: url(<?php echo base_url('public/web/img/user.png');?>);">
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="profileRight">
                                <div class="form-group">
                                    <label class="labelForm">Name</label>
                                    <input type="text" class="form-control inputForm" name="profile_name" id="profile_name" placeholder="name" value="<?php echo $user['user_name']; ?>">
                                </div>
                                <div class="form-group">
                                    <label class="labelForm">Email ID</label>
                                    <input type="email" class="form-control inputForm" placeholder="mail" value="<?php echo $user['email']; ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label class="labelForm">Phone Number</label>
                                    <input type="number" class="form-control inputForm" name="profile_phone" id="profile_phone" placeholder="9827492374" value="<?php echo $user['phone_number']; ?>">
                                </div>

                                <div class="profileBtn">
                                    <div class="cancelBtn">
                                        <button type="button" class="formBtn" data-dismiss="modal">Cancel</button>
                                    </div>
                                    <div class="saveBtn">
                                        <button type="submit" class="formBtn firstOn">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Popup Modal of profile-->

    <!-- Start of Popup Modal of change Password-->
    <div class="modal  otpPassword fade" id="changeModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close closeAll" data-dismiss="modal"><img src="<?php echo base_url('public/web/img/cross.svg');?>" alt="Close_Button" class="img-fluid"></button>
                <form method="post" action="<?php echo base_url('Web_users/doChangePassword')  ?>" id="address">
                    <div id="error_msg"></div>
                    <div class="modal-body boxs">
                        <div class="profileHead profileHead2 boxs">
                            <h3 class="headingSize">Change Password</h3>
                        </div>
                        <div class="otpInner">
                            <div class="otpInput otpInputchan boxs">
                                <div class="form-group">
                                    <label class="labelForm">Current Password</label>
                                    <input type="password" class="form-control inputForm showAll" placeholder="Current Password " name="current_pass" id="current_pass">
                                                    <span class="showBtn"><a href="javascript:void(0)" class="passShow"><span class="passwordAll fa fa-eye-slash"></span></a></span>
                                </div>
                                <div class="form-group">
                                    <label class="labelForm">New Password</label>
                                    <input type="password" class="form-control inputForm showAll" placeholder="New Password" name="new_pass" id="new_pass">
                                                    <span class="showBtn"><a href="javascript:void(0)" class="passShow"><span class="passwordAll fa fa-eye-slash"></span></a></span>
                                </div>
                                <div class="form-group">
                                    <label class="labelForm">Confirm new Password</label>
                                    <input type="password" class="form-control inputForm showAll" placeholder="Confirm New Password" name="conf_pass" id="conf_pass">
                                                    <span class="showBtn"><a href="javascript:void(0)" class="passShow"><span class="passwordAll fa fa-eye-slash"></span></a></span>
                                </div>
                                <div class="otpBtn">
                                    <button type="submit" class="formBtn">UPDATE</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Popup Modal of change passowrd-->
        
        
            <!-- Start of Popup Modal of contact-->
    <div class="modal  otpPassword fade" id="contactModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close closeAll" data-dismiss="modal"><img src="<?php echo base_url('public/web/img/cross.svg');?>" alt="Close_Button" class="img-fluid"></button>
                <form method="post" action="<?php echo base_url('Web_users/doChangePassword')  ?>" id="address">
                    <div id="error_msg"></div>
                    <div class="modal-body boxs">
                        <div class="profileHead profileHead2 boxs">
                            <h3 class="headingSize">Contact</h3>
                        </div>
                        <div class="otpInner">
                            <div class="otpInput otpInputchan boxs">
<ul class ="cantactList">
    <li>Phone No.:<a href ="tel:+916357555555">+916357555555</a></li>
    <li>E-Mail:<a href ="mailto:hammerandspanner@gmail.com">hammerandspanner@gmail.com</a></li>
    
</ul>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Popup Modal of contact-->
        
    <!-- Start of Popup Modal of Sign-up or Login to On Demand-->
    <div class="modal  otpPassword otpPassword2 fade" id="signupModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
      <button type="button" class="close closeAll" data-dismiss="modal"><img src="<?php echo base_url('public/web/img/cross.svg')?>" alt="Close_Button" class="img-fluid"></button>
                <form>
                    <div class="modal-body boxs">
                        <div class="profileHead profileHead2 boxs">
                            <h3 class="headingSize">Sign Up or Login to On Demand</h3>
                        </div>
                        <div class="gogleBtn boxs">
                            
                            
                            <a href="<?php echo $this->facebook->login_url(); ?>"><button type="button" class="formBtn"><span class="facIcon"><img src="<?php echo base_url('public/web/img/facebook.svg');?>"></span><span class="fabContent">Facebook</span></button></a>
                            
                            <a class="g-signin2" href="" data-url="<?php echo base_url("Web_users/oauth2callback");?>" data-onsuccess="onSignIn" ><button type="button" class="formBtn">Google</button></a>
                            
                            
                        </div>
                        <div class="oR boxs">
                            <p class="headingSize">Or</p>
                        </div>
                        <div class="uesEmail boxs">
                            <h3 class="headingSize">Sign Up or Login to On Demand</h3>
                        </div>
                        <div class="uesEmailBtn boxs">
                            <button type="button" class="formBtn" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Login</button>
                            <button type="button" class="formBtn formBody" data-toggle="modal" data-dismiss="modal" data-target="#SignModal">Sign Up</button>
                        </div>
                        <div class="ressendOtp">
                            <p>By Signing up you agree for the <a href="<?php echo base_url('web/terms-and-conditions') ?>">Terms & Conditions</a></p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Popup Modal of Sign-up or Login to On Demand-->

            <!-- Start of Popup Modal of login -->
    <div class="modal  otpPassword fade" id="loginModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
    <button type="button" class="close closeAll" data-dismiss="modal"><img src="<?php echo base_url('public/web/img/cross.svg');?>" alt="Close_Button" class="img-fluid"></button>
                <form name="userLogin" id="userLogin" method="post" action="<?php echo base_url('web-users/do-login/'); ?>">
                    
                    <div class="modal-body boxs">
                        <div class="profileHead profileHead2 boxs">
                            <h3 class="headingSize">Login</h3>
                            
                        </div>
                        <br><br><div id="error_msg"></div>
                        <div class="otpInner">
                            <div class="otpInput boxs">
                                <div class="form-group">
                                    <label class="labelForm">Email Address</label>
                                    <input name="emailid" id="emailid" type="email" class="form-control inputForm emailid" placeholder="Email Address">
                                </div>
                                <div class="form-group">
                                    <label class="labelForm">Password</label>
                                    <input  name="login_pass" id="login_pass" type="password"  class="form-control inputForm password showAll" placeholder="Password">
                                    <span class="showBtn"><a href="javascript:void(0)" class="passShow"><span class="passwordAll fa fa-eye-slash"></span></a></span>
                                </div>
                                <div class="forget">
                                    <a href="javascript:void(0)" data-toggle="modal" data-dismiss ="modal" data-target="#oneTimeModal">Forgot Password?</a>
                                </div>
                                <div class="otpBtn">
                                    <button type="submit" name="submit"  class="formBtn">Login</button>
                                </div>
                                <div class="ressendOtp">
                                    <p>By Logging in you agree for the <a href="<?php echo base_url('web/terms-and-conditions') ?>">Terms & Conditions</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Popup Modal of login-->
        
        
    <!-- Start of Popup Modal of otp -->
    <div class="modal  otpPassword fade" id="oneTimeModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close closeAll" data-dismiss="modal"><img src="<?php echo base_url('public/web/img/cross.svg');?>" alt="Close_Button" class="img-fluid"></button>
                <form  id="address" method="post" action="<?php echo base_url('web-users/check-email/');?>">
                    <div id="error_msg"></div>
                    <div class="modal-body boxs">
                        <div class="profileHead profileHead2 boxs">
                            <h3 class="headingSize">Forgot Password?</h3>
                        </div>
                        
                        <div class="otpInner">
                            <div class="form-group">
                                <input name="forgot_email" id="forgot_email" type="email" class="form-control inputForm emailid" placeholder="Enter registered email id.">
                            </div>
                            <div class="otpBtn">
                                <button type="submit" name="submit" class="formBtn">Continue</button>
                            </div>
                            <div class="ressendOtp">
                                <p><a href="<?php echo base_url('/') ?>" data-dismiss="modal" data-toggle="modal" data-target="#loginModal">Go back to login</a></p>
                            </div>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Popup Modal of otp-->
        
            <!-- Start of Popup Modal of reset Password-->
    <div class="modal  otpPassword fade" id="resetModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
       <button type="button" class="close closeAll" data-dismiss="modal"><img src="<?php echo base_url('public/web/img/cross.svg');?>" alt="Close_Button" class="img-fluid"></button>
                <form name="resetPassword" id="resetPassword" method="post" action="<?php echo base_url('web-users/reset-password/');?>">
                    <div id="error_msg"></div>
                    <div class="modal-body boxs">
                        <div class="profileHead profileHead2 boxs">
                            <h3 class="headingSize">Reset Password</h3>
                        </div>
                        <div class="otpInner">
                            <div class="otpInput otpInputchan boxs">
                                <div class="form-group">
                                    <label class="labelForm">New Password</label>
                                    <input name="new_password" type="password" class="form-control inputForm new_password showAll" placeholder="New Password">
                                               <span class="showBtn"><a href="javascript:void(0)" class="passShow"><span class="passwordAll fa fa-eye-slash"></span></a></span>
                                </div>
                                <div class="form-group">
                                    <label class="labelForm">Confirm New Password</label>
                                    <input name="confirm_password" type="password" class="form-control inputForm confirm_password showAll" placeholder="Confirm New Password">
                                               <span class="showBtn"><a href="javascript:void(0)" class="passShow"><span class="passwordAll fa fa-eye-slash"></span></a></span>
                                </div>
                                <div class="otpBtn">
                                    <button type="submit" name="submit" class="formBtn">Reset Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Popup Modal of change Password-->
        
        
    <!-- Start of Popup Modal of signUp -->
    <div class="modal  otpPassword fade" id="SignModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <button type="button" class="close closeAll" data-dismiss="modal"><img src="<?php echo base_url('public/web/img/cross.svg');?>" alt="Close_Button" class="img-fluid"></button>
                <form id="address" method="post" action="<?php echo base_url('web-users/do-sign-up/')?>">
                    <div id="error_msg"></div>
                    <div class="modal-body boxs">
                        <div class="profileHead profileHead2 boxs">
                            <h3 class="headingSize">Sign-up</h3>
                        </div>
                        <div class="otpInner">
                            <div class="otpInput otpInputchan boxs">
                                <div class="form-group">
                                    <label class="labelForm">Full Name</label>
                                    <input name="full_name" id="full_name" type="text" class="form-control inputForm full_name" placeholder="Full Name">
                                </div>
                                <div class="form-group">
                                    <label class="labelForm">Email Address</label>
                                    <input name="email_id" id="email_id" type="email" class="form-control inputForm email_id" placeholder="Email Address">
                                </div>                                
                                <div class="form-group">
                                    <label class="labelForm">Phone Number</label>
                                    <input type="number" name="signup_no" id="signup_no" class="form-control inputForm" placeholder="Phone Number">
                                </div>
                                <div class="form-group passSign">
                                    <label class="labelForm">Password</label>
                                    <input type="password" name="signup_pass" id="signup_pass" class="form-control inputForm showAll" placeholder="password">
                                               <span class="showBtn"><a href="javascript:void(0)" class="passShow"><span class="passwordAll fa fa-eye-slash"></span></a></span>
                                </div>
                                <div class="form-group passSign2">
                                    <label class="labelForm">Confirm Password</label>
                                    <input type="password" name="signup_cpass" id="signup_cpass" class="form-control inputForm showAll" placeholder="Confirm password">
                                               <span class="showBtn"><a href="javascript:void(0)" class="passShow"><span class="passwordAll fa fa-eye-slash"></span></a></span>
                                </div>
                                <div class="form-group checkForm">
                                    <input type="checkbox" id="html" name="html">
                                    <label for="html">I accept all the Terms & Conditions</label>
                                </div>
                                <div class="otpBtn">
                                <!-- <button type="submit" name="submit" class="formBtn"  data-dismiss="modal">CONTINUE</button> -->
                                    <button type="submit" class="formBtn">Sign Up</button>
                                </div>
                                <div class="ressendOtp">
                                    <p>By Signing up you agree for the <a href="<?php echo base_url('web/terms-and-conditions') ?>">Terms & Conditions</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End of Popup Modal of SignUp-->
     <!--edit modal start-->
	<div class="modal  bookingModal fade" id="editModal" role="dialog">
		<div class="modal-dialog">
			<div class="modal-content" id="address_wrapper">

			</div>
		</div>
	</div>
	<!--edit modal end-->


    <!-- Start of Popup Modal of reset Password-->
<!--
    <div class="modal  otpPassword fade" id="reviewModal" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
              <button type="button" class="close closeAll" data-dismiss="modal"><img src="img/cross.svg" alt="Close_Button" class="img-fluid">
                <form>
                    <div class="modal-body boxs">
                        <div class="profileHead profileHead2 boxs">
                            <h3 class="headingSize">Review and Rating</h3>
                        </div>
                        <div class="otpInner">
                            <div class="otpInput reviewAll boxs">
                                <div class="reviewAllnew">
                                    <ul>
                                        <li><a href="#" class="fas fa-star"></a></li>
                                        <li><a href="#" class="fas fa-star"></a></li>
                                        <li><a href="#" class="fas fa-star"></a></li>
                                        <li><a href="#" class="fas fa-star"></a></li>
                                        <li><a href="#" class="fas fa-star"></a></li>
                                    </ul>
                                </div>
                                <div class="rateExp">
                                    <p class="headingSize"> Rate Your Experience</p>
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control inputForm" rows="4"></textarea>
                                </div>
                                <div class="otpBtn">
                                    <button type="button" class="formBtn">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
-->
    <!-- End of Popup Modal of sign up-->
<script>
    //   $(document).on('click', '.editaddress', function(evt){
    //         evt.preventDefault();
    //         $("#editModal").modal('show');
    //         var url = $(this).data("url");
    //         $.post(url, '', function (out) {
    //             $("#address_wrapper").html(out.content_wrapper);
    //             initMap();
                
    //         });
    //     })
      function initMap() {
        var input = document.getElementById('add1');
        var input1 = document.getElementById('edit_add1');
        
        var autocomplete = new google.maps.places.Autocomplete(input, input1);

      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBtrnsDJVL7GGGEO0HWX8YEYhdVWTXS0XI&libraries=places&callback=initMap"
        async defer>
        
    </script>

<!-- Google script-->
<script src="https://apis.google.com/js/platform.js" async defer></script>
 <script>
  function onSignIn(googleUser) {
    var url = $(".g-signin2").data('url');
    var profile = googleUser.getBasicProfile();
    var name = profile.getName();
    var email = profile.getEmail();
    $.post(url, {name : name, email : email}, function(res){
      if(res.result === 1){
        window.location.href= "";
      }
    })
  }

  function signOut() {
    var auth2 = gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
      console.log('User signed out.');
    });
  }
  
    window.onbeforeunload = function(e){
      gapi.auth2.getAuthInstance().signOut();
    };

  function onLoad() {
    gapi.load('auth2', function() {
      gapi.auth2.init();
    });
  }

  $(document).on('click', '.logout', function (evt) {
        evt.preventDefault();
        var url = $(this).attr("href");
        $.post(url, function(res){
            if(res.result === 1){
                var auth2 = gapi.auth2.getAuthInstance();
                    auth2.signOut().then(function () {
                    window.location.href= "";
              });
            }
        })     
     });
</script>
<script src="https://apis.google.com/js/platform.js?onload=onLoad" async defer></script><!-- Google script-->



<!-- Firebase script-->
 <script src="https://www.gstatic.com/firebasejs/5.9.1/firebase.js"></script>
 
<script>
  // Your web app's Firebase configuration
  var firebaseConfig = {
    apiKey: "AIzaSyDSPUvtFh7y6TQJXiLbpHeKUPvHhqEMiN4",
    authDomain: "on-demand-208c9.firebaseapp.com",
    databaseURL: "https://on-demand-208c9.firebaseio.com",
    projectId: "on-demand-208c9",
    storageBucket: "on-demand-208c9.appspot.com",
    messagingSenderId: "1093805098704",
    appId: "1:1093805098704:web:30c7ec2ee59df06f6b80d5",
    measurementId: "G-VKMQLZW69J"
  };
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig);
//  firebase.analytics();
</script>


<!-- Firebase otp-->
<script>
//     window.onload = function(){
// render();
// };
// function render(){
//     // alert('okk');
// window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
// recaptchaVerifier.render();
// };
// $(document).on('click', '#send-otp', function(evt){
//     evt.preventDefault();
//     var url = $(this).attr('href');
//     var phone = $('#phone2').val();
//     phone = phone.replace(' - ', '');
//     // alert(phone)
//     firebase.auth().signInWithPhoneNumber(phone, window.recaptchaVerifier).then(function (confirmationResult){
//             window.confirmationResult=confirmationResult;
//             coderesult=confirmationResult;
//         swal({
//             title: "Link Sent Successfully",
//             icon: "success",
//             closeOnClickOutside: true,
//             }).then(function () {
//     });
//     }).catch(function(error){
//         // alert(error.message);
// });

// })
    
// </script>

<!-- Firebase otp-->


<!-- Firebase script-->
<input type="hidden" value="<?php echo $this->session->userdata('user_id');  ?>" id="user_id">

<script>

$(document).on('click', '.chat_btn', function (e) {
        var admin_id = 'TyM1oIvSbn';
        var user_id = $("#user_id").val()
        var msg = $('.message-input').val();
        var url = $('#chat_form').attr('action');
        var messagesRef = firebase.database().ref('messages/' + user_id + "_" + admin_id);

        $(".text_err_msg_cht").remove();
    
        if (msg.trim() != '') {
            var msg = $('.message-input').val();
            $.post(url, {user_id: user_id, msg: msg}, function () {

            });
            $('.message-input').val('');
            var newMessageRef = messagesRef.push();
//            var today = new Date();
//            if(today.getDate().toString().length == 1){
//               var tm = "0"+today.getDate();
//            }else{
//               var tm = today.getDate();
//            }
//            var mnt = today.getMonth()+1
//            if(mnt.toString().length == 1){
//               var mnt = "0"+mnt;
//            }else{
//               var mnt = mnt;
//            }
            // var date = tm + '-' + (mnt) + '-' + today.getFullYear();
            // var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            // var dateTime = date + ' ' + time;
            var today = new Date();
                    // var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
                    var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                    // var dateTime = date + ' ' + time;
                    
            newMessageRef.set({
                adminId: 'TyM1oIvSbn',
                senderType: "USER",
                text: msg,
                userId: user_id,
                // time:time
                time:firebase.database.ServerValue.TIMESTAMP

            });
        } else {
            $("#msg_chat").parent('.input-group').after("<span class='text-danger text_err_msg_cht'>Please Enter Message.</span>");
        }
    })
    
    $(document).on('submit', '#chat_form', function (e) {
        e.preventDefault();
        var msg = $('.message-input').val();
        var url = $('#chat_form').attr('action');
        var messagesRef = firebase.database().ref('messages/' + user_id + "_" + admin_id);
        $(".text_err_msg_cht").remove();
        if (msg.trim() != '') {
            var msg = $('.message-input').val();
            $.post(url, {user_id: user_id, msg: msg}, function () {

            });
            console.log('hi');
            $('.message-input').val('');
            var newMessageRef = messagesRef.push();
//            var today = new Date();
//            if(today.getDate().toString().length == 1){
//               var tm = "0"+today.getDate();
//            }else{
//               var tm = today.getDate();
//            }
//            var mnt = today.getMonth()+1
//            if(mnt.toString().length == 1){
//               var mnt = "0"+mnt;
//            }else{
//               var mnt = mnt;
//            }
//            var date = tm + '-' + (mnt) + '-' + today.getFullYear();
//            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
//            var dateTime = date + ' ' + time;

            newMessageRef.set({
                adminId: 'TyM1oIvSbn',
                messageType: "text",
                senderType: "USER",
                text: msg,
                date: date,
                time: time,
                userId: user_id

            });
        } else {
            $("#msg_chat").parent('.input-group').after("<span class='text-danger text_err_msg_cht'>Please Enter Message.</span>");
        }
    })
    
 var admin_id = 'TyM1oIvSbn';
var user_id = $("#user_id").val()
        
var query = firebase.database().ref('messages/' + user_id + "_" + admin_id);
query.on('child_added', function (childSnapshot) {
var childData = childSnapshot.val();
var adminId =  childData.adminId;
var userId =     childData.userId;
var senderType = childData.senderType; 
var timestamp = childData.time;
var d = new Date(timestamp);
var h = d.getHours();
var m = d.getMinutes();
var s = d.getSeconds();
var time = h + ':' + m + ':' + s;
// var n = d.getTime();
// SimpleDateFormat sfd = new SimpleDateFormat("dd-MM-yyyy HH:mm:ss");
//  var = newTime = sfd.format(new Date(timestamp));
 if(senderType == 'USER'){
   $('.chatBody').append('<div class="sendMess paddingChat boxs"><div class="innerdiv"><p>'+childData.text+'</p><span class="chatTime">'+time+'</span></div></div>')
 
 }
else{
    $('.chatBody').append('<div class="recivedMess paddingChat boxs"><div class="reviveIn"><p>'+childData.text+'</p><span class="chatTime">'+time+'</span></div></div>')
}

})
</script>

<script type="text/javascript">
    $("#chat_form").keypress(function(e) {
  //Enter key
  if (e.which == 13) {
    return false;
  }
});
   $(document).on('submit','#chat_form',function(evt){
    evt.preventDefault();

   });
</script>