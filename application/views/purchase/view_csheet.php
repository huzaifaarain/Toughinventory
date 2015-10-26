<div id="container" class="row-fluid">
<?php $this->load->view('sidebar'); ?>
<div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                 <h3 class="page-title">
                     Closing Sheets
                   </h3>
                     <a class="icon-btn span2 green" href="#">
                            <i class="icon-reorder"></i>
                            <div>Daily</div>
                        </a>
                          <a class="icon-btn span2" href="#">
                            <i class="icon-reorder"></i>
                            <div>Monthly</div>
                        </a>
                          <a class="icon-btn span2" href="#">
                            <i class="icon-reorder"></i>
                            <div>Yearly</div>
                        </a>
               </div>
            </div>
        </div>
</div>
</div>
<?php $this->load->view('scripts'); ?>
<script type="text/javascript">
  $(function(){

    $('table').dataTable();

  });
</script>
