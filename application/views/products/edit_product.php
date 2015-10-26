<?php $product = $product->row(); ?>
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
                     Edit Product
                     <small>Please update the product information below.</small>
                   </h3>
               </div>
               <div class="span12">
                 <form class="form-horizontal" method="post" action="<?php echo current_url(); ?>">
                 <input type="hidden" name="id" value="<?php echo $product->id; ?>">
                    <div class="control-group">
                      <label class="control-label">Product Name</label>
                        <div class="controls">
                          <input type="text" name="name" id="name" value="<?php echo $product->name; ?>" data-placement="right" data-original-title="Product name must be unique" placeholder="Product Name" class="input-xlarge tooltips" required/>
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                      <div class="control-group">
                      <label class="control-label">Product UNIT</label>
                        <div class="controls">
                          <input type="text" name="unit" id="unit" value="<?php echo $product->unit; ?>" data-placement="right" data-original-title="UNIT of product e.g(CTN as Cartan)" placeholder="Product UNIT" class="input-xlarge tooltips" required/>
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Product Size</label>
                        <div class="controls">
                          <input type="text" name="size" id="size" value="<?php echo $product->size; ?>" data-placement="right" data-original-title="Size e.g( 12 X 1 = 12 Pieces in 1 CTN )" placeholder="Product Size" class="input-xlarge tooltips" />
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Product Cost</label>
                        <div class="controls">
                          <input type="text" name="cost" id="cost" value="<?php echo $product->cost; ?>" data-placement="right" data-original-title="Purchase Price" placeholder="Product Cost" class="input-xlarge tooltips" required/>
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Product Price</label>
                        <div class="controls">
                          <input type="text" name="price" id="price" value="<?php echo $product->price; ?>" data-placement="right" data-original-title="Selling Price" placeholder="Product Price" class="input-xlarge tooltips" required/>
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label">Alert Quantity</label>
                        <div class="controls">
                          <input type="text" name="alert_quantity" id="alert_quantity" value="<?php echo $product->alert_quantity; ?>" data-placement="right" data-original-title="Selling Price" placeholder="Product Price" class="input-xlarge tooltips" required/>
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                     <div class="control-group">
                      <label class="control-label">Opening Stock(Quantity)</label>
                        <div class="controls">
                          <input type="number" name="ostockq" id="ostockq" value="<?php echo $product->ostockq; ?>" data-placement="right" data-original-title="Opening Stock" placeholder="Opening Stock" class="input-xlarge tooltips" />
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Opening Stock(Amount)</label>
                        <div class="controls">
                          <input type="number" name="ostockamount" id="ostockamount" value="<?php echo $product->ostockamount; ?>" data-placement="right" data-original-title="Opening Stock Amount" placeholder="Opening Stock Amount" class="input-xlarge tooltips"/>
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