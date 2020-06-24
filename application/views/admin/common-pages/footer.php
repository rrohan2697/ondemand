
            <div class="chatapi-windows ">


</div>    </div>
<!-- END CONTAINER -->
<!-- LOAD FILES AT PAGE END FOR FASTER LOADING -->


<!-- CORE JS FRAMEWORK - START --> 
<script src="<?php echo base_url('public/assets/js/jquery-1.11.2.min.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo base_url('public/assets/js/jquery.easing.min.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo base_url('public/assets/plugins/bootstrap/js/bootstrap.min.js'); ?>" type="text/javascript"></script> 
<!-- <script src="<?php echo base_url('public/assets/plugins/pace/pace.min.js'); ?>" type="text/javascript"></script>   -->
<script src="<?php echo base_url('public/assets/plugins/perfect-scrollbar/perfect-scrollbar.min.js'); ?>" type="text/javascript"></script> 
<!-- <script src="<?php echo base_url('public/assets/plugins/viewport/viewportchecker.js'); ?>" type="text/javascript"></script>   -->

<!-- CORE JS FRAMEWORK - END --> 


<!-- OTHER SCRIPTS INCLUDED ON THIS PAGE - START --> 
<!-- <script src="<?php echo base_url('public/assets/plugins/rickshaw-chart/vendor/d3.v3.js'); ?>" type="text/javascript"></script> <script src="assets/plugins/jquery-ui/smoothness/jquery-ui.min.js" type="text/javascript"></script> <script src="assets/plugins/rickshaw-chart/js/Rickshaw.All.js"></script><script src="assets/plugins/sparkline-chart/jquery.sparkline.min.js" type="text/javascript"></script><script src="assets/plugins/easypiechart/jquery.easypiechart.min.js" type="text/javascript"></script><script src="assets/plugins/morris-chart/js/raphael-min.js" type="text/javascript"></script><script src="assets/plugins/morris-chart/js/morris.min.js" type="text/javascript"></script><script src="assets/plugins/jvectormap/jquery-jvectormap-2.0.1.min.js" type="text/javascript"></script><script src="assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script><script src="assets/plugins/gauge/gauge.min.js" type="text/javascript"></script><script src="assets/plugins/icheck/icheck.min.js" type="text/javascript"></script><script src="assets/js/dashboard.js" type="text/javascript"></script>OTHER SCRIPTS INCLUDED ON THIS PAGE - END  -->

<?php if(!empty($datatable)) { ?>
<script src="<?php echo base_url('public/assets/plugins/datatables/js/jquery.dataTables.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/assets/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js'); ?>" type="text/javascript">
</script><script src="<?php echo base_url('public/assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/assets/plugins/datatables/extensions/Responsive/bootstrap/3/dataTables.bootstrap.js'); ?>" type="text/javascript"></script>
<?php } ?>


<!-- CORE TEMPLATE JS - START --> 
<script src="<?php echo base_url('public/assets/js/scripts.js'); ?>" type="text/javascript"></script> 
<!-- END CORE TEMPLATE JS - END --> 

<!-- Sidebar Graph - START --> 
<!-- <script src="<?php echo base_url('public/assets/plugins/sparkline-chart/jquery.sparkline.min.js'); ?>" type="text/javascript"></script> -->
<!-- <script src="<?php echo base_url('public/assets/js/chart-sparkline.js'); ?>" type="text/javascript"></script> -->
<!-- Sidebar Graph - END --> 

<script src="<?php echo base_url('public/assets/js/MyEvent.js'); ?>" type="text/javascript"></script>
<script src="<?php echo base_url('public/assets/js/sweetalert.min.js'); ?>" type="text/javascript"></script>

    <!--<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>-->
        <?php if (!empty($editor) == 1) { ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote({
                height: "250px"
            });
            $('.heading').summernote({
                // height: "250px"
            });
        });
    </script>
<?php } ?>
</body>
</html>

<script type="text/javascript">

</script>

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
<script>
  $("#admin_chat_form").keypress(function(e) {
  //Enter key
  if (e.which == 13) {
    return false;
  }
});
</script>
<!-- Firebase script-->

<script>

$(document).on('click', '.admin_chat_btn', function (e) {
        var admin_id = 'TyM1oIvSbn';
        var user_id = $(".chatActive").data('id');
        var msg = $('.message-input').val();
        var url = $('#admin_chat_form').attr('action');
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
//            var date = tm + '-' + (mnt) + '-' + today.getFullYear();
//            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
//            var dateTime = date + ' ' + time;
            var today = new Date();
            var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

            newMessageRef.set({
                adminId: 'TyM1oIvSbn',
//                messageType: "text",
                senderType: "ADMIN",
                text: msg,
                time:firebase.database.ServerValue.TIMESTAMP,
                userId: user_id

            });
        } else {
            $("#msg_chat").parent('.input-group').after("<span class='text-danger text_err_msg_cht'>Please Enter Message.</span>");
        }
    })
    
    $(document).on('submit', '#admin_chat_form', function (e) {
        e.preventDefault();
        var user_id = $(".chatActive").data('id');
        var msg = $('.message-input').val();
        var url = $('#admin_chat_form').attr('action');
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
            // var today = new Date();
            // var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
            
            newMessageRef.set({
                adminId: 'TyM1oIvSbn',
                messageType: "text",
                senderType: "ADMIN",
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
var user_id = $(".chatActive").data('id');
        
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

 if(senderType == 'USER'){
   $(".personalReviver").append('<div class="revicerInner"><div class="reciverImg"><img src="<?php echo base_url('public/assets/images/')  ?>user.png" class="img-fluid" alt="client"></div><div class="reciverContent"><p>'+ childData.text +'</p><span class="chatDate">'+time+'</span></div></div>');
 
 }
else{
    $(".personalReviver").append('<div class="revicerInner right_contet"><div class="reciverImg"><img src="<?php echo base_url('public/assets/images/')  ?>user.png" class="img-fluid" alt="client"></div><div class="reciverContent"><p>'+ childData.text +'</p><span class="chatDate">'+time+'</span></div></div>');
}

})

</script>