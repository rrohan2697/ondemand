<form name="send-notification" id="send-notification" action="<?php echo base_url('notifications/do-send');?>" method="post">
    <div class="form_area boxs">
        <h5>Send Notification</h5>
        <button type="button" class="close" data-dismiss="modal"><img src="<?php echo base_url('public/assets/images/close.svg');?>" class="img-fluid" alt="close"></button>
        <div id="error_msg"></div>
        <div class="form-group">
                <!-- <label for="form1">Send To</label> -->
                <input type="text" class="form-control" id="send_to" readonly Value="<?php if(!empty($user_name)) { echo $user_name; } ?>">
                <input type="hidden" value="<?php echo $user_id; ?>" name="user_id"/>
        </div>
        <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" placeholder="Subject Here...">
        </div>
        <div class="form-group">
                <label for="form2">Description</label>
                <textarea row="8" class="form-control" name="description" id="description" placeholder="Description Here..."></textarea>
        </div>
        <div class="btnss boxs">
            <button type="submit" name="submit" class="submit">Send</button>
        </div>
    </div>
</form>