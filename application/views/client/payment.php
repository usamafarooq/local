
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
                <h1>Clients</h1>
                <small></small>
                <ol class="breadcrumb">
                    <li><a href="index.html"><i class="pe-7s-home"></i> Home</a></li>
                    <li class="active">Clients</li>
                </ol>
            </div>
        </div>
        <!-- /. Content Header (Page header) -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd ">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Clients</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="form-group row">
                            <div class="col-md-4">
                                <label>Client</label>
                                <input type="text" name="Client" class="form-control" value="<?php echo $client['Name'] ?>" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>Phone</label>
                                <input type="text" name="start" class="form-control" value="<?php echo $client['Phone'] ?>" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>Email</label>
                                <input type="text" name="end" class="form-control" value="<?php echo $client['Email'] ?>" disabled>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th>Type</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $deliver = array();
                                        $received = array();
                                        $pending = 0;
                                        foreach ($history as $h) {
                                            if ($h['status'] == 'Order') {
                                                $pending = $pending + $h['amount'];
                                            }
                                            elseif ($h['status'] == 'Paid') {
                                                $pending = $pending - $h['amount'];
                                            }
                                    ?>
                                    <tr>
                                        <td><?php echo $h['date'] ?></td>
                                        <td><?php echo $h['amount'] ?></td>
                                        <td><?php echo $h['status'] ?> Amount</td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Balance</th>
                                        <th><?php echo $pending ?></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</div>

</div>
<!-- /.main content -->
</div>
<!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- START CORE PLUGINS -->
