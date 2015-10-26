<?php $userDetails = $userDetails->row(); ?>
<div id="container" class="row-fluid">
<?php $this->load->view('sidebar'); ?>
<div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                 <h3 class="page-title">
                    Profile
                   </h3>
                   <?php $this->load->view('msg'); ?>
               </div>
               <form class="form-horizontal" method="post" action="<?php echo current_url(); ?>">
                   <div class="control-group">
                      <label class="control-label">Username</label>
                        <div class="controls">
                          <input type="text" name="username" value="<?php echo $userDetails->username; ?>" placeholder="Username" class="input-xlarge"/>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Email</label>
                        <div class="controls">
                          <input type="email" name="email" value="<?php echo $userDetails->email; ?>" placeholder="Email" class="input-xlarge"/>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">First Name</label>
                        <div class="controls">
                          <input type="text" name="first_name" value="<?php echo $userDetails->first_name; ?>" placeholder="First Name" class="input-xlarge"/>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Last Name</label>
                        <div class="controls">
                          <input type="text" name="last_name" value="<?php echo $userDetails->last_name; ?>" placeholder="Last Name" class="input-xlarge"/>
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