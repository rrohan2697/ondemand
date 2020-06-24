<table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Images</th>
            <th>Action</th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th>Id</th>
            <th>Images</th>
            <th>Action</th>
        </tr>
    </tfoot>

    <tbody>
    <?php if(!empty($images)) { $i=1;?>
    <?php foreach($images as $image) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><img src="<?php if(!empty($image['image_url'])) { echo base_url('uploads/main-banner-images/'.$image['image_url']);}?>" class="img-responsive" width="250px" height="150px"></td>
            <td>
                <?php if(!empty($image['status'])) {
                   if($image['status'] === 'Active'){ ?>
                <a href="<?php echo base_url('settings/change-status/'.$image['id'].'/Inactive');?>" class="change-status" title="Inactive"><i class="fa fa-thumbs-o-up fa-2x"></i></a>
                <?php }else{ ?>
                <a href="<?php echo base_url('settings/change-status/'.$image['id'].'/Active');?>" class="change-status" title="Active"><i class="fa fa-thumbs-o-down fa-2x"></i></a>                
                <?php } } ?>
                <a href="<?php echo base_url('settings/do-delete-banner-images/'.$image['id']);?>" class="delete" title="Delete"><i class="fa fa-trash-o fa-2x"></i></a>
            </td>
        </tr>
    <?php $i++; }?>
    <?php  } ?>
    </tbody>
</table>