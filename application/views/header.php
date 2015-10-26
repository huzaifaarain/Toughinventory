<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
   <meta charset="utf-8" />
   <title><?php echo (isset($title) ? $title : null); ?></title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="" name="description" />
   <meta content="" name="author" />
   <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>css/style-responsive.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>css/style-default.css" rel="stylesheet" id="style_color" />
   <link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>assets/fullcalendar/fullcalendar/bootstrap-fullcalendar.css" rel="stylesheet" />
   <link href="<?php echo base_url(); ?>assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/chosen-bootstrap/chosen/chosen.css" />
   <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/jquery-ui/jquery-ui-1.10.1.custom.min.css" />


</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<?php $this->load->view('top_bar'); ?>