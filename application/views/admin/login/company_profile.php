<!DOCTYPE html>
<html>
	<head>
		<title>Company Details | GOLD LOANS</title>	
	</head>
	<body>
	<?php $id = $this->uri->segment('3'); 
	switch($id):
	   case 'view': ?>
		<div id="a">
			<div class='a container details'>
			<a class='btn btn-primary' align='right' href='<?php base_url();?>../profile/editprofile'><span class='glyphicon glyphicon-edit' role='button'></span>  Edit Profile  </a>
				<legend>Company Details</legend>
					<?php foreach($records as $r){?>
					<label>Company Name :</label><?=$r->company_name;?><br/>
					<label>Company Address :</label><?=$r->company_addrs;?><br/>
					<label>Company Phone No :</label><?=$r->company_phno;?><br/>
					<label>Company Email :</label><?=$r->company_email;}?><br/>	
			</div>
		</div>
		
		<div id="">
			<div class='a container details'>
			<a class='btn btn-primary' align='right' href='<?php base_url();?>../profile/editsettings'><span class='glyphicon glyphicon-edit' role='button'></span>  Edit Settings  </a>
				<legend>Settings</legend>
					<?php foreach($records as $r){ ?>
					<label>Interest Type : </label><?=$r->interest_type;?><br/>
					<label>Description 1:</label><?=$r->description1;?><br/>
					<label>Description 2:</label><?=$r->description2;?><br/>
					<?php
					}?>
			</div>
		</div>
		
		<div id="">
			<div class='a container details'>
			<a class='btn btn-primary' align='right' href='<?php base_url();?>../profile/editimagelogo'><span class='glyphicon glyphicon-edit' role='button'></span>  Edit Logo </a>
				<legend>Current logo</legend>
				<?php $images = $this->db->get('image_upload')->result_array();
				foreach($images as $row){?>
				<img src='<?php echo base_url().$row['image_url'];?>' class="img" alt=""></img>
				<?php }?>
				
			</div>
		</div>
	<?php break;
	   case 'editprofile': ?>
		<div id="b">
			<div class='b container'>
				<?php echo form_open('details_controller/update_companydetails');?>
				<legend>Company Profile</legend>
					<?php foreach($records as $r)?>
					<label>Company Name :</label>
					<input class="form-control" type="text" name="company_name" value="<?php echo $r->company_name ?>"><br/>
					<label>Company Address :</label>
					<textarea class="form-control" type="text-area" name="company_addrs" value="<?php echo $r->company_addrs ?>" ></textarea><br />
					<label>Company Phone No :</label>
					<input class="form-control" type="text" name="company_phno" id="company_phno" value="<?php echo $r->company_phno; ?>"/><br/>
					<label>Company Email :</label>
					<input class="form-control" type="text" name="company_email" id="company_email" value="<?php echo $r->company_email; ?>"/><br/>
					
					<input type="submit" class="btn btn-info" id="submit" value=" Submit " name="submit"/></a>
				<?php echo form_close();?>
			</div>
		</div>
		<br/>
	<?php break; ?>
	<?php 
	   case 'editsettings': ?>
		<div id="b">
			<div class='b container'>
				<?php echo form_open('details_controller/update_companysettings');?>
				<legend>Company Settings</legend>
					<?php foreach($records as $r)?>
					
					<label>Select Type of Interest:</label></br>
					
					<label class="radio-inline">
					<input type="radio" name="interesttype" value="<?php echo "SI"; ?>" checked> Simple Interest (SI)<br>
					</label>
					
					<label class="radio-inline">
					<input type="radio" name="interesttype" value="<?php echo "CI"; ?>" > Compound Inetrest (CI)<br>  
					</label><br/><br/>
					
					<label>Description 1:</label>
					<input class="form-control" type="text" name="desc1" id="" value="<?php echo $r->description1;  ?>"/><br/>
					
					<label>Description 2:</label>
					<input class="form-control" type="text" name="desc2" id="" value="<?php echo $r->description2; ?>"/><br/>
					<input type="submit" class="btn btn-info" id="submit" value=" Submit " name="submit"/></a>
					
				<?php echo form_close();?>
			</div>
		</div>
		<br/>
	<?php break;
		case 'editimagelogo':
		echo form_open_multipart('details_controller/image_upload');?>
		<div id="b">
			<div class="b container">
				<legend>Company Settings</legend>
					<h3>Image Upload Form</h3>
					<input type="file" name="pic" tabindex="2" required><br>
					<input type="submit" class="btn btn-info" id="submit" value=" Submit " name="submit"/></a>
			</div>
		</div>
		<?php echo form_close();
		endswitch;?>
	</body>
</html>