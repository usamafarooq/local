		<!-- /.Navbar  Static Side -->
			<div class="control-sidebar-bg"></div>
			<!-- Page Content -->
			<div id="page-wrapper">
				<!-- main content -->
				<div class="content">
					<!-- Content Header (Page header) -->
					<div class="content-header">
						<div class="header-icon">
							<i class="pe-7s-box1"></i>
						</div>
						<div class="header-title">
							<h1>View Client</h1>
							<small> </small>
							<ol class="breadcrumb">
								<li><a href="<?php echo base_url() ?>"><i class="pe-7s-home"></i> Home</a></li>

								<li class="active">View Client</li>
							</ol>
						</div>
					</div> <!-- /. Content Header (Page header) -->
<form method="post" action="" enctype="multipart/form-data">

            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-bd ">
                        <div class="panel-heading">
                            <div class="panel-title">
                                <h4>Report</h4>
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group row">
                                <div class="col-md-10">
                                    <label>Day</label>
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
                                                if (isset($day) && $days[$i] == $day)
                                                {
                                                        $wd .= ' selected';
                                                }
                                                $wd .= '>'.$days[$i].'</option>';
                                            }
                                            echo $wd;
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <br>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
					<div class="row">
						<div class="col-sm-12">
							<div class="panel panel-bd">
								<div class="panel-heading">
									<div class="panel-title">
										<h4>View Client</h4>
										<?php 
											if ($permission["created"] == "1") {
										?>
										<a href="<?php echo base_url("client/create") ?>"><button class="btn btn-info pull-right">Add Client</button></a>
										<?php } ?>
									</div>
								</div>
								<div class="panel-body">
									
									<div class="table-responsive">
										<table id="dataTableExample2" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>Id</th><th>Name</th><th>Address</th><th>Phone</th><th>Email</th><th>Deposit</th><th>Deposite Date</th><?php 
														if ($permission["edit"] == "1" || $permission["deleted"] == "1"){
													?>
													<th>Action</th>
													<?php } ?>
												</tr>
											</thead>
										    <tbody>
										    	<?php
										    		foreach ($client as $module) {
										    	?>
												<tr>
													<td><?php echo $module["id"] ?></td><td><?php echo $module["Name"] ?></td><td><?php echo $module["Address"] ?></td><td><?php echo $module["Phone"] ?></td><td><?php echo $module["Email"] ?></td><td><?php echo $module["deposit"] ?></td><td><?php echo $module["deposit_date"] ?></td><?php 
														if ($permission["edit"] == "1" || $permission["deleted"] == "1"){
													?>
													<td>
														<a href="<?php echo base_url() ?>client/order_history/<?php echo $module["id"] ?>"><button class="btn btn-info btn-circle material-ripple" title="Order History"><i class="material-icons">shopping_basket</i></button></a>
														<a href="#" data-toggle="modal" data-target="#myModal" onclick="get_id(<?php echo $module["id"] ?>)"><button class="btn btn-info btn-circle material-ripple" title="Add Payment"><i class="material-icons">payment</i></button></a>
														<a href="<?php echo base_url() ?>client/payment_history/<?php echo $module["id"] ?>"><button class="btn btn-info btn-circle material-ripple" title="Payment History"><i class="material-icons">history</i></button></a>
														<?php 
															if ($permission["edit"] == "1") {
														?>
														<a href="<?php echo base_url() ?>client/edit/<?php echo $module["id"] ?>"><button class="btn btn-info btn-circle material-ripple" title="Edit"><i class="material-icons">mode_edit</i></button></a>
														<?php } ?>
														<?php 
															if ($permission["deleted"] == "1") {
														?>
		                                                <a href="<?php echo base_url() ?>client/delete/<?php echo $module["id"] ?>"><button class="btn btn-danger btn-circle material-ripple" title="Delete"><i class="material-icons">delete_forever</i></button></a>
		                                                <?php } ?>
	                                                </td>
	                                                <?php } ?>
												</tr>
												<?php } ?>
											</tbody>
										</table>
										
									</div>
								</div>
							</div>
						</div>
					</div>
					<div style="height: 450px;"></div>
				</div> <!-- /.main content -->
			</div><!-- /#page-wrapper -->
		</div><!-- /#wrapper -->
		<!-- START CORE PLUGINS -->


<form method="post" action="<?php echo base_url('client/invoice') ?>">
	<input type="hidden" name="client_id" id="id">
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Add Invoice</h4>
      </div>
      <div class="modal-body">
        <div class="row form-group">
        	<label>Amount</label>
        	<input type="number" name="amount" class="form-control">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-info">Submit</button>
      </div>
    </div>

  </div>
</div>
</form>

<script type="text/javascript">
	function get_id(id) {
		$('#id').val(id)
	}
</script>