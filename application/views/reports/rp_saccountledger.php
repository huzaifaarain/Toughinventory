<?php 

	$totalP = 0;
	$totalPP = 0;
	$totalS = 0;
	$totalSR = 0;
 ?><div class="row-fluid">
	<div class="span12">
	<p class="text-center">
		Account Ledger of <?php echo $supplier->row()->name; ?>
		<?php if($this->input->get('from')){ echo "From : ".$this->input->get('from'); } ?>
		<?php if($this->input->get('to')){ echo "To : ".$this->input->get('to'); } ?>
	</p>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<table class="table table-bordered">
		<caption><h5>Purchases</h5></caption>
			<thead>
				<tr>
					<th>Date</th>
					<th>Product(Qty)(Amount)</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($purchases->result() as $rows) 
			{
				$totalP += $rows->totalamount;
				?>
				<tr>
					<td><?php echo $rows->date; ?></td>
					<td><?php echo $rows->idetail; ?></td>
					<td><?php echo $rows->totalamount; ?></td>
				</tr>
				<?php
			} echo (($purchases->num_rows() > 0) ? null: "<tr><td colspan='3'>No Records</td></tr>"); ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row-fluid">
	<div class="span12">
		<table class="table table-bordered">
		<caption><h5>Purchase Amounts</h5></caption>
			<thead>
				<tr>
					<th>Date</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
			<?php foreach ($pamounts->result() as $rows) 
			{
				$totalPP += $rows->amount;

				?>
				<tr>
					<td><?php echo $rows->date; ?></td>
					<td><?php echo $rows->amount; ?></td>
				</tr>
				<?php
			} echo (($pamounts->num_rows() > 0) ? null: "<tr><td colspan='2'>No Records</td></tr>"); ?>

			</tbody>
		</table>
	</div>
</div>
<div class="row-fluid">
	<div class="span4 pull-right">
		<table class="table table-bordered">
		<caption><h5>Summary</h5></caption>
				<tr>
					<td>Opening Balance</td>
					<th><?php echo $supplier->row()->obalance; ?></th>
				</tr>
				<tr>
					<td>Total Purchases</td>
					<th><?php echo $totalP; ?></th>
				</tr>
				<tr>
					<td>Total Payments</td>
					<th><?php echo $totalPP; ?></th>
				</tr>
				<tr>
					<th>Outstanding Balance</th>
					<th><?php echo $netPurchase = $totalP-$totalPP; ?></th>
				</tr>
		</table>
	</div>
</div>