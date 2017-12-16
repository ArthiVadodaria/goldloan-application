		<?php foreach($record as $r){
				echo "<h3><b>Loan Amount :". $r->loan_amt."</b></h3>";
				echo "<h3><b>Applied Date :". $r->loan_applieddate."</b></h3>";
		}?>
		<table class="table table-striped" >
				<thead>
					<th>Loan No</th>
					<th>Items Description</th>
					<th>Items Weight</th>
					<th>Items NetWeight</th>
				<thead>
		<!--<h1>Total Items : <?php //echo $count;?></h1>-->
		<?php if(!empty($records)){foreach($records as $r){
				echo "<tr>";
				echo "<td>".$r['loan_no']."</td>";
				echo "<td>".$r['item_description']."</td>";
				echo "<td>".$r['item_wt']."</td>";
				echo "<td>".$r['item_netwt']."</td>";
				echo "</tr>";
		} }
		else{
			echo "There are no details for this loan";
		}
		?>
		</table>