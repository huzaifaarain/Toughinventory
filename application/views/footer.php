<!-- BEGIN FOOTER -->
   <div id="footer">
       <?php echo date('Y'); ?> &copy; Tough Logic. <strong>{elapsed_time}</strong>-<strong>{memory_usage}</strong>
<style type="text/css">
	.loader
	{
		background-color: rgba(255, 255, 255, 0.16);
		position: fixed;
		top: 0px;
		left: 0px;
		width: 100%;
		height: 100%;
		z-index: 999999999999;
		display: none;
	}
	.loader-body
	{
		margin-top: calc(50%);
		width: 100px;
		margin: calc(10%) auto 0px auto;
		z-index: 999999999999;
	}
</style>
       <div style="" class="loader">
   	<div class="loader-body">
   	<caption class="text-center">Please wait ...</caption>
   		<img src="<?php echo base_url('img/loader.gif'); ?>">
   	</div>
   </div>
   </div>
   
</body>
</html>