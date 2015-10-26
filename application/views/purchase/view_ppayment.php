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
                     View Purchase Payments
                   </h3>
                </div>
             </div>
             <div class="row-fluid">
              <div class="span12">
                  <form class="form-vertical" method="get">
                       <div class="row-fluid">
                                    <div class="span1">
                                        <div class="control-group">
                                            <div class="controls controls-row">
                                                <input type="text" name="id" class="input-block-level" placeholder="ID">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span3">
                                        <div class="control-group">
                                             <div class="controls">
                                                        <select name="supplier_id" class="chzn-select" tabindex="1">
                                                            <option value="">Choose a Account`</option>
                                                            <?php foreach ($Suppliers->result() as $Supplier) 
                                                            {
                                                             ?>
                                                              <option value="<?php echo $Supplier->id; ?>"><?php echo $Supplier->name; ?></option>
                                                             <?php
                                                            } ?>
                                                        </select>
                                                    </div>
                                        </div>
                                    </div>
                                    <div class="span2">
                                        <div class="control-group">
                                            <div class="controls controls-row">
                                                <input type="date" name="start_date" class="input-block-level" placeholder="Start Date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span2">
                                        <div class="control-group">
                                            <div class="controls controls-row">
                                                <input type="date" name="end_date" class="input-block-level" placeholder="End Date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="span2">
                                        <div class="control-group">
                                            <div class="controls controls-row">
                                                <input type="submit" value="Submit" class="btn btn-primary">
                                            </div>
                                        </div>
                                    </div>
                        </div>
                      </form>
              </div>
            </div>
            <div class="row-fluid">
              <div class="span12">
            
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
                         <th>Supplier</th>
                         <th>PO Reference</th>
                         <th>Date</th>
                         <th>Amount</th>
                         <th>Note</th>
                         <th>Actions</th>
                       </tr>
                     </thead>
                     <tfoot>
                       <tr>
                         <th>ID</th>
                         <th>Supplier</th>
                         <th>PO Reference</th>
                         <th>Date</th>
                         <th>Amount</th>
                         <th>Note</th>
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
      <?php if ($_GET) 
    {
      ?>
        $(".loader").show();
        var table = $('table').dataTable({
                'processing' : true,
                'displayStart' : 100,
                'serverSide' : false,
                'ajax' : '<?php echo site_url("purchase/ajaxgetppayments?".$_SERVER["QUERY_STRING"]) ?>'
            });

            table.on('draw.dt', function(event) {
              $(".loader").hide();
              /* Act on the event */
            });
      <?php
    } ?>

  });
</script>
