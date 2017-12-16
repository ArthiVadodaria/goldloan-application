<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Loans | GOLD LOAN</title>
</head>
<body>
	<!--<a class="btn btn-success" href="loan_controller/add">+Loan</a>-->
		<!-- Modal -->
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
					  <h1>Loan Details</h1>
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
		<h1 class="text-center">Loan view</h1>
		<?php echo form_open('loan_controller/get_details');?>
		<br/>
		<div class="row">
		<div class="col justify-content-center">
		<div class="col-md-3">
			<label>From:</label>
			<div class="input-append date form_datetime">
				<input size="16" type="text" value="" name="from">
				<span class="add-on" style="position:relative;top:+30px;"><i class="icon-th"></i></span>
			</div>
		</div>
		<div class="col-md-3">
			<label>To:</label>
			<div class="input-append date form_datetime">
				<input size="16" type="text" value="" name="to">
				<span class="add-on" style="position:relative;top:+30px;"><i class="icon-th"></i></span>
			</div>
		</div>
		<div class="col-md-3">
			<input type="submit" class="btn btn-info" id="submit" value=" Search " name="submit"/>
		</div>
		</div>
		</div>
		</br>
		<div class="row-sg-10">
			<table class="table table-hover"  id='loan_table'>
				<thead>
					<tr>
						<th>Loan No.</th>
						<th>Ornaments Bag No.</th>
						<!--<th>Total Weight</th>
						<th>Net Weight</th>-->
						<th>Loan Amount</th>
						<th>Rate</th>
						<th>Interest</th>
						<th>Report</th>						
						<th>Last Notice</th>
						<th>Pay</th>	
					</tr>
				</thead>
				<tbody>
				<?php foreach($records as $r){
					echo "<tr>";
					echo "<td><a class='btn' id='val' role='button' data-target='#myModal' ".$r->loan_no.'>'.$r->loan_no.'</a></td>';
					echo "<td>".$r->ornaments_bag."</td>"; 
					echo "<td>".$r->loan_amt."</td>";
					//echo "<td>".$r->loan_repaymentdate."</td>";
					echo "<td>".$r->loan_rate."</td>";
					echo "<td>".$r->loan_interest."</td>";
					//echo "<td><a class='remove' href=".base_url().'loan_controller/delete_loan/'.$r->loan_no.'><span class="glyphicon glyphicon-remove"></span></a></td>';
					//echo print_r($query);
					
					echo "<td><a id='notice' target='_blank'  href=".base_url().'loan_controller/reports/'.$r->loan_no."><span>notice</span></a></td>";
					
					echo "<td><a class='' ><span>".$r->loan_noticedate."</span></td>";
					
					if($r->loan_status=='pending'){
					echo "<td><a class='' href=".base_url().'payment_controller/pay/'.$r->loan_no.'><span class="glyphicon glyphicon-share"></span></a></td>';} 
					else{ echo "<td>paid</td>";}
					
					echo "</tr>";	
				}?>
				</tbody>
			</table>
		</div>
		<?php echo form_close();?>
		<p align="right"><a href="#" style="color:black;font-size:25px;">Back to top</a></p>
	</div>
	<br/>
</body>
<script type = "text/javascript">
		$(document).ready(function(){
			$('#loan_table').DataTable({
				responsive : true
			});
			
			//delete conformation alert
			$(document).on('click', '.remove',function(){
				return confirm('Are you sure?');
			});
			
			$("#search").click(function(){
			});	
					
			$(".btn").click(function(){
				$modal = $("#myModal").modal();
				var loanno = $(this).text(); 
				//$modal.find('.modal-body').load(loadurl);
				$modal.find('.modal-body').load('loan_controller/loan_ornament_details/'+loanno);//load the details to modal body
			}); 
			
			$(".form_datetime").datetimepicker({
				format: "dd/mm/yyyy",
				startView: 'month',
					minView: 'month',
					autoclose: true
			});
			
			$(".notice").click(function(e){
				e.preventDefault();

				var todayDate = new Date();
				
				console.log(todayDate);
				$.ajax({
					url:'<?php echo base_url();?>loan_controller/noticedate',
					type:'POST',
					data:{loan_noticedate:todayDate,'<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'},
					success:function(data){
						console.log(data);
					}
				});
			
			});
		});
</script>
</html>