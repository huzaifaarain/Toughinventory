<?php 

  $cName = null;
  $oName = null;
  $address = null;
  $city = null;
  $contact = null;
  $email = null;
  if ($details->num_rows() > 0) 
  {
    $details = $details->row();
    $cName = $details->company_name;
    $oName = $details->owner_name;
    $address = $details->address;
    $city = $details->city;
    $contact = $details->contact;
    $email = $details->email;
  }

 ?><div id="container" class="row-fluid">
<?php $this->load->view('sidebar'); ?>
<div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                 <h3 class="page-title">
                     Company Details
                   </h3>
               <?php $this->load->view('msg'); ?>
               </div>
               <div class="row-fluid">
                 <form class="form-vertical" method="post" action="<?php echo current_url(); ?>" enctype="multipart/form-data" >
                   <div class="span4">
                  <div class="control-group">
                      <label class="control-label">Company Name</label>
                        <div class="controls">
                          <input type="text" name="company_name" value="<?php echo $cName; ?>" data-placement="right" 
                          data-original-title="Name of your Company" 
                          placeholder="Company Name" class="input-xlarge tooltips" />
                      </div>
                    </div>
               </div>
               <div class="span4">
                  <div class="control-group">
                      <label class="control-label">Owner Name</label>
                        <div class="controls">
                          <input type="text" name="owner_name" value="<?php echo $oName; ?>" placeholder="Owner Name" class="input-xlarge" />
                      </div>
                    </div>
               </div>
               <div class="span4">
                  <div class="control-group">
                      <label class="control-label">Address</label>
                        <div class="controls">
                          <input type="text" name="address" value="<?php echo $address; ?>" placeholder="Address" class="input-xlarge" />
                      </div>
                    </div>
               </div>
               <div class="row-fluid">
               <div class="span4">
                  <div class="control-group">
                      <label class="control-label">City</label>
                        <div class="controls">
                          <input type="text" name="city" value="<?php echo $city; ?>" placeholder="City" class="input-xlarge" />
                      </div>
                    </div>
               </div>
               <div class="span4">
                  <div class="control-group">
                      <label class="control-label">Contact</label>
                        <div class="controls">
                          <input type="text" name="contact" value="<?php echo $contact; ?>" placeholder="City" class="input-xlarge" />
                      </div>
                    </div>
               </div>
               <div class="span4">
                  <div class="control-group">
                      <label class="control-label">Email</label>
                        <div class="controls">
                          <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Email" class="input-xlarge" />
                      </div>
                    </div>
               </div>
               </div>
               <div class="row-fluid">
                 <div class="span12">
                                <div class="control-group">
                                    <label class="control-label">Company Logo</label>
                                    <div class="controls">
                                        <div data-provides="fileupload" class="fileupload fileupload-new">
                                            <div style="width: 200px; height: 150px;" class="fileupload-new thumbnail">
                                                <img alt="" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image">
                                            </div>
                                            <div style="max-width: 200px; max-height: 150px; line-height: 20px;" class="fileupload-preview fileupload-exists thumbnail"></div>
                                            <div>
                                               <span class="btn btn-file"><span class="fileupload-new">Select image</span>
                                               <span class="fileupload-exists">Change</span>
                                               <input type="file" name="logo" class="default"></span>
                                                <a data-dismiss="fileupload" class="btn fileupload-exists" href="#">Remove</a>
                                            </div>
                                        </div>
                                        <span class="label label-important">NOTE!</span>
                                         <span>
                                         Attached image thumbnail is
                                         supported in Latest Firefox, Chrome, Opera,
                                         Safari and Internet Explorer 10 only
                                         </span>
                                    </div>
                                </div>
                 </div>
                 <div class="row-fluid">
                   <div class="span2 pull-right">
                      <div class="control-group">
                        <div class="controls">
                          <input type="submit" value="Update Info" class="btn btn-primary" id="pulsate-hover" />
                      </div>
                    </div>
                   </div>
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

    $('table').dataTable();

  });
</script>
