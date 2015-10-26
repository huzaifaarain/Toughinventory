<div class="row-fluid">
	<div class="span12">
		<table class="table">
	<caption><strong>Purchase Order</strong></caption>
		<tbody>
			<tr>
				<td>PO ID</td>
				<td><?php echo $resultSet->id; ?></td>
				<td>NOTE</td>
				<td><?php echo $resultSet->note; ?></td>
			</tr>
			<tr>
				<td>Supplier</td>
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
				<th>Unit</th>
				<th>Total</th>
			</tr>
		</thead>
		<?php 
		echo $resultSet->idetail;
		?>
		</table>
			</div>
</div>
<div class="row-fluid">
	<div class="span4 pull-right">
		<table class="table">
		<caption>Summary</caption>
		<tr>
			<th>Net Total</th>
			<td><?php echo $resultSet->totalamount; ?></td>
		</tr>
		<tr>
			<th>Discount</th>
			<td><?php echo $resultSet->tax_per; ?> % - <?php echo $tax_amount = round(($resultSet->totalamount/100*$resultSet->tax_per) * 100) / 100; ?> PKR</td>			
		</tr>
		<tr>
			<th>Total</th>
			<td><?php echo $total = $resultSet->totalamount-$tax_amount; ?></td>
		</tr>
		</table>
			</div>
</div>