            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Contact Management</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Contact Management</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Contact List</h2>
                            </header>
                            <div class="content-body">    
                            <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <!--<th>Image</th>-->
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone No.</th>
                                                    <th>Message</th>
                                                    <!--<th>Action</th>-->
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th>Id</th>
                                                    <!--<th>Image</th>-->
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Phone No.</th>
                                                    <th>Message</th>
                                                    <!--<th>Action</th>-->
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                            <?php if(!empty($users)) { $i=1;?>
                                            <?php foreach($users as $user) { ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <!--<td><img src="<?php if(!empty($user['profile_url'])) { echo base_url('uploads/users-profile/'.$user['profile_url']);} else { echo base_url('public/data/profile/profile.png');}?>" width="50px" height="40px" class="img-responsive img-circle"></td>-->
                                                    <td><?php if(!empty($user['name'])) { echo $user['name']; }?></td>
                                                    <td><?php if(!empty($user['email'])) { echo $user['email']; }?></td>
                                                    <td><?php if(!empty($user['phone'])) { echo $user['phone']; }?></td>
                                                    <td><?php if(!empty($user['text'])) { echo $user['text']; }?></td>
                                                   
                                                    <!-- <td></td> -->
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