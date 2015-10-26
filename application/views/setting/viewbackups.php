<div id="container" class="row-fluid">
<?php $this->load->view('sidebar'); ?>
<div id="main-content">
         <!-- BEGIN PAGE CONTAINER-->
         <div class="container-fluid">
            <!-- BEGIN PAGE HEADER-->   
            <div class="row-fluid">
               <div class="span12">
                 <h3 class="page-title">
                    View Backup Files
                   </h3>
                   <?php $this->load->view('msg'); ?>
               </div>
               <a onclick="$('.loader').show();" class="icon-btn span2 green" href="<?php echo site_url('settings/backupDB'); ?>">
                            <i class="icon-reorder"></i>
                            <div>Backup Now</div>
                        </a>
            </div>
            <div class="row-fluid">
              <div class="span12">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>File Name</th>
                    <th>Created On</th>
                    <th>Delete</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                $dir = "./DB_BACKUPS/";
                if (is_dir($dir)) 
                {
                  $files = array_slice(scandir($dir), 2);
                  rsort($files);
                  foreach ($files as $file) 
                  {
                    ?>
                    <tr>
                      <td> <a href="<?php echo base_url($dir.$file); ?>"><?php echo $file; ?></a></td>
                      <td><?php echo date("d-M-Y",filectime($dir.$file)); ?></td>
                      <td><a href="<?php echo site_url('settings/delete_backup/'.$file); ?>">Delete</td>
                    </tr>
                    <?php
                  }
                  if (count($files) == 0) 
                  {
                    ?>
                    <tr><td colspan="3">No Files</td></tr>
                    <?php
                  }
                }

                 ?>
                </tbody>
              </table>
              </div>
            </div>
        </div>
</div>
</div>
<?php $this->load->view('scripts'); ?>