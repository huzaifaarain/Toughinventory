 <!-- BEGIN JAVASCRIPTS -->
   <!-- Load javascripts at bottom, this will reduce page load time -->
   <script src="<?php echo base_url(); ?>js/jquery-1.8.3.min.js"></script>
   <script src="<?php echo base_url(); ?>js/jquery.nicescroll.js" type="text/javascript"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-slimscroll/jquery-ui-1.9.2.custom.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/jquery-slimscroll/jquery.slimscroll.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>

   <!-- ie8 fixes -->
   <!--[if lt IE 9]>
   <script src="js/excanvas.js"></script>
   <script src="js/respond.js"></script>
   <![endif]-->

   <script src="<?php echo base_url(); ?>js/jquery.sparkline.js" type="text/javascript"></script>
   <script src="<?php echo base_url(); ?>js/jquery.scrollTo.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>js/jquery.pulsate.min.js"></script>
   <script src="<?php echo base_url(); ?>js/pulstate.js" type="text/javascript"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/jquery.dataTables.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/data-tables/DT_bootstrap.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script src="<?php echo base_url(); ?>assets/fullcalendar/fullcalendar/fullcalendar.min.js"></script>
   <script src="<?php echo base_url(); ?>js/home-page-calender.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap-fileupload.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/highchart/highcharts.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/highchart/highcharts-3d.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/highchart/highcharts-more.js"></script>
   <script type="text/javascript" src="<?php echo base_url(); ?>js/clock.js"></script>

   
   <script type="text/javascript" src="<?php echo base_url(); ?>assets/tinymce/tinymce.min.js"></script>

   <!--common script for all pages-->
   <script src="<?php echo base_url(); ?>js/common-scripts.js"></script>
   <script type="text/javascript">
    $(function(){
        $(".chzn-select").chosen();

       tinymce.init({
    selector: "textarea.tEditor",
    theme: "modern",
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
         "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
         "save table contextmenu directionality emoticons template paste textcolor"
   ],
   content_css: "css/content.css",
   toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | l      ink image | print preview media fullpage | forecolor backcolor emoticons", 
   style_formats: [
        {title: 'Bold text', inline: 'b'},
        {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
        {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
        {title: 'Example 1', inline: 'span', classes: 'example1'},
        {title: 'Example 2', inline: 'span', classes: 'example2'},
        {title: 'Table styles'},
        {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
    ]
 }); 

    });

    function deleteArrayItem(value,array)
    {
        try
        {
            var i = array.indexOf(value);
            if(i != -1) {
            array.splice(i, 1);
            }

        }catch(e)
        {
            alert(e.message);
        }
    }

   function btnDelete() 
   {
      var c = confirm("Are you sure");
      if (!c) 
      {
        event.preventDefault();
        return false;
      }
   }

   function windowOpen (url) 
   {
     var w = (Math.max(document.documentElement.clientWidth, window.innerWidth || 0) / 4) * 3;
     window.open(url,'_blank','toolbar=no,top=0, left=200, width='+w+', height=500,menubar=no,scrollbars=yes,resizable=yes');
     return false;
   }
   </script> 