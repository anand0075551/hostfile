<!DOCTYPE html>
<html class="bg-white">
    <head>
        <meta charset="UTF-8">    
        <title><?php if(isset($title)) echo $title.' | '; ?> Chaitanya Foundations </title>		
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        <link href="<?php echo base_url('assets/admin'); ?>/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-blue">

        <div class="form-box" id="login-box">
            <!-- <div class="header"><i class="fa  fa-sign-in"></i> Consumer1st Sign In</div>-->
			  <div class="header"><i class="fa  fa-group"></i> Chaitanya Foundations Sign In</div>
            <?php echo form_open(); ?>
                <div class="body bg-gray">
                    <div class="form-group">
                        <?php echo flash_msg(); ?>
                        <?php if($this->session->flashdata('loggedIn_fail')){ ?>
                        <div class="alert alert-danger alert-dismissable">
                            <i class="fa fa-ban"></i>
                            <button class="close" aria-hidden="true" data-dismiss="alert" type="button">×</button>
                            <b>Alert!</b> <?php echo $this->session->flashdata('loggedIn_fail'); ?>
                        </div>
                        <?php } ?>

                        <?php if(validation_errors()){
                            echo '<div class="alert alert-danger" style="margin-left: 0;"> '.validation_errors().' </div>';
                        } ?>
<a href="<?php echo base_url('welcome/registerUser_chaitanya') ?>" class="text-center"><i class="fa fa-plus-square-o"></i> Register with Chaitanya Foundations  </a>
					<br><br>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-send-o"></i> </div>
                            <input type="email" name="email" class="form-control" placeholder="Email"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-addon"><i class="fa fa-unlock"></i> </div>
                            <input type="password" name="password" class="form-control" placeholder="Password"/>
                        </div>
                    </div>
                </div>
				<div class="body bg-gray">
                <div class="footer">
                    <button type="submit" class="btn bg-olive btn-block" name="submitBtn" value="submitBtn"><i class="fa  fa-sign-in"></i> Sign me in</button>

                   <!-- <p><a href="#"><i class="fa fa-info-circle"></i> I forgot my password</a></p>-->
						
                    <a href="<?php echo base_url('welcome/forgotPassword') ?>" class="text-center"><i class="fa fa-question"></i> Forgot Password ?</a> <br />
                    	
                </div>
				</div>
            </form>

        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>

    </body>
</html>
