<table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Start Time</th>
            <!--<th>End Time</th>-->
            <th>Action</th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th>Id</th>
            <th>Start Time</th>
            <!--<th>End Time</th>-->
            <th>Action</th>
        </tr>
    </tfoot>

    <tbody>
    <?php if(!empty($times)) { $i=1;?>
    <?php foreach($times as $time) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php if(!empty($time['start_time'])) { echo $time['start_time']; }?></td>
            <!--<td><?php if(!empty($time['end_time'])) { echo $time['end_time']; }?></td>-->
            <td>
                <?php if(!empty($time['status'])) {
                   if($time['status'] === 'Active'){ ?>
                <a href="<?php echo base_url('settings/change-statustimeslot/'.$time['id'].'/Inactive');?>" class="change-status" title="Inactive Time Slot"><i class="fa fa-thumbs-o-up fa-2x"></i></a>
                <?php }else{ ?>
                <a href="<?php echo base_url('settings/change-statustimeslot/'.$time['id'].'/Active');?>" class="change-status" title="Active Time Slot"><i class="fa fa-thumbs-o-down fa-2x"></i></a>                
                <?php } } ?>
                <a href="<?php echo base_url('settings/time-slots/'.$time['id']);?>" title="Edit Time Slot"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                <a href="<?php echo base_url('settings/do-delete-time-slot/'.$time['id']);?>" class="delete" title="Delete Time Slot"><i class="fa fa-trash-o fa-2x"></i></a>
            </td>
        </tr>
    <?php $i++; }?>
    <?php  } ?>
    </tbody>
</table>