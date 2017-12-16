		<h3>No of Loans for customer <?=$customer ?> : <?= $count;?>
		<table class="table table-striped" >
				<thead>
					<th>Loan No</th>
					<th>Loan Amount</th>
					<th>Loan Interest</th>
					<th>Loan Status</th>
				<thead>
		<?php foreach($records as $r){
				echo "<tr>";
				echo "<td>".$r->loan_no."</td>";
				echo "<td>".$r->loan_amt."</td>";
				echo "<td>".$r->loan_interest."</td>";
				echo "<td>".$r->loan_status."</td>";
				echo "</tr>";
		} 
		?>
		</table>