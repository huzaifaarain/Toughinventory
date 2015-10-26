<div class="row-fluid">
	<div class="span12">
	<p class="text-center">
		Stock Ledger
		<?php if($this->input->get('start_date')){ echo "From : ".$this->input->get('start_date'); } ?>
		<?php if($this->input->get('end_date')){ echo "To : ".$this->input->get('end_date'); } ?>
	</p>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Product Name</th>
					<th>Opening Stock (Qty)</th>
					<th>Purchased</th>
					<th>Sold</th>
					<th>Avail</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($resultSet->result() as $result): ?>
				<tr>
					<td><?php echo $result->Name; ?></td>
					<td><?php echo $result->ostock; ?></td>
					<td><?php echo $result->PurchasedQty; ?></td>
					<td><?php echo $result->SoldQty; ?></td>
					<td><?php echo $result->Avail; ?></td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>