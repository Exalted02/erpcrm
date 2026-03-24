		</div>
		<!-- /Main Wrapper -->
		
		<!-- jQuery -->
		<script src="<?php echo base_url(); ?>assets/js/jquery-3.7.1.min.js"></script>
		
		<!-- Bootstrap Core JS -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.bundle.min.js"></script>
		
		<!-- Slimscroll JS -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.slimscroll.min.js"></script>
		
		<!-- Select2 JS -->
		<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
		
		 <!-- Theme Settings JS -->
		<script src="<?php echo base_url(); ?>assets/js/layout.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/theme-settings.js"></script>

		<!-- Custom JS -->
		<script src="<?php echo base_url(); ?>assets/js/app.js"></script>
		
		<!-- Editor JS -->
		<script src="<?php echo base_url(); ?>assets/plugins/ckeditor/ckeditor.js"></script>
		
		<!-- Datatable js -->
		<script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/dataTables.bootstrap4.min.js"></script>
		
		<!-- Toastr CSS & JS -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/toastr.min.css"/>
		<script src="<?php echo base_url(); ?>assets/js/toastr.min.js"></script>
		<script>
			<?php if($this->session->flashdata('success')){ ?>
				toastr_msg("<?php echo $this->session->flashdata('success'); ?>", "success");
			<?php } ?>

			<?php if($this->session->flashdata('error')){ ?>
				toastr_msg("<?php echo $this->session->flashdata('error'); ?>", "error");
			<?php } ?>

			<?php if($this->session->flashdata('info')){ ?>
				toastr_msg("<?php echo $this->session->flashdata('info'); ?>", "info");
			<?php } ?>

			<?php if($this->session->flashdata('warning')){ ?>
				toastr_msg("<?php echo $this->session->flashdata('warning'); ?>", "warning");
			<?php } ?>
			
			function toastr_msg(msg, type){
				toastr.options = {
					"closeButton": true,
					"progressBar": true
				};
				toastr[type](msg);
			}
			
			$(document).ready(function () {
				if (typeof CKEDITOR !== "undefined" && $('#editor1').length > 0) {
					CKEDITOR.replace('editor1', {
						allowedContent: true
					});
				}
			});
		</script>
		
		<?php if(isset($script)){$this->load->view($script);} ?>
    </body>
</html>