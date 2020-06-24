            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Notifications Management</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Notifications Management</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Notifications List</h2>
                                <h2 class="title pull-right"><a href="<?php echo base_url('notifications/send');?>" class="btn btn-primary notify">Send Notification</a></h2>
                            </header>
                            <div class="content-body">    
                            <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th><input type="checkbox" class="check" style="display: block;" /></th>
                                                    <th>Id</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th><input type="checkbox" class="check" style="display: block;" /></th>
                                                    <th>Id</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                            <?php if(!empty($users)) { $i=1;?>
                                            <?php foreach($users as $user) { ?>
                                                <tr>
                                                    <td><input type="checkbox" class="user_id" name="user_id[]" value="<?php echo $user['id']; ?>" style="display: block;" /></td>
                                                    <td><?php echo $i; ?></td>
                                                    <td><img src="<?php if(!empty($user['profile_url'])) { echo base_url('uploads/users-profile/'.$user['profile_url']);} else { echo base_url('public/data/profile/profile.png');}?>" width="50px" height="41px" class="img-responsive img-circle"></td>
                                                    <td><?php if(!empty($user['user_name'])) { echo $user['user_name']; }?></td>
                                                    <td><?php if(!empty($user['email'])) { echo $user['email']; }?></td>
                                    
                                                    <td class="text-center">
                                                        <a href="<?php echo base_url('notifications/view/' . $user['id']); ?>" class="btn btn-primary">View Notification <i class="fa fa-eye bg-c-blue"></i></a>
                                                    </td>
                                                </tr>
                                            <?php $i++; }?>
                                            <?php  } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </section>
            <!-- END CONTENT -->

<!-- MODAL START FROM HERE -->
<div class="modal fade " id="notificationModal" role="dialog">
	<div class="modal-dialog ">
		<div class="modal-content boxs">
			<div class="modaly boxs" id="send-notification-wrapper">

			</div>
		</div>
	</div>
</div>
<!-- MODAL END FROM HERE -->