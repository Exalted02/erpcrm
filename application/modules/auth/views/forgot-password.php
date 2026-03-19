<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamstechnologies - Bootstrap Admin Template">
        <title>Forgot Password</title>
		
		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>assets/img/favicon.png">
		
		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">

		<!-- Fontawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/fontawesome.min.css">
    	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome/css/all.min.css">

		<!-- Lineawesome CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/line-awesome.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/material.css">
			
		<!-- Lineawesome CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/line-awesome.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">

    </head>
    <body class="account-page">
	
		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<div class="container">				
					<!-- Account Logo -->
					<div class="account-logo">
						<a href="#"><img src="<?php echo base_url(); ?>assets/img/logo2.png" alt="Dreamguy's Technologies"></a>
					</div>
					<!-- /Account Logo -->
					
					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Forgot Password</h3>
							<?php if(!empty($error)){ ?>
								<div class="alert alert-danger">
									<?= $error ?>
								</div>
							<?php } ?>
							<?php if(!empty($success)){ ?>
								<div class="alert alert-success">
									<?= $success ?>
								</div>
							<?php } ?>
							<!-- Account Form -->
							<form method="post" action="">
								<div class="input-block mb-4">
									<label class="col-form-label">Email Address</label>
									<input class="form-control" type="email" name="email" placeholder="Email" value="<?= set_value('email') ?>" required>
									<span class="text-danger"><?php echo form_error('email'); ?></span>
								</div>
								<div class="input-block mb-4 text-center">
									<button class="btn btn-primary account-btn" type="submit">Submit</button>
								</div>
								<div class="account-footer">
									<p><a href="<?= base_url('login') ?>">Login</a></p>
								</div>
							</form>
							<!-- /Account Form -->
							
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
       <script src="<?php echo base_url(); ?>assets/js/jquery-3.7.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
		
		<!-- Custom JS -->
		<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
		
    </body>
</html>