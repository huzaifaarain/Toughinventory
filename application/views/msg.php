 <?php $flash = $this->session->flashdata('msg'); 
if ($flash) 
{?>
 <div class="alert alert-block alert-info fade in">
		<button data-dismiss="alert" class="close" type="button">×</button>
	<div class="panel">
		<h4 class="alert-heading">Message !</h4>
		<p>
			<?php echo $flash; ?>
		</p>
	</div>
</div>
<?php } ?>