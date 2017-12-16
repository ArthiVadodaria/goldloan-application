<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Payment Information | GOLD LOAN</title>
</head>
<body>
	<?= form_open('payment_controller/info');?>
	<div class="container ">
		<h1>Payment Information</h1>
		<label>Loan No</label>
		<select class="selectl js-example-responsive" style="width: 45%" name="loan_no"></select><br/><br/>
		<div align="center">
			<input type="submit" class="btn btn-info" id="submit" value=" Submit " name="submit"/>
		</div>
		
		<table class='table table-bordered' >
			<thead>
				<th>Loan No </th>
				<th>Amount Paid </th>
				<th>Date of Payment </th>
			</thead>
			<tbody>
				<?php foreach($records as $r){?>
				<tr>
					<td><?php echo $r->loan_no;?></td>
					<td align="right"><?php echo $r->loan_paidamt;?></td>
					<td align="right"><?php echo $r->dateofpayment;}?></td>
				</tr>
			</tbody>
		</table>
	</div>
</body>
</html>
<script>
	//jquery select2 plugin
		$(".selectl").select2({
			placeholder:'select loan no',
			ajax: {
				url: "../API_Controller/get_allloannos",
				dataType: "json",
				delay: 250,
				processResults: function (data) {
				return {
					results: data,
					};
				},
			cache: true
			}
		}); 
</script>