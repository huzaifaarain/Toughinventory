<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title><?php echo (isset($title) ? $title : null); ?> -Tough Logic-</title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <style type="text/css">
   * 
   {
      font-size: 12px !important;
   }
   </style>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body>
<?php $header = $this->dbo->viewCDetails()->row();//$this->dbo->rp_getSetting('header'); ?>
<div class="row-fluid">
	<div class="span12">
		<?php //echo (isset($header->header) ? $header->header : null); ?>
    <!--   <table style="margin:0px auto;">
         <tbody>
            <tr>
               <td>
                  <p></p>
               </td>
               <td style="" colspan="3">
                  
               </td>
            </tr>
            <tr>
               <td>&nbsp;Address :&nbsp;</td>
               <td>Contact :&nbsp;</td>
               <td>Email -&nbsp;</td>
            </tr>
         </tbody>
      </table> -->
      <table cellspacing="10" style="margin:0px auto;">
         <tbody>
         <tr>
            <td rowspan="4">
            <?php 
               $dir = "./clogo/";
               $files = array_slice(scandir($dir), 2); 
               if (count($files) > 0) 
               {
                  ?>
                  <img style="width:260px;height:120px" src="<?php echo base_url($dir.$files[0]); ?>">
                  <?php
               }
               ?>
               </td>
            <td colspan="2"><h4 style="font-size: 28px !important;text-align: center;"><?php echo $header->company_name; ?></h4></td>
         </tr>
         <tr>
            <td>Address</td>
            <td><strong><?php echo $header->address; ?></strong></td>
         </tr>
         <tr>
            <td>Contact</td>
            <td><strong><?php echo $header->contact; ?></strong></td>
         </tr>
         <tr>
            <td>Email</td>
            <td><strong><?php echo $header->email; ?></strong></td>
         </tr>
         </tbody>
      </table>
      <hr />
	</div>
</div>
