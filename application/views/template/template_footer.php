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

	<div class="modal fade" id="add_admin" tabindex="-1" role="dialog" aria-labelledby="add_admin" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="admin_modal_label">Add Admin</h4>
				</div>
				<div class="modal-body">
					<input type="hidden" id="sess_fn" value="<?=$this->session->userdata('fullname')?>"/>
					<input type="hidden" id="sess_us" value="<?=$this->session->userdata('username')?>"/>
					<form id="form_add_admin" add-url="<?=base_url('account/add_admin')?>" update-url="<?=base_url('account/update_admin')?>" method="post" enctype="multipart/form-data">
						<div class="form-group">
							<label class="control-label" for="in_fullname">Fullname</label> <i><span class="control-label errhandler" errhandler="fullname"></span></i>
							<input type="text" name="fullname" class="form-control" id="in_fullname" placeholder="Fullname">
						</div>
						<div class="form-group">
							<label class="control-label" for="in_username">Username</label> <i><span class="control-label errhandler" errhandler="username"></span></i>
							<input type="text" name="username" class="form-control" id="in_username" placeholder="Username">
						</div>
						<div class="form-group">
							<label class="control-label" for="in_password">Password</label> <i><span class="control-label errhandler" errhandler="password"></span></i>
							<input type="password" name="password" class="form-control" id="in_password" placeholder="Password">
						</div>
						<div class="form-group">
							<label class="control-label" for="dp">Display Picture</label> <i><span class="control-label errhandler" errhandler="dp"></span></i>
							<input type="file" name="dp" id="dp">
							<p class="help-block">Max dimension: 1024x768 px | Max filesize: 2MB | Accepts only: jpeg,png,jpg</p>
						</div>
						<input type="hidden" value="<?=$this->session->userdata('id')?>" name="id"/>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-success pull-left">Save</button>
					</form>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
				</div>
			</div>
		</div>
	</div>

	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/jqueryform.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/input_mask/jquery.inputmask.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/autocomplete/jquery.autocomplete.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/moment/moment.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/datepicker/daterangepicker.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/notify/pnotify.custom.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/progressbar/bootstrap-progressbar.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/nicescroll/jquery.nicescroll.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/custom.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/bootstrap-editable.min.js')?>"></script>
	<script type="text/javascript" src="<?=base_url('assets/js/jquery.number.min.js')?>"></script>
    <script type="text/javascript" src="<?=base_url('assets/js/maskmoney/src/jquery.maskMoney.js')?>"></script>
	<?php for($x=0; $x<count($js); $x++) echo '<script type="text/javascript" src="'.base_url().'assets/js/customs/'.$js[$x].'"></script>'; ?>
    <script type="text/javascript" src="<?=base_url('assets/js/customs/global.js')?>"></script>
	<script>NProgress.done();</script>
	<!-- /footer content -->
</body>

</html>