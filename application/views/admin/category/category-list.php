            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Categories Management</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Categories Management</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Categories List</h2>
                                <a href="<?php echo base_url('category/add');?>" class="btn btn-primary pull-right">Add New Category</a>
                            </header>
                            <div class="content-body">    
                            <div class="row">
                                    <div class="col-md-12 col-sm-12 col-xs-12">
                                        <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Category Url</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                   <th>Category Url</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                            <?php if(!empty($categorys)) { $i=1;?>
                                            <?php foreach($categorys as $category) { ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><img src="<?php if(!empty($category['icon_url'])) { echo base_url('uploads/category-icon/'.$category['icon_url']);}?>" class="img-responsive img-circle" style="width: 150px;height: 78px;"></td>
                                                    <td><?php if(!empty($category['category_name'])) { echo $category['category_name']; }?></td>
                                                     <td><?php if(!empty($category['category_url'])) { echo $category['category_url']; }?></td>
                                                    
                                                    <td>
                                                        <a href="<?php echo base_url('category/add/'.$category['id']);?>" title="Edit Category"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                        <a href="<?php echo base_url('category/view/'.$category['id']);?>" title="Category Detail"><i class="fa fa-eye fa-2x"></i></a>
                                                        <a href="<?php echo base_url('category/do-delete-category/'.$category['id']);?>" class="delete" title="Delete Category"><i class="fa fa-trash-o fa-2x"></i></a>
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