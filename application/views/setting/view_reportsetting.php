<?php $row = $this->dbo->rp_getSetting('*'); ?>
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
                   Report Setting
                   </h3>
                  <div class="widget green">
                    <div class="widget-title">
                           <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                           </span>
                    </div>
                   <div class="widget-body">
                    <form class="form-horizontal" method="post" action="<?php echo current_url(); ?>">
                    <div class="control-group">
                      <label class="control-label">Header</label>
                        <div class="controls">
                          <textarea name="header" class="tEditor">
                            <?php echo (isset($row->header) ? $row->header : null ); ?>
                          </textarea>
                      </div>
                    </div>
                    <div class="control-group">
                      <label class="control-label">Footer</label>
                        <div class="controls">
                          <textarea name="footer" class="tEditor">
                            <?php echo (isset($row->footer) ? $row->footer : null ); ?>
                          </textarea>
                      </div>
                    </div>
                    <div class="control-group">
                    <div class="controls">
                      <input type="submit" value="Submit" class="btn btn-info">
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
