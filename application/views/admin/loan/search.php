 <!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div class="container">
		<h2>Search Loan No</h2>
		<select class="select" style="width:520px"></select>
		<script>
		$(".select").select2({
			placeholder:'select Loan No',
			ajax: {
				url: "../API_Controller/get_loannos",
				dataType: 'json',
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