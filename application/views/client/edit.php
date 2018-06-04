
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
                <h1>Edit Client</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Edit Client</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->

        <form method="post" action="<?php echo base_url() ?>client/update" enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $client["id"] ?>">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Edit Client</h4>
                            </div>
                        </div>
                        <div class="panel-body"><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Name<span class="required">*</span></label>
                                        <div class="col-sm-9">

                                        <input class="form-control" name="Name" type="text" value="<?php echo $client["Name"] ?>" id="example-text-input" placeholder="" required=""></div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Address</label>
                                        <div class="col-sm-9">

                                        <textarea class="form-control" name="Address" ><?php echo $client["Address"] ?></textarea></div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Phone</label>
                                        <div class="col-sm-9">

                                        <input class="form-control" name="Phone" type="number" value="<?php echo $client["Phone"] ?>" id="example-text-input" placeholder="" ></div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Price</label>
                                        <div class="col-sm-9">

                                        <input class="form-control" name="Price" type="number" value="<?php echo $client["Price"] ?>" id="example-text-input" placeholder="" ></div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Deposit</label>
                                        <div class="col-sm-9"><input class="form-control" name="deposit" type="number" value="<?php echo $client["deposit"] ?>" id="example-text-input" placeholder="" ></div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Deposit Date</label>
                                        <div class="col-sm-9"><input class="form-control" name="deposit_date" type="date" value="<?php echo $client["deposit_date"] ?>" id="example-text-input" placeholder="" ></div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Area</label>
                                        <div class="col-sm-9"><input class="form-control" name="area" type="text" value="<?php echo $client["area"] ?>" id="example-text-input" placeholder="" ></div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Day</label>
                                        <div class="col-sm-9">
                                            <?php 
                                                $days = array(
                                                    1 => 'Monday',
                                                    2 => 'Tuesday',
                                                    3 => 'Wednesday',
                                                    4 => 'Thursday',
                                                    5 => 'Friday',
                                                    6 => 'Saturday',
                                                    7 => 'Sunday'
                                                );
                                            ?>
                                            <select class="form-control" name="Day">
                                                <option value="">Select Day</option>
                                                <?php 
                                                    $wd = '';
                                                    for ($i = 1; $i <= 7; $i++)
                                                    {
                                                        $wd .= '<option value="'.$days[$i].'"';
                                                        if ($days[$i] == $client["Day"])
                                                        {
                                                                $wd .= ' selected';
                                                        }
                                                        $wd .= '>'.$days[$i].'</option>';
                                                    }
                                                    echo $wd;
                                                ?>
                                            </select>
                                        </div>

                                    </div><div class="form-group row">

                                <label for="example-text-input" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">

                                        <input class="form-control" name="Email" type="email" value="<?php echo $client["Email"] ?>" id="example-text-input" placeholder="" ></div>

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
