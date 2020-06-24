            <!-- START CONTENT -->
            <section id="main-content" class=" ">
                <section class="wrapper main-wrapper" style=''>

                    <div class='col-lg-12 col-md-12 col-sm-12 col-xs-12'>
                        <div class="page-title">

                            <div class="pull-left">
                                <h1 class="title">Service Charges</h1>                            
                            </div>

                            <div class="pull-right hidden-xs">
                                <ol class="breadcrumb">
                                    <li>
                                        <a href="<?php echo base_url('admin/dashboard');?>"><i class="fa fa-home"></i>Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="javascript:void;">Service Charges</a>
                                    </li>
                                </ol>
                            </div>

                        </div>
                    </div>
                    <div class="clearfix"></div>

                    <div class="col-lg-12">
                        <section class="box ">
                            <header class="panel_header">
                                <h2 class="title pull-left">Service Charges List</h2>
                            </header>
                            <div class="content-body">    
                            <div class="row">
                                    <div class="col-md-8 col-sm-8 col-xs-8">
                                        <!-- <div id="banner-images" data-url="<?php echo base_url('settings/banner-images-wrapper'); ?>" enctype="multipart/form-data">
                                        </div>         -->
                                        <table id="example-1" class="table table-striped dt-responsive display" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Delivery Charge</th>
                                                    <th>Service Tax (%)</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>

                                            <tfoot>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Delivery Charge</th>
                                                    <th>Service Tax (%)</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>

                                            <tbody>
                                            <?php if(!empty($charges)) { $i=1;?>
                                            <?php foreach($charges as $charge) { ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><?php if(!empty($charge['delivery_charge'])) { setlocale(LC_MONETARY, 'en_IN.UTF-8');
                                                     echo money_format('&#x20b9;%!n', $charge['delivery_charge']); }?></td>
                                                    <td><?php if(!empty($charge['tax_charge'])) { echo $charge['tax_charge'] .'%'; }?></td>
                                                    <td>
                                                        <a href="<?php echo base_url('settings/service-charges/'.$charge['id']);?>"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                                    </td>
                                                </tr>
                                            <?php $i++; }?>
                                            <?php  } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <?php if(!empty($services['id'])) {?>
                                    <div class="col-md-4 col-sm-4 col-xs-4">
                                        <form name="uploadImages" id="uploadImages" method="post" action="<?php if(!empty($services['id'])) { echo base_url('settings/do-edit-service-charges/'.$services['id']); } ?>">
                                            <div id="error_msg"></div>
                                            <div class="form-group">
                                                <label class="form-label" for="field-1"><?php if(!empty($services['id'])){ echo "Edit "; } ?> Delivery Charges (₹)</label>
                                                <div class="controls">
                                                    <input type="delivery_charge" name="delivery_charge" class="form-control delivery_charge" id="field-1" value="<?php if(!empty($services['delivery_charge'])) { echo $services['delivery_charge']; } ?>" >
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="form-label" for="field-2"><?php if(!empty($services['id'])){ echo "Edit "; } ?> Tax Charges (%)</label>
                                                <div class="controls">
                                                    <input type="tax_charge" name="tax_charge" class="form-control tax_charge" id="field-2" value="<?php if(!empty($services['tax_charge'])) { echo $services['tax_charge']; } ?>" >
                                                </div>
                                            </div>

                                            <div class="">
                                                <button type="submit" name="submit" class="btn btn-success">Save Changes</button>
                                            </div>
                                        </form>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </section>
                    </div>
                </section>
            </section>
            <!--CategoryCONTENT -->