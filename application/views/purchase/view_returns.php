<div id="container" class="row-fluid">
<?php $this->load->view('sidebar'); ?>
<div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                 <h3 class="page-title">
                    View Purchase Order(s)
                   </h3>
                   <?php $this->load->view('msg'); ?>
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
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Supplier Name</th>
                      <th>Date</th>
                      <th>Reference</th>
                      <th>NOTE</th>
                      <th>Tax %</th>
                      <th>Product(Quantity)</th>
                      <th>Amount</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                </table>
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
                'ajax' : '<?php echo site_url("purchase/ajaxgetreturns?".$_SERVER["QUERY_STRING"]) ?>'
            });

            table.on('draw.dt', function(event) {
              $(".loader").hide();
              /* Act on the event */
            });
      <?php
    } ?>
    
  });
</script>