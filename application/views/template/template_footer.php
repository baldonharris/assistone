				</div>
				
			</div>
			<!-- /page content -->

		</div>

	</div>

	<div id="custom_notifications" class="custom-notifications dsp_none">
		<ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
		</ul>
		<div class="clearfix"></div>
		<div id="notif-group" class="tabbed_notifications"></div>
	</div>

	<script src="<?=base_url()?>assets/js/bootstrap.min.js"></script>
	<script src="<?=base_url()?>assets/js/jqueryform.js"></script>
	<script src="<?=base_url()?>assets/js/input_mask/jquery.inputmask.js"></script>
	<script src="<?=base_url()?>assets/js/autocomplete/jquery.autocomplete.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/moment/moment.min.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/datepicker/daterangepicker.js"></script>
	<script type="text/javascript" src="<?=base_url()?>assets/js/notify/pnotify.custom.min.js"></script>
	<script src="<?=base_url()?>assets/js/progressbar/bootstrap-progressbar.min.js"></script>
	<script src="<?=base_url()?>assets/js/nicescroll/jquery.nicescroll.min.js"></script>
	<script src="<?=base_url()?>assets/js/custom.js"></script>
	<?php for($x=0; $x<count($js); $x++) echo '<script src="'.base_url().'assets/js/'.$js[$x].'"></script>'; ?>
	<script>NProgress.done();</script>
	<!-- /footer content -->
</body>

</html>