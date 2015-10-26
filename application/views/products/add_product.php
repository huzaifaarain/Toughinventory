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
                     Add Product
                     <small>Please enter the product information below.</small>
                   </h3>
               </div>
               <div class="span12">
                 <form class="form-horizontal" method="post" action="<?php echo current_url(); ?>">
                    <div class="control-group">
                      <label class="control-label">Product Name</label>
                        <div class="controls">
                          <input type="text" name="name" id="name" data-placement="right" data-original-title="Product name must be unique" placeholder="Product Name" class="input-xlarge tooltips" required/>
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                      <div class="control-group">
                      <label class="control-label">Product UNIT</label>
                        <div class="controls">
                          <input type="text" name="unit" id="unit" data-placement="right" data-original-title="UNIT of product e.g(CTN as Cartan)" placeholder="Product UNIT" class="input-xlarge tooltips" />
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Product Size</label>
                        <div class="controls">
                          <input type="text" name="size" id="size" data-placement="right" data-original-title="Size e.g( 12 X 1 = 12 Pieces in 1 CTN )" placeholder="Product Size" class="input-xlarge tooltips" />
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Product Cost</label>
                        <div class="controls">
                          <input type="text" name="cost" id="cost" data-placement="right" data-original-title="Purchase Price" placeholder="Product Cost" class="input-xlarge tooltips" required/>
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Product Price</label>
                        <div class="controls">
                          <input type="text" name="price" id="price" data-placement="right" data-original-title="Selling Price" placeholder="Product Price" class="input-xlarge tooltips" required/>
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label">Alert Quantity</label>
                        <div class="controls">
                          <input type="number" name="alert_quantity" id="alert_quantity" data-placement="right" data-original-title="Alert Quantity " placeholder="Alert Quantity" class="input-xlarge tooltips"/>
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label">Opening Stock(Quantity)</label>
                        <div class="controls">
                          <input type="number" name="ostockq" id="ostockq" data-placement="right" data-original-title="Opening Stock" placeholder="Opening Stock" class="input-xlarge tooltips" />
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label">Opening Stock(Amount)</label>
                        <div class="controls">
                          <input type="number" name="ostockamount" id="ostockamount" data-placement="right" data-original-title="Opening Stock Amount" placeholder="Opening Stock Amount" class="input-xlarge tooltips"/>
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