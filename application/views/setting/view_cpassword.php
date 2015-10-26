<div id="container" class="row-fluid">
<?php $this->load->view('sidebar'); ?>
<div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                 <h3 class="page-title">
                    Change Password
                   </h3>
                   <?php $this->load->view('msg'); ?>
               </div>
               <form class="form-horizontal" method="post" action="<?php echo current_url(); ?>">
                   <div class="control-group">
                      <label class="control-label">Old Password</label>
                        <div class="controls">
                          <input type="password" name="old_password" placeholder="Old Password" class="input-xlarge" required/>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">New Password</label>
                        <div class="controls">
                          <input type="password" name="new_password" placeholder="New Password" class="input-xlarge" required/>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Confirm Password</label>
                        <div class="controls">
                          <input type="password" name="confirm_password" placeholder="Confirm Password" class="input-xlarge" required/>
                      </div>
                    </div>
                      <div class="control-group">
                        <div class="controls">
                          <input type="submit" value="Change" class="btn btn-primary" id="pulsate-hover" />
                      </div>
                    </div>
               </form>
            </div>
        </div>
</div>
</div>
<?php $this->load->view('scripts'); ?>