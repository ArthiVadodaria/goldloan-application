<!DOCTYPE html>
<html>
<head>
	<style>
		.field_title{font-size: 13px;font-family:Arial;width: 300px;margin-top: 10px}
		.form_error{font-size: 13px;font-family:Arial;color:red;font-style:italic}
    </style>
</head>
<body>
	<div class="container">
		<h2>Edit Customer</h2>
		<div class="form_error">
		<?php echo  validation_errors();?>
        </div>
		<div class="col-md-8">
			<?php 
				echo form_open('cust_controller/update_customer_details');
				foreach ($records as $r)
			?>
			<label>Update Customer Details of <?php echo $r->cust_no ?></label>
			<input class="form-control" type="hidden" name="cust_no"  style="visibility:hidden;" id="cust_no" value="<?php echo $r->cust_no ?> "><br />
			<label>Customer Name : <?php echo $r->cust_name ?></label>
			<input class="form-control" type="hidden" name="cust_name" style="visibility: hidden;" id="cust_name" value="<?php echo $r->cust_name ?>"/><br/>
			<label>Customer Age :</label>
			<input class="form-control" type="text" name="cust_age" id="cust_age" value="<?php echo $r->cust_age ?>" /><br/>
			<label>Customer Address :</label>
			<input class="form-control" type="text" name="cust_addrs" id="cust_addrs" value="<?php echo $r->cust_addrs ?>" /><br />
			<label>Customer Phone No :</label>
			<input class="form-control" type="text" name="cust_phno" id="cust_phno" value="<?php echo $r->cust_phno ?>" /><br/>
			<label>Customer Email :</label>
			<input class="form-control" type="text" name="cust_email" id="cust_email" value="<?php echo $r->cust_email ?>" /><br/>
			<label>Customer ID Proof:</label>
			<input class="form-control" type="text" name="cust_idproof" id="cust_idproof" value="<?php echo $r->cust_idproof ?>" /><br/>
			<label>Customer Account No :</label>
			<input class="form-control" type="text" name="cust_sbacc" id="cust_sbacc" value="<?php echo $r->cust_sbacc ?>" /><br/>
			<input type="submit" class="btn btn-info" id="update" value=" Update " name="update"/></a>
			<br/>			<br/>			<br/>			<br/>			<br/>		
		</div>
    </div>
	<?php echo form_close();  ?> 
</body>
</html>