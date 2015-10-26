<?php $customer = $customer->row(); ?>
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
                     Edit Customer
                     <small>Please enter the supplier information below.</small>
                   </h3>
               </div>
               <div class="span12">
                 <form class="form-horizontal" method="post" action="<?php echo current_url(); ?>">
                 <input type="hidden" name="id" value="<?php echo $customer->id; ?>">
                    <div class="control-group">
                      <label class="control-label">Name</label>
                        <div class="controls">
                          <input type="text" name="name" id="name" value="<?php echo $customer->name; ?>" data-placement="right" data-original-title="Name must be unique" placeholder="Name" class="input-xlarge tooltips" required/>
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                      <div class="control-group">
                      <label class="control-label">Email</label>
                        <div class="controls">
                          <input type="text" name="email" id="email" value="<?php echo $customer->email; ?>" data-placement="right" data-original-title="Email must be unique" placeholder="Email" class="input-xlarge tooltips" />
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Phone</label>
                        <div class="controls">
                          <input type="text" name="phone" id="phone" value="<?php echo $customer->phone; ?>" placeholder="Phone" class="input-xlarge" />
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Company</label>
                        <div class="controls">
                          <input type="text" name="company" id="company" value="<?php echo $customer->company; ?>" placeholder="Company" class="input-xlarge" />
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Address</label>
                        <div class="controls">
                          <input type="text" name="address" id="address" value="<?php echo $customer->address; ?>" data-placement="right" data-original-title="Complete address including City & Town" placeholder="Block A - XYZ Town - Hyderabad" class="input-xlarge tooltips" />
                          <!-- <span class="help-inline">Some hint here</span> -->
                      </div>
                    </div>
                      <div class="control-group">
                      <label class="control-label">Opening Balance</label>
                        <div class="controls">
                          <input type="number" name="obalance" id="obalance" value="<?php echo $customer->obalance; ?>" data-placement="right" data-original-title="Opening Balance" placeholder="Opening Balance" class="input-xlarge tooltips" />
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