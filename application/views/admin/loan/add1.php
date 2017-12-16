<!DOCTYPE html>
<html>
<head>
	<title>Add Loan | GOLD LOAN</title>
	<style>
		.field_title{font-size: 13px;font-family:Arial;width: 300px;margin-top: 10px}
		.form_error{font-size: 13px;font-family:Arial;color:red;font-style:italic}
    </style>
</head>
<body>
	<?php  echo form_open('loan_controller/add_details');?>
	<div class="container">
		<div id="data"></div>
		<h2>Apply New Loan</h2>
		<div class="form_error">
			<?php echo validation_errors(); ?>
		</div>
		<br/>
		<div class="container">
		<legend>Basic Details</legend>
		<div class="row-sm-3" align="left" >
			<label>Select A Customer</label>
			<select class="select js-example-responsive" style="width: 45%" name="cust_no"></select>
		</div>
			</br>
		<div class="col-sm-3">
			<label>Loan No</label> 
			<?php
			$loanno = mt_rand(1000000,5555555);
			
			foreach($records as $r){
				if($r->loan_no == $loanno)
				{
					$loanno = mt_rand(5555556,9999999);
				}
			}
			?>
			<input class='form-control' type="text" name="loan_no" id="loan_no" value="<?= $loanno;?>"  placeholder="" readonly>
		</div>
		<div class="col-sm-3">
			<label>Ornaments Bag No.</label>
			<input class='form-control' type="text" name="ornaments_bag" id="ornaments_bag" value="<?= set_value('ornaments_bag');?>" />				
			<span id="span0" value="0"></span>
		</div>
		<div class="col-sm-3">
			<label>GOLD Rate / per grm.</label>
			<input class='form-control' type="text" name="gold_amt" id="gold_rate" value="<?= set_value('gold_amt');?>"/>
			<span id="span1" value="0"></span>
		</div>

		<div class="col-sm-3">
			<label>Period of loan in months</label>
			<input class='form-control' type = 'text' name='loan_repaymentdate' id='loan_repaymentdate' placeholder="enter in months" />
			<span id="span2" value="0"></span>
			<br/><br/>
		</div>
		
		<div class="col-sm-3">
			<label>Loan Rate</label>
			<input class='form-control' type = 'text' name='loan_rate' id='loan_rate' value="<?= set_value('loan_rate');?>" />
			<span id="span3" value="0"></span><br/><br/>
		</div>
			
		<div class="col-sm-3">
		<label>Select date</label>
		<div class="input-append date form_datetime">
			<input size="16" type="text" value="" name="date">
			<span class="add-on" style="position:relative;top:+30px;"><i class="icon-th"></i></span>
			<br/><br/>
		</div>
		</div>

			<div class="col-sm-12">
				<legend>Ornament Details</legend>
				<table class="table table-bordered" id="loan_table">
				<thead>
					<th>Description</th>
					<th>Wt Grms.</th>
					<th>Net Wt. Grms</th>
					<th>Add/Remove Row</th>
				</thead>
					
				<tbody>
				<tr>
					<td><input class="description form-control" type="text" name="item_description[]"/></td>
					<td><input class="wt form-control" type="text" name="item_wt[]"/></td>
					<td><input class="netwt form-control" type="text" name="item_netwt[]"/></td>
					<td><button type="button" name="add" class="add add1 btn btn-success btn-xs">+</button></td>
				</tr>
				</tbody>
					
				<tfoot>
					<tr>
						<td>TOTAL</td>
						<td>
							<label class="wttotal form-control" type="text" value="" id="total_wt"></label>
							<input id="total_wth" type="hidden" name="item_wttotal"/>
						</td>
						<td>
							<label class="wttotal form-control" type="text" value=""id="total_netwt"></label>
							<input id="total_netwth"  type="hidden" name="item_netwttotal"/>
						</td>
						<td></td>
					</tr>
						
					<tr>
						<td>Gold Rate You Entered</td>
						<td></td>
						<td>
							<label class="gold_rateh form-control" type="text" value="" id="gold_rateh"></label>
							<input id="gold_rateh1" type="hidden" name="gold_rate"/>
						</td>
						<td></td>
					</tr>
						
					<tr>
						<td>LOAN AMOUNT/Eligible Loan<br/>(NETWT*GOLD RATE)</td>
						<td></td>
						<td>
							<label id="total_loanamt" class="total_loanamt form-control" type="text" value=""></label>
							<input id="total_loanamth"  type="hidden" name="loan_amteligible"/>
						</td>
						<td></td>
					</tr>
					</tfoot>
				</table>
				<div class="container" >
					<label>Applied Loan</label>
					<input class='form-control' type = 'text' name='loan_amt' id='loan_amt' value="<?= set_value('loan_rate');?>" />
					<span id="span4" value="0"></span><br/><br/>
				</div>
				
				<div align="center">
					<button type="submit" class="submit btn btn-info" id="submit" name="submit" disabled> Submit </button>
				</div>
			</div>
		</div>
	</div>
	<br/><br/><br/><br/><br/><br/>
	<?= form_close();?>
	</body>
