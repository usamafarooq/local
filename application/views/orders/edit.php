
<!-- /.Navbar  Static Side -->
<div class="control-sidebar-bg"></div>
<!-- Page Content -->
<div id="page-wrapper">
    <!-- main content -->
    <div class="content">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="header-icon">
                <i class="pe-7s-note2"></i>
            </div>
            <div class="header-title">
                <h1>Edit Orders</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Edit Orders</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>orders/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $orders["id"] ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Edit Orders</h4>
                            </div>
                        </div>
                        <div class="panel-body"><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Client<span class="required">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="Client" required="">
                                                <option>Select Client</option><?php foreach ($table_client as $t) {?>
                                                    <option value="<?php echo $t["id"] ?>" <?php if($t["id"] == $orders["Client"]) echo "selected" ?>><?php echo $t["Name"] ?></option>
                                               <?php } ?></select>
                                        </div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Rider<span class="required">*</span></label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="Rider" required="">
                                                <option>Select Rider</option><?php foreach ($table_users as $t) {?>
                                                    <option value="<?php echo $t["id"] ?>" <?php if($t["id"] == $orders["Rider"]) echo "selected" ?>><?php echo $t["name"] ?></option>
                                               <?php } ?></select>
                                        </div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Quantity<span class="required">*</span></label>
                                        <div class="col-sm-9">

                                        <input class="form-control" name="Quantity" type="number" value="<?php echo $orders["Quantity"] ?>" id="example-text-input" placeholder="" required=""></div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Price<span class="required">*</span></label>
                                        <div class="col-sm-9">

                                        <input class="form-control" name="Price" type="number" value="<?php echo $orders["Price"] ?>" id="example-text-input" placeholder="" required=""></div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Date<span class="required">*</span></label>
                                        <div class="col-sm-9">

                                        <input class="form-control" name="Date" type="date" value="<?php echo $orders["Date"] ?>" id="example-text-input" placeholder="" required=""></div>

                                    </div><div class="form-group row">

                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary pull-right">Update</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

</div>
<!-- /.main content -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- START CORE PLUGINS -->
