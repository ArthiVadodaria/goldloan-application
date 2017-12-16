<!DOCTYPE html>
<html>
<head>
	<title>Add Customer | GOLD LOAN</title>
	<style>
		.field_title{font-size: 13px;font-family:Arial;width: 300px;margin-top: 10px}
		.form_error{font-size: 13px;font-family:Arial;color:red;font-style:italic}
    </style>
</head>
<body>
	<?= form_open('cust_controller/add_details');?>
	<div class="container">
		<h1>Add Customer</h1>
		<div class="form_error">
          <?= validation_errors(); ?>
        </div>
		<div class="col-md-8">
			<label>Customer No. :</label>
			<?php $a ="CN";
				  $x = mt_rand(100000,999999);
				  $y = mt_rand(1000,9999);
				  $custno=$a.$x.$y;
			?>
			<input class="form-control" type="text" name="cust_no"  value="<?php if(set_value('cust_no')==''){echo $custno;}else{ echo set_value('cust_no');} ?>" id="cust_no" placeholder="" readonly><br/>
			<label>Customer Name :</label>
			<input class="form-control" type="text" name="cust_name" value="<?php echo set_value('cust_name'); ?>" id="cust_name" placeholder=""><br/>
			<label>Customer Age :</label>
			<input class="form-control" type="text" name="cust_age" id="cust_age" value="<?php echo set_value('cust_age'); ?>" placeholder=""><br/>
			<label>Customer Address :</label>
			<input class="form-control" type="text" name="cust_addrs" id="cust_addrs" value="<?php echo set_value('cust_addrs'); ?>" placeholder=""><br/>
			<label>Customer Phone No :</label>
			<input class="form-control" type="text" name="cust_phno" id="cust_phno" value="<?php echo set_value('cust_phno'); ?>" placeholder=""><br/>
			<label>Customer Email :</label>
			<input class="form-control" type="text" name="cust_email" id="cust_email" value="<?php echo set_value('cust_email'); ?>" placeholder=""><br/>
			<label>Customer ID Proof:</label>
			<input class="form-control" type="text" name="cust_idproof" id="cust_idproof" value="<?php echo set_value('cust_idproof'); ?>" placeholder=""><br/>
			<label>Customer Account No :</label>
			<input class="form-control" type="text" name="cust_sbacc" id="cust_sbacc" value="<?php echo set_value('cust_sbacc'); ?>" placeholder=""><br/>
			
			<input type="submit" class="btn btn-info" id="submit" value=" Submit " name="submit"/>
			<br/>	<br/>	<br/>	<br/>	<br/>
		</div>
    </div>
	<?= form_close();  ?> 
</body>
</html>