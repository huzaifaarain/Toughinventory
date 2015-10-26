<div class="row-fluid">
	<div class="span12">
		<table class="table">
	<caption><strong>Sale Return</strong></caption>
		<tbody>
			<tr>
				<td>SR ID</td>
				<td><?php echo $resultSet->id; ?></td>
				<td>NOTE</td>
				<td><?php echo $resultSet->note; ?></td>
			</tr>
			<tr>
				<td>Customer</td>
				<td><?php echo $resultSet->name; ?></td>
				<td>Reference</td>
				<td><?php echo $resultSet->reference_no; ?></td>
			</tr>
			<tr>
				<td>Date</td>
				<td colspan="3"><?php echo $resultSet->date; ?></td>
			</tr>
		</tbody>
		</table>
			</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<table class="table table-bordered">
		<caption>Products</caption>
		<thead>
			<tr>
				<th>Product</th>
				<th>Quantity</th>
			</tr>
		</thead>
		<?php 
		echo $resultSet->idetail;
		?>
		</table>
			</div>
</div>