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
                     Add Sale Payment
                     <small>Please enter the information below.</small>
                   </h3>
               </div>
               <div class="span12">
                 <form class="form-horizontal" method="post" action="<?php echo current_url(); ?>">
                    <div class="control-group">
                      <label class="control-label">Customer</label>
                         <div class="controls">
                                    <select name="customer_id" class="span6 chzn-select" data-placeholder="Choose a Category" tabindex="1">
                                        <?php foreach ($customers->result() as $customer) 
                                        {
                                         ?>
                                          <option value="<?php echo $customer->id; ?>"><?php echo $customer->name; ?></option>
                                         <?php
                                        } ?>
                                    </select>
                                </div>
                    </div>
                      <div class="control-group">
                      <label class="control-label">SO Reference(Optional)</label>
                        <div class="controls">
                          <input type="text" name="reference_so" data-placement="right" 
                          data-original-title="SO Reference is an optional field, e.g(Sale Order No - 01010)" 
                          placeholder="SO Reference" class="input-xlarge tooltips" />
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Date</label>
                        <div class="controls">
                          <input type="date" name="date" class="input-xlarge" required/>
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label">Amount</label>
                        <div class="controls">
                          <input type="text" name="amount" data-placement="right" 
                          data-original-title="Amount paying to Supplier" 
                          placeholder="Amount" class="input-xlarge tooltips" required/>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">NOTE(Optional)</label>
                        <div class="controls">
                          <textarea name="note"></textarea>
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                    
                     <div class="control-group">
                        <div class="controls">
                          <input type="submit" value="Submit" class="btn btn-primary" id="pulsate-hover" />
                      </div>
                    </div>
                 </form>
               </div>
            </div>
        </div>
</div>
</div>
<?php $this->load->view('scripts'); ?>
<script type="text/javascript">
  $(function(){
    $(".chzn-select").chosen();
  });
</script>