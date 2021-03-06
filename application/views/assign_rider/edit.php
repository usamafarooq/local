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
                <h1>Edit Assign rider</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Edit Assign rider</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>assign_rider/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $assign_rider["id"] ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Edit Assign rider</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Date<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="Date" type="date" value="<?php echo $assign_rider["Date"] ?>" id="example-text-input" placeholder="" required="">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Rider<span class="required">*</span></label>
                                <div class="col-sm-9">
                                    <select class="form-control" name="Rider" required="">
                                        <option>Select Rider</option>
                                        <?php foreach ($table_users as $t) {?>
                                        <option value="<?php echo $t["id"] ?>" <?php if($t["id"] == $assign_rider["Rider"]) echo "selected" ?>><?php echo $t["name"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="example-text-input" class="col-sm-3 col-form-label">Client<span class="required">*</span></label>
                                <!-- <div class="col-sm-9">
                                    <select class="form-control" name="Client[]" required="" multiple="">
                                        <option>Select Client</option>
                                        <?php foreach ($table_client as $t) {?>
                                        <option value="<?php echo $t["id"] ?>" <?php $client = explode(',', $assign_rider["Client"]); $key = array_search($t["id"], $client); if($key > -1) {if(array_key_exists($key, $client)) echo "selected";} ?>><?php echo $t["Name"] ?></option>
                                        <?php } ?>
                                    </select>
                                </div> -->
                                <div class="col-md-9">
                                    <?php foreach ($table_client as $t) {?>
                                    <div class="checkbox checkbox-info checkbox-inline">
                                        <input type="checkbox"  name="Client[]" id="inlineCheckbox<?php echo $t["id"] ?>" value="<?php echo $t["id"] ?>" <?php $client = explode(',', $assign_rider["Client"]); $key = array_search($t["id"], $client); if($key > -1) {if(array_key_exists($key, $client)) echo "checked";} ?>>
                                        <label for="inlineCheckbox<?php echo $t["id"] ?>"><?php echo $t["Name"] ?></label>
                                    </div><br>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="form-group row">
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