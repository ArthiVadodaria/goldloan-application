<!DOCTYPE html>
<html>
<head>
	<title>Payment | GOLD LOAN</title>
	<style>
		.field_title{font-size: 13px;font-family:Arial;width: 300px;margin-top: 10px}
		.form_error{font-size: 13px;font-family:Arial;color:red;font-style:italic}
    </style>
</head>
<body>
	<?php $id = $this->uri->segment('3'); 
	if($id!=''){?>
	<?php  echo form_open('payment_controller/payment2/'.$id.'');?>
	<div class="container">
		<h1>Payment </h1>
			<div class="" align="left" >
				<?php foreach($records as $r){?>
				<?php echo "<h4>Loan No : ".$r->loan_no. "</h4>" ?>
		
				<?php echo "<h4>Loan Applied Date: <div id='fromdate'>".$r->loan_applieddate."</div></h4>" ?>
				
				<?php echo "<h4>Loan Amount : <div id='loanamt'> ".$r->loan_amt."</div></h4>" ?>
		
				<?php } ?>
				
				<input type="hidden" id="interestType" value="<?php echo $it?>">
				
				<label>Subsequent Loan No</label> 
				<?php
				$loanno = mt_rand(1000000,5555555);
				
				foreach($record as $r){
					if($r->loan_no == $loanno)
					{
						$loanno = mt_rand(5555556,9999999);
					}
				}
				?>
				<input class='form-control' type="text" name="loan_no" id="loan_no" value="<?= $loanno;?>"  placeholder="" readonly>
				
				<h4>Todays Date:</h4>
				<div class="input-append date form_datetime">
					<input size="16" type="text" id="date" value="" name="paymentdate">
					<span class="add-on" style="position:relative;top:+30px;"><i class="icon-th"></i></span>
				</div><br/>
				
				<label>Rate of Interest</label>
				<input class="form form-control" type="text" name="loan_rate" id = "rate" >
				<span id="span1" value="0"></span><br/>
				
				<label>Interest Amt</label>
				<label id="interest" class="form-control" type="text" value=""></label>
				<input id="interesth" type="hidden" name="interest"/><br/>

				<label>Total Amt</label>
				<label id="loan_amt" class="form-control" type="text" value=""></label>
				<input id="loan_amth" type="hidden" name="loan_amt"/>
				<br/>
				
				
				<label>Payment amount</label>
				<input class="form form-control" type="text" name="loan_paidamt" id="amt">
				<span id="span2" value="0"></span>
				<br/>
				
				<label>Pending Amount : </label>
				<label id="balance" class="form-control" type="text" value=""></label>
				<input id="balanceh" type="hidden" name="balance">
				
				<div align="center">
					<button type="submit" class="submit btn btn-info" id="submit" name="submit" disabled >Submit</button>
				</div>
			<br/>
			
	<?= form_close();?>			
			</div>
		<br/><br/><br/>
	</div>
	<?php }
	else{
		echo form_open('payment_controller/payment')
		?>
			<div class="container">
			<h1>Payment</h1>
			<label>Loan No</label>
			<select class="selectl js-example-responsive" style="width: 45%" name="loan_no" value="<?=$record->loan_no?>"></select>
			<button class="btn btn-primary" id="submit" name="submit" value="">Search</button>
			<br/><br/>
			</div>
	<?php }
		echo form_close();?>
	
</body>
</html>
<script>
		$(document).ready(function(){
	
			//jquery select2 plugin
			$(".selectl").select2({
				placeholder:'select loan no',
				ajax: {
					url: "API_Controller/get_loannos",
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
		
			//on key press event 
			$("#amt").keypress(function(e) {
					if (isNaN(String.fromCharCode(e.which))) 
						e.preventDefault();
			});
			
			var d = new Date();
			
			var string = " ";
			
			var curr_date = ((d.getDate().length+1)===1)?(d.getDate()):(d.getDate());
			
			var curr_month = (((d.getMonth().length+1)===1)?(d.getMonth()):(d.getMonth()+1));
			
			var curr_year = d.getFullYear();
			
			var date = $("#date").val(""+curr_date + "/" + curr_month 
			+ "/" + curr_year+""); 
			
			var fromDate = $('#fromdate').text(),
			toDate = $('#date').val(), from, to, druation;
			
			//moment.js
			from = moment(fromDate, 'DD/MM/YYYY');
			to = moment(toDate, 'DD/MM/YYYY');

			/* using diff */
			days = to.diff(from, 'days');
			months = to.diff(from, 'months');
			months = days * 0.0329;
			year = to.diff(from, 'year');
			
			/* show the result */
			console.log(days,months,year);
				
			
			var todayDate = new Date();
			date=todayDate.getDate();
			/* q=todayDate.setDate(date-5);*/
			$(".form_datetime").datetimepicker({
				timepicker:false,
				format: "dd/mm/yyyy",
				startview : 'month',
				maxDate: new Date(),	
				autoclose: true
			});

			var loanamt = parseFloat($("#loanamt").text());
			
			var interesttype = document.getElementById("interestType").value; //get either SI or CI 
			
			var rate,totalamt,paidamt;
			$(document).on("blur","#rate",function(){  
				rate = $(this).val();
				if(rate.replace(/\s/g, "").length === 0 )
				{
					$('#span1').html('<font color="#cc0000">rate of interest is required to calculate interest and amount');					
					return false;
				}
				rate = parseFloat($(this).val());
				
				if(interesttype=='SI'){
					var interest = parseFloat((rate*months*loanamt)/100);
					console.log("si");
				}
				else{
					var year = months * 0.0833;
					var amount = parseFloat(loanamt* Math.pow((1+ (rate/(12*100))),(12*year)));
					var interest = amount - loanamt;
					console.log(amount,interest,year);
					console.log("ci");
				}
				
				$("#interest").text(interest.toFixed(2));
				$("#interesth").val(interest.toFixed(2));
			
				totalamt = parseFloat(loanamt+interest);
				
				$("#loan_amt").text(totalamt.toFixed(2));
				$("#loan_amth").val(totalamt.toFixed(2));
				
			});
			
			$(document).on("blur","#amt",function(){
				paidamt = $(this).val();
				if(paidamt.replace(/\s/g, "").length === 0 )
				{
					$('#span2').html('<font color="#cc0000">payment amount is required');
				}
				else{
					$('.submit').removeAttr('disabled');
				}
				paidamt = parseFloat($(this).val());
					
				if(totalamt<paidamt){
					$('#span2').html('<font color="#cc0000">payment amount cannot be greater than total amount');
					//alert('you cannot pay more than total aount');
				}
				var remainingamt = totalamt - paidamt;
				$('#balance').text(remainingamt.toFixed(2));
				$('#balanceh').val(remainingamt.toFixed(2));
			});
		});  
	</script>