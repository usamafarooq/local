
            <div class=control-sidebar-bg></div>
            <div id=page-wrapper>
                <div class=content>
                    <div class=content-header>
                        <div class=header-icon>
                            <i class=pe-7s-tools></i>
                        </div>
                        <div class=header-title>
                            <h1>Pharm Evo</h1>
                            <small></small>
                            <ol class=breadcrumb>
                                <li><a href="<?php echo base_url() ?>"><i class=pe-7s-home></i> Home</a></li>
                                <li class=active>Dashboard</li>
                            </ol>
                        </div>
                    </div>
                    <div class=row>
                        <a href="<?php echo base_url('orders') ?>">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-3 border">
                                <h2><span class="slight">View Orders</span></h2>
                                <div class="small"></div>
                                <i class="ti-world statistic_icon"></i>

                            </div>
                        </div>
                        </a>
                        <a href="<?php echo base_url('client') ?>">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-1 border">
                                <h2><span class="slight">View Clients</span></h2>
                                <div class="small"></div>
                                <i class="ti-server statistic_icon"></i>

                            </div>
                        </div>
                        </a>
                        <a href="<?php echo base_url('users') ?>">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-2 border">
                                <h2><span class="slight">View Users</span></h2>
                                <div class="small"></div>
                                <i class="ti-user statistic_icon"></i>

                            </div>
                        </div>
                        </a>
                        <a href="<?php echo base_url('daily_sales_report') ?>">
                        <div class="col-xs-12 col-sm-6 col-md-6 col-lg-3">
                            <div class="statistic-box statistic-filled-4 border">
                               <h2><span class="slight">View Today Order</span></h2>
                                <div class="small"></div>
                                <i class="ti-bag statistic_icon"></i>

                            </div>
                        </div>
                        </a>
                    </div>
                    <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-bd ">
                    <div class="panel-heading">
                        <div class="panel-title">
                            <h4>Order Report</h4>
                        </div>
                    </div>
                    <div class="panel-body">
                        
                        <div class="table-responsive">
                            <table id="" class="table table-bordered table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Delivered</th>
                                        <th>Empty</th>
                                        <th>Balance</th>
                                        <th>Amount</th>
                                        <th>Received</th>
                                        <th>Balance</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        foreach ($detail as $o) {
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $o['name'] ?></td>
                                        <td><?php echo $o['Address'] ?></td>
                                        <td><?php echo $o['deliver'] ?></td>
                                        <td><?php echo $o['empty'] ?></td>
                                        <td><?php echo $o['balance'] ?></td>
                                        <td><?php echo $o['amount'] ?></td>
                                        <td><?php echo $o['received'] ?></td>
                                        <td><?php echo $o['balance_amount'] ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                     <div style="height: 290px;"></div>
                </div>
<div id="chartContainer" style="height: 300px; width: 100%;">
	</div>
               

            </div>
