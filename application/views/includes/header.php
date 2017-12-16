<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
	<!--<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/basic-template.css">-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-theme.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/datatables/jquery.dataTables.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/datatables/dataTables.bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/select2/select2.min.css" rel="stylesheet"/>

	<script type="text/javascript" src="<?php echo base_url();?>assets/js/external/jquery/jquery.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatables/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/datatables/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo base_url();?>assets/js/select2/select2.min.js"></script>
	<script src="https://momentjs.com/downloads/moment.min.js"></script>	
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/js/jquery-ui.min.css"></link>

	<script rel="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.min.js"></script>
</head>
<body>
	<nav class='navbar navbar-inverse navbar-static-top' role='navigation'>
	  <div class='container-fluid'>
		<div class='navbar-header'>
			<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
				<span class='sr-only'>Toggle navigation</span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
				<span class='icon-bar'></span>
			</button>
			<a class='navbar-brand' >
				<?php $images = $this->db->get('image_upload')->result_array();
				foreach($images as $row){?>
				<img src='<?php echo base_url().$row['image_url'];?>' class="img" height="80" width="80" alt=""></img>
				<?php }?>
			</a>
		</div>
		<div id='navbar' class='navbar-collapse collapse'>
		    <ul class='nav navbar-nav navbar-right'>
				<li><a href='<?php echo base_url();?>authentication_controller/home'><span class="glyphicon glyphicon-home"> Home</a></li>
				<li><a href='<?php echo base_url();?>cust_controller'><span class="glyphicon glyphicon-user"></span>  View Customers</a></li>
				<li><a href='<?php echo base_url();?>loan_controller'><span class="glyphicon glyphicon-user"> ViewLoans</a></li>
				<li><a href='<?php echo base_url();?>cust_controller/add'><span class="glyphicon glyphicon-plus"> AddCustomer</a></li>
				<li><a href='<?php echo base_url();?>loan_controller/add1'><span class="glyphicon glyphicon-plus"> ApplyLoan</a></li>
				<li><a href='<?php echo base_url();?>payment_controller'><span class="glyphicon glyphicon-plus"> Payment Process</a></li>
				<li class='dropdown'><a class="dropdown-toggle" data-toggle="dropdown" href="#">MORE<span class='caret'></a><ul class="dropdown-menu">
				  <li><a href='<?=base_url();?>payment_controller/list'>Payment Information</a></li>
				  <li><a href='<?=base_url();?>details_controller/change_pwd'>Change Password</a></li>
				  <li><a href='<?=base_url();?>details_controller/profile/view'>Settings</a></li>
				</ul></li>
				<li><a href='<?php echo base_url();?>authentication_controller/logout'><span class="glyphicon glyphicon-log-out"></span>  Logout</a></li>
			</ul>
		</div>
	  </div>
	</nav>