</html>
<script>
	$(document).ready(function(){
		
		//jquery select2 plugin
		$(".select").select2({
			placeholder:'select customer',
			ajax: {
				url: "../API_Controller/get_details",
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
		
		//	
		$("input[type=text]").focus(function() {
			$(this).select();
		});
			
		//jquery datepicker
		$( ".datepicker" ).datepicker();		
		
		$(".form_datetime").datetimepicker({
			format: "dd/mm/yyyy",
			startView: 'month',
			minView: 'month',
			autoclose: true
		});
		
		$("#cust_no,#loan_no,#gold_rate,#loan_repaymentdate,#loan_rate,#ornaments_bag,.wt,.netwt").keydown(function(event) {
			//alert(event.keyCode+"\n");
			 if (event.shiftKey == true) {
                event.preventDefault();
            }
			
            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190|| event.keyCode == 109) {

            } else {
                event.preventDefault();
            }
            
            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();

        });
			
		//dynamically adding a row
		var count = 1;
		$('.add').click(function(){
			var html_code = "<tr id='row"+count+"'>";
			html_code += "<td><input class='description form-control' type='text' name='item_description[]'/></td>";
			html_code += "<td><input class='wt form-control' type='text' name='item_wt[]' /></td>";
			html_code += "<td><input class='netwt form-control' type='text' name='item_netwt[]' /></td>";
			html_code += "<td><button type='button' name='remove' data-row='row'+count+'' class='btn btn-danger btn-xs remove'>-</button></td>";
			html_code += "</tr>"; 
			$('#loan_table').append(html_code);		

			$("input[type=text]").focus(function() {
				$(this).select();
			});
			
			//on key press event 
			$("#cust_no,#loan_no,#ornaments_bag,.wt,.netwt").keydown(function(event) {
			//alert(event.keyCode+"\n");
			 if (event.shiftKey == true) {
                event.preventDefault();
            }
			
            if ((event.keyCode >= 48 && event.keyCode <= 57) || (event.keyCode >= 96 && event.keyCode <= 105) || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46 || event.keyCode == 190|| event.keyCode == 109) {

            } else {
                event.preventDefault();
            }
            
            if($(this).val().indexOf('.') !== -1 && event.keyCode == 190)
                event.preventDefault();

			});		
		});
		
		var ob;
		$(document).on("blur","#ornaments_bag",function(){
			ob = $("#ornaments_bag").val();
			if(ob==''){
				$("#span0").html('<font color="#cc0000">Please enter this field</font>');
			}
		});
		var gr, period_in_years,rate,loanamt,interest ,loan_finalamt;
		$(document).on("blur","#gold_rate",function(){
			//this.value = parseFloat(this.value).toFixed(2);
			gr = $("input#gold_rate").val();
			if(gr==''){
				//this.value=0;
				 $("#span1").html('<font color="#cc0000">Please enter this field</font>');
			}
			$("#gold_rateh").text(this.value);
			$("#gold_rateh1").val(this.value);
		});
		
		$(document).on("blur","#loan_repaymentdate",function(){
			period_in_years = $("input#loan_repaymentdate").val()/12;
			if(period_in_years==''){
				//this.value=0;
				 $("#span2").html('<font color="#cc0000">Please enter this field</font>');
			}
			//console.log(period_in_months);
		});
		
		$(document).on("blur","#loan_rate",function(){
			rate = $("input#loan_rate").val();
			if(rate==''){
				$("#span3").html('<font color="#cc0000">Please enter this field</font>');
			}
			//console.log(rate);
		});
	
		//onblur event for class = wt
		$(document).on("blur",".wt",function(){
		var  wttotal=0;
			$('.wt').each(function(){
				if(!isNaN($(this).val())){
				//$(".wt").text(parseFloat(0));
				//this.value = parseFloat(this.value).toFixed(2);
				wttotal+=(parseFloat($(this).val()));
				if(isNaN(wttotal)){
					wttotal=0;
				}
			}
			else{
				alert('You cannot enter text or other characters');
			}
			});
			$("#total_wt").text(wttotal.toFixed(2));
			$("#total_wth").val(wttotal.toFixed(2));
		});
		
		//onblur event for class = netwt
		$(document).on("blur",".netwt",function(){
			var nettotal=0;
			$('.netwt').each(function(){
				if(!isNaN($(this).val())){
				//$(".netwt").val(0.00);
				//this.value = parseFloat(this.value).toFixed(2));
				nettotal+=parseFloat($(this).val());
				if(isNaN(nettotal)){
					nettotal=0;
				}
				}
				else{
					//this.value = 
					//alert('You cannot enter text or other characters');
				}
			});
			$("#total_netwt").text(nettotal.toFixed(2));
			$("#total_netwth").val(nettotal.toFixed(2));
			loanamt=gr*parseFloat(nettotal);
			if(isNaN(loanamt)){
				loanamt=0;
				}
			$("#total_loanamt").text(loanamt.toFixed(2));
			$("#total_loanamth").val(loanamt.toFixed(2));
			rate= $('#loan_rate').val()/100;
			period_in_years = $('#loan_repaymentdate').val()/12;
			//console.log(period_in_years);
			//var period_in_months = $('#loan_repaymentdate').val();
			interest = loanamt*rate*period_in_years;
			//var emi = loanamt * rate * (rate+1)^(period_in_months)/((rate+1)^(period_in_months)-1);
			$("#loan_interest").text(interest.toFixed(2));
			$("#loan_interesth").val(interest.toFixed(2));
			loan_finalamt = loanamt + interest;
			console.log(loan_finalamt.length);
			$("#loan_totalamt").text(loan_finalamt.toFixed(2));
			$("#loan_totalamth").val(loan_finalamt.toFixed(2));
			
		});
		var loanappliedamt;
		$(document).on("blur","#loan_amt",function(){
			loanappliedamt = $("#loan_amt").val();
			console.log(loanappliedamt);
			if(loanappliedamt==""&&loanappliedamt>loanamt){
				$('#span4').html('<font color="#cc0000">payment amount cannot be greater than total amount');
			}else{
				$('.submit').removeAttr('disabled');
			}
		});
			
		//remove a row
		$(document).on('click', '.remove', function(){
			//var delete_row = $(this).data("row");
			$(this).closest('tr').remove();
			//$(delete_row).remove();
			var wttotal = 0,nettotal=0;
			$('.wt').each(function(){
				wttotal+=parseFloat($(this).val());
			});
			$("#total_wt").text(wttotal.toFixed(2));
			$("#total_wth").val(wttotal.toFixed(2));
			$('.netwt').each(function(){
				nettotal+=parseFloat($(this).val());
			});
			$("#total_netwt").text(nettotal.toFixed(2));
			$("#total_netwth").val(nettotal.toFixed(2));
			var loanamt=gr*parseFloat(nettotal.toFixed(2));
			$("#total_loanamt").text(loanamt.toFixed(2));
			$("#total_loanamth").val(loanamt.toFixed(2));
			var rate = $('#loan_rate').val()/100;
			var period_in_years = $('#loan_repaymentdate').val()/12;
			console.log(period_in_years);
			var interest = loanamt*rate*period_in_years;
			$("#loan_interest").text(interest.toFixed(2));
			$("#loan_interesth").val(interest.toFixed(2));
		});
		});
</script>