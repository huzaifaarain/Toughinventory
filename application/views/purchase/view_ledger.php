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
                     Supplier Ledger
                   </h3>
                  <div class="widget green">
                    <div class="widget-title">
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                    </div>
                   <div class="widget-body">
                      <form class="form-vertical" method="get" accept="<?php echo current_url(); ?>">
                        <div class="row-fluid">
                            <div class="control-group">
                              <label class="control-label">Supplier</label>
                                 <div class="controls">
                                            <select name="supplier_id" class="span6 chzn-select" tabindex="1">
                                                <option value="all">All Suppliers</option>
                                                <?php foreach ($suppliers->result() as $supplier) 
                                                {
                                                 ?>
                                                  <option value="<?php echo $supplier->id; ?>"><?php echo $supplier->name; ?></option>
                                                 <?php
                                                } ?>
                                            </select>
                                        </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">Start Date</label>
                                <div class="controls">
                                  <input type="date" name="from" />
                                  <!-- <span class="help-inline">Some hint here</span> -->
                              </div>
                            </div>
                            <div class="control-group">
                              <label class="control-label">End Date</label>
                                <div class="controls">
                                  <input type="date" name="to" />
                                  <!-- <span class="help-inline">Some hint here</span> -->
                              </div>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                  <input type="submit" value="Submit" class="btn btn-primary" />
                                  <!-- <span class="help-inline">Some hint here</span> -->
                              </div>
                            </div>
                        </div>
                      </form> 
                    </div> 
                  </div>
               </div>
            </div>
        </div>
</div>
</div>
<?php $this->load->view('scripts'); ?>