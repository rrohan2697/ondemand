<table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
    <thead>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Link</th>
            <th>Action</th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Link</th>
            <th>Action</th>
        </tr>
    </tfoot>

    <tbody>
    <?php if(!empty($social)) { $i=1;?>
    <?php foreach($social as $socialdata) { ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><?php if(!empty($socialdata['name'])) { echo $socialdata['name']; }?></td>
            <td><?php if(!empty($socialdata['sociallink'])) { echo $socialdata['sociallink']; }?></td>
            <td>
                <a href="<?php echo base_url('users/sociallink/'.$socialdata['id']);?>"><i class="fa fa-pencil-square-o fa-2x" aria-hidden="true"></i></a>
                <a href="<?php echo base_url('users/do-delete-social/'.$socialdata['id']);?>" class="delete"><i class="fa fa-trash-o fa-2x"></i></a>
            </td>
        </tr>
    <?php $i++; }?>
    <?php  } ?>
    </tbody>
</table>