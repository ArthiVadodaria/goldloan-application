 <!DOCTYPE html>
<html>
<head>
</head>
<body>
	<div class="container">
		<h2>Search Customer</h2>
		
		<select class="select" style="width:520px">
			
		</select>
		<script>
		$(".select").select2({
			placeholder:'select customer',
			ajax: {
				url: "../API_Controller/get_details",
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