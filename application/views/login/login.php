<?php $details = $this->dbo->viewCDetails()->row();  ?>
<body class="lock">
    <div class="lock-header">
        <!-- BEGIN LOGO -->
        <a class="center" id="logo" href="<?php echo site_url(); ?>">
            <h3>Tough Logic</h3><!-- <img class="center" alt="logo" src="img/logo.png"> -->
        </a>
        <!-- END LOGO -->
        <?php $this->load->view('msg'); ?>
    </div>
    <div class="login-wrap">
        <div class="metro single-size red">
            <div class="locked">
                <i class="icon-lock"></i>
            </div>
        </div>
        <div class="metro double-size green">
            <form action="<?php echo current_url(); ?>" method="post">
                <div class="input-append lock-input">
                    <input type="text" name="username" class="" placeholder="Username" required>
                </div>
        </div>
        <div class="metro double-size yellow">
                <div class="input-append lock-input">
                    <input type="password" name="password" class="" placeholder="Password" required>
                </div>
            
        </div>
        <div class="metro single-size terques login">
                <button type="submit" class="btn login-btn">
                    Login
                    <i class=" icon-long-arrow-right"></i>
                </button>
            </form>
        </div>
        <div class="metro double-size navy-blue">
            <a href="#" class="social-link">
                <!-- <i class="icon-google-plus-sign"></i> -->
                <span>Tough Logic</span><br/>
                Product of Divs & Pixel
            </a>
        </div>
         <div class="metro double-size navy-blue">
            <a href="#" class="social-link text-left">
                <!-- <i class="icon-google-plus-sign"></i> -->
                <span>Contact Us</span><br/>
                Phone : <strong>+92-306-038-3210</strong><br/>
                Skype : <strong>huzaifa.arain</strong><br/>
                Email : <strong>huzaifa.itgroup@gmail.com</strong>
            </a>
        </div>
          <div class="metro double-size navy-blue">
            <a href="#" class="social-link">
                <!-- <i class="icon-google-plus-sign"></i> -->
                <p>This copy of software is issued and licensed to </br>
                Company/Organization : <b><?php echo $details->company_name; ?>.</b></br>
                License Holder : <b><?php echo $details->owner_name; ?>.</b></br>
                All rights Reserved By Divs & Pixel.</p>
            </a>
        </div>
        <div class="login-footer">
            <div class="forgot-hint pull-right">
                <a id="forget-password" class="" href="javascript:;">Forgot Password?</a>
            </div>
        </div>
    </div>
</body>
<!-- END BODY -->
</html>