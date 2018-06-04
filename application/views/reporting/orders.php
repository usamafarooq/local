
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
                                <label>Start Date</label>
                                <input type="date" name="start" class="form-control" value="<?php echo $data['start'] ?>" disabled>
                            </div>
                            <div class="col-md-4">
                                <label>End Date</label>
                                <input type="date" name="end" class="form-control" value="<?php echo $data['end'] ?>" disabled>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>Sales person</th>
                                        <th>Date</th>
                                        <th>Deliver</th>
                                        <th>Received</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $deliver = array();
                                        $received = array();
                                        foreach ($orders as $o) {
                                            $deliver[] = $o['deliver'];
                                            $received[] = $o['received']; 
                                    ?>
                                    <tr>
                                        <td><?php echo $o['name'] ?></td>
                                        <td><?php echo $o['date'] ?></td>
                                        <td><?php echo $o['deliver'] ?></td>
                                        <td><?php echo $o['received'] ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Total</th>
                                        <th></th>
                                        <th><?php echo array_sum($deliver) ?></th>
                                        <th><?php echo array_sum($received) ?></th>
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
