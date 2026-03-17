<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark"  data-sidebar-size="lg" data-sidebar-image="none">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamstechnologies - Bootstrap Admin Template">
        <title>Dashboard - HRMS admin template</title>
		
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
		
		<!-- Chart CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/morris/morris.css">
		
		<!-- Select2 CSS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/select2.min.css">
		
		<!-- Main CSS -->
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	
    </head>
    <body>

		<!-- Main Wrapper -->
        <div class="main-wrapper">
		
			<!-- Header -->
            <div class="header">
			
				<!-- Logo -->
                <div class="header-left">
                    <a href="admin-dashboard.html" class="logo">
						<img src="<?php echo base_url(); ?>assets/img/logo2.png" alt="Logo">
					</a>
					<a href="admin-dashboard.html" class="logo collapse-logo">
						<img src="<?php echo base_url(); ?>assets/img/logo2.png" alt="Logo">
					</a>
					<a href="admin-dashboard.html" class="logo2">
						<img src="<?php echo base_url(); ?>assets/img/logo2.png" width="40" height="40" alt="Logo">
					</a>
                </div>
				<!-- /Logo -->
				
				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>
				
				<!-- Header Title -->
                <div class="page-title-box">
					<h3>Easy Skool</h3>
                </div>
				<!-- /Header Title -->
				
				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa-solid fa-bars"></i></a>
				
				<!-- Header Menu -->
				<ul class="nav user-menu">
					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<span class="user-img"><img src="<?php echo base_url(); ?>assets/img/avatar/avatar-27.jpg" alt="User Image">
							<span class="status online"></span></span>
							<span>Admin</span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="profile.html">My Profile</a>
							<a class="dropdown-item" href="settings.html">Settings</a>
							<a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
						</div>
					</li>
				</ul>
				<!-- /Header Menu -->
				
				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="profile.html">My Profile</a>
						<a class="dropdown-item" href="settings.html">Settings</a>
						<a class="dropdown-item" href="<?= base_url('logout') ?>">Logout</a>
					</div>
				</div>
				<!-- /Mobile Menu -->
				
            </div>
			<!-- /Header -->
			