
<div class="row-fluid">
	<div class="span12">
	<p class="text-center">
		Accounts Ledger 
		<?php if($this->input->get('from')){ echo "From : ".$this->input->get('from'); } ?>
		<?php if($this->input->get('to')){ echo "To : ".$this->input->get('to'); } ?>
	</p>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<table class="table table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>Opening Balance</th>
					<th>Purchase Debit</th>
					<th>Purchased Credit</th>
					<th>Purchase Balance</th>
					<!-- <th>Avail</th> -->
				</tr>
			</thead>
			<tbody>
			<?php foreach ($resultSet->result() as $result): ?>
				<tr>
					<td><?php echo $result->Name; ?></td>
					<td><?php echo $result->OppBalance; ?></td>
					<td><?php echo $result->PayableDebit; ?></td>
					<td><?php echo $result->PayableCredit; ?></td>
					<td><?php echo $purchaseBalance = $result->PayableDebit-$result->PayableCredit; ?></td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>