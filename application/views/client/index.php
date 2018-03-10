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
													<th>Id</th><th>Name</th><th>Address</th><th>Phone</th><th>Email</th><?php 
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
													<td><?php echo $module["id"] ?></td><td><?php echo $module["Name"] ?></td><td><?php echo $module["Address"] ?></td><td><?php echo $module["Phone"] ?></td><td><?php echo $module["Email"] ?></td><?php 
														if ($permission["edit"] == "1" || $permission["deleted"] == "1"){
													?>
													<td>
														<a href="<?php echo base_url() ?>client/order_history/<?php echo $module["id"] ?>"><img src="<?php echo base_url() ?>assets/record1.png" title="Order History" alt="Order History" width="35" height="35"></a>
														<a href="#" data-toggle="modal" data-target="#myModal"><img src="<?php echo base_url() ?>assets/record1.png" title="Add Invoice" alt="Add Invoice" width="35" height="35"></a>
														<?php 
															if ($permission["edit"] == "1") {
														?>
														<a href="<?php echo base_url() ?>client/edit/<?php echo $module["id"] ?>"><img src="<?php echo base_url() ?>assets/record1.png" title="Edit" alt="Edit" width="35" height="35"></a>
														<?php } ?>
														<?php 
															if ($permission["deleted"] == "1") {
														?>
		                                                <a href="<?php echo base_url() ?>client/delete/<?php echo $module["id"] ?>"><img src="<?php echo base_url() ?>assets/d-icon.png" title="Delete" alt="Delete" width="35" height="35"></a>
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



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


