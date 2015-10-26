<div id="container" class="row-fluid">
<?php $this->load->view('sidebar'); ?>
<div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
               <?php $this->load->view('msg'); ?>
                 <h3 class="page-title">
                     View Suppliers
                   </h3>
                  <div class="widget green">
                    <div class="widget-title">
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                    </div>
                   <div class="widget-body">
                   <table class="table table-striped table-bordered ">
                     <thead>
                       <tr>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Company</th>
                         <th>Address</th>
                         <th>Phone</th>
                         <th>Email</th>
                         <th>Opening Balance</th>
                         <th>Actions</th>
                       </tr>
                     </thead>
                      <tfoot>
                       <tr>
                         <th>ID</th>
                         <th>Name</th>
                         <th>Company</th>
                         <th>Address</th>
                         <th>Phone</th>
                         <th>Email</th>
                         <th>Opening Balance</th>
                         <th>Actions</th>
                       </tr>
                     </tfoot>
                   </table>
                    </div> 
                  </div>
               </div>
            </div>
        </div>
</div>
</div>
<?php $this->load->view('scripts'); ?>
<script type="text/javascript">
  $(function(){

    $('table').dataTable({
        'processing' : true,
        'displayStart' : 100,
        'ajax' : '<?php echo site_url("purchase/ajaxgetsuppliers") ?>'
    });

  });
</script>
