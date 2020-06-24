            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Sub-Categories Management</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Sub-Categories  Management</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Sub-Categories List</h2>
                                <a href="<?php echo base_url('sub-category/add');?>" class="btn btn-primary pull-right">Add New Sub-Category</a>
                            </header>
                            <div class="content-body">    
                            <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Sub-Category Image</th>
                                                    <th>Sub-Category Name</th>
                                                    <th>Category Name</th>
                                                    <!--<th>Status</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Sub-Category Image</th>
                                                    <th>Sub-Category Name</th>
                                                    <th>Category Name</th>
                                                    <!--<th>Status</th>-->
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                            <?php if(!empty($sub_categorys)) { $i=1;?>
                                            <?php foreach($sub_categorys as $sub_category) { ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><img src="<?php if(!empty($sub_category['icon_url'])) { echo base_url('uploads/sub-category-icon/'.$sub_category['icon_url']);} ?>" class="img-responsive img-circle" style="width: 150px;height: 78px;"></td>
                                                    <td><?php if(!empty($sub_category['subcategory_name'])) { echo $sub_category['subcategory_name']; }?></td>
                                                    <td><?php if(!empty($sub_category['category_name'])) { echo $sub_category['category_name']; }?></td>
                                                   
                                                    <td>
                                                        <a href="<?php echo base_url('sub-category/add/'.$sub_category['id']);?>"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                        <a href="<?php echo base_url('sub-category/view/'.$sub_category['id']);?>"><i class="fa fa-eye fa-2x"></i></a>
                                                        <a href="<?php echo base_url('sub-category/do-delete-sub-category/'.$sub_category['id']);?>" class="delete"><i class="fa fa-trash-o fa-2x"></i></a>
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
            <!--CategoryCONTENT -->