<div class="row-fluid">
	<div class="span12">
	<p class="text-center">
		Customers Ledger 
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
					<th>Debit</th>
					<th>Credit</th>
					<th>Balance</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($resultSet->result() as $result): ?>
				<tr>
					<td><?php echo $result->Name; ?></td>
					<td><?php echo $result->OppBalance; ?></td>
					<td><?php echo $result->Debit; ?></td>
					<td><?php echo $result->Credit; ?></td>
					<td><?php echo $Balance = $result->Debit-$result->Credit; ?></td>
				</tr>
			<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>