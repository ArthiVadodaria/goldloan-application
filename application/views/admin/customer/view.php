<!DOCTYPE html>
<html>
<head>
	<title>Customer View | GOLD LOAN</title>
	<script type = "text/javascript">
		$(document).ready(function(){
			$('#cust_table').DataTable();
		});
		$(document).on('click', '.remove',function(){
			return confirm('Are you sure?');
		});
	</script>
</head>
<body>
<!--<a class="btn btn-success" href="loan_controller/add">+Loan</a>-->
		<!-- Modal -->
		<div class="modal fade" id="customerModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h3>Customer Loans</h3>
					</div>
				
					<div class="modal-body" style="padding:40px 50px;">
						<form role="form">
							<div class="form-group">
							</div>
						</form>
					</div>
					
					<div class="modal-footer">
					  <button type="button" class="btn btn-danger btn-default" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button>
					</div>
				</div>
			</div>
		</div> 
		
	<div class="container">
	<h1 class="text-center">Customer view</h1>
	<br/>
	<!--<a class="btn btn-success" href="cust_controller/add">+Customer</a>-->
		<div class="row-sg-10">
			<table class="table table-hover" id='cust_table'>
				<thead>
					<tr>
					<th>Customer No.</th>
					<th>Customer Name</th>
					<th>Customer Age</th>
					<th>Customer Address</th>
					<th>Customer Phone No</th>
					<th>Customer Email</th>
					<!--<th>Customer Id Proof</th>-->
					<th>Customer Account No</th>
					<th>Edit</th>	
					<th>Delete</th>	
					</tr>
				</thead>
				<tbody>
				<?php foreach($records as $r){
					echo "<tr>";
					echo "<td><a class='btn' role='button' data-target='#customerModal'>".$r->cust_no."</td>"; 
					echo "<td>".$r->cust_name."</td>"; 
					echo "<td>".$r->cust_age."</td>";
					echo "<td>".$r->cust_addrs."</td>";
					echo "<td>".$r->cust_phno."</td>"; 
					echo "<td>".$r->cust_email."</td>"; 
					/* echo "<td>".$r->cust_idproof."</td>"; */
					echo "<td>".$r->cust_sbacc."</td>"; 
					echo "<td><a class='edit' href=".base_url().'cust_controller/edit_customer/'.$r->cust_no.'><span class="glyphicon glyphicon-edit"></span></a></td>'; 
					echo "<td><a class='remove' href=".base_url().'cust_controller/delete_customer/'.$r->cust_no.'><span class="glyphicon glyphicon-remove"></span></a></td>'; 
					echo "</tr>";	
				}?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="container">
		<p align="right"><a href="#" style="color:black;font-size:25px;">Back to top</a></p>
	</div>
	<br/>
</body>
</html>
<script>
	$(".btn").click(function(){
		$modal = $("#customerModal").modal();
		var customerno = $(this).text(); 
		//$modal.find('.modal-body').load(loadurl);
		$modal.find('.modal-body').load('cust_controller/customerloan_details/'+customerno);//load the details to modal body
	});
</script>