<div class="row" id="base_url" url="<?=base_url('customers/listing')?>" base-url="<?=base_url()?>">
	<div class="col-md-7 col-sm-12 col-xs-12" style="padding-left:10px; padding-right: 10px;">
		<div class="x_panel">
			<div class="x_title">
				<h2>Customers</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#"><i class="fa fa-wrench"></i></a>
					</li>
					<li class="dropdown hidden-lg add-btn">
						<a href="#"><i class="fa fa-plus"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row">
					<div class="col-lg-3 col-xs-12 col-sm-12 hidden-md hidden-sm hidden-xs">
						<button type="button" class="btn btn-primary add-btn">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Customer
						</button>
					</div>
					<div class="input-group col-lg-3 col-lg-offset-3 col-md-12 col-xs-12 col-sm-12 pull-right">
						<form class="form-inline" method="post" action="<?=base_url('customers/search')?>">
							<div class="form-group top_search">
								<div class="input-group">
									<input type="text" name="search_" class="form-control" id="search_customer" placeholder="Search customer...">
									<span class="input-group-btn">
										<button class="btn btn-default" type="submit">Go!</button>
									</span>
								</div>
							</div>
							<input type="submit" class="hidden"/>
						</form>
					</div><!-- /input-group -->
				</div>
				<div class="row" id="curr_page" page="<?= $page['curr_page'] ?>">
					<a id="dummy_list_item" href="#" customer_id="" class="hidden list-group-item customers"><table><td id="dummy-cust-id"></td><td>&nbsp;|&nbsp;</td><td id="dummy-cust-name"></td></table></a>
					<div class="list-group" id="customer_list" get-url="<?=base_url('customers/get_customer')?>">
						<?php
							foreach($data['customers'] as $customer){
								if(!$customer['deleted_at']){
									echo '<a href="#" customer_id="'.$customer['id'].'" class="list-group-item customers"><table><tr><td>'.$customer['customer_id'].'</td><td>&nbsp;|&nbsp;</td><td>'.$customer['firstname'].' '.$customer['lastname'].'</td></tr></table></a>';
								}else{
									echo '<a href="#" customer_id="'.$customer['id'].'" class="list-group-item customers list-group-item-danger"><table><tr><td>'.$customer['customer_id'].'</td><td>&nbsp;|&nbsp;</td><td>'.$customer['firstname'].' '.$customer['lastname'].'</td></tr></table></a>';
								}
							}
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-6 col-xs-6">
						<div class="btn-group hidden-sm hidden-xs hidden-md" role="group" aria-label="...">
							<button type="button" id="btn-update" class="disabled btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update
							</button>
							<a base-url="<?=base_url('customers/delete_customer/')?>" href="#" id="btn-delete" class="disabled btn btn-dark btn-sm">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
							</a>
						</div>
						<div class="btn-group hidden-lg btn-group-xs" role="group" aria-label="...">
							<button type="button" id="btn-update" class="disabled btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
							</button>
							<a base-url="<?=base_url('customers/delete_customer/')?>" href="#" id="btn-delete" class="disabled btn btn-dark btn-sm">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
							</a>
						</div>
					</div>
					<div class="col-md-5 col-md-offset-4 col-sm-6 col-xs-6">
						<div class="btn-group pull-right hidden-sm hidden-xs hidden-md" role="group" aria-label="...">
							<a href="<?= base_url('customers/listing/'.($page['curr_page']-1)) ?>" class="<?= ($page['status']['prev']==0) ? 'disabled' : '' ?> btn btn-default btn-sm">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Prev
							</a>
							<a href="<?= base_url('customers/listing/'.($page['curr_page']+1)) ?>" class="<?= ($page['status']['next']==0) ? 'disabled' : '' ?> btn btn-default btn-sm">
								Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> 
							</a>
						</div>
						<div class="btn-group pull-right hidden-lg btn-group-xs" role="group" aria-label="...">
							<a href="<?= base_url('customers/listing/'.($page['curr_page']-1)) ?>" class="<?= ($page['status']['prev']==0) ? 'disabled' : '' ?> btn btn-default btn-sm">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							</a>
							<a href="<?= base_url('customers/listing/'.($page['curr_page']+1)) ?>" class="<?= ($page['status']['next']==0) ? 'disabled' : '' ?> btn btn-default btn-sm">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> 
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-5 col-sm-12 col-xs-12" style="padding-left: 10px; padding-right: 10px;">
		<div class="x_panel">
			<div class="x_title">
				<h2>Information</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row">
					<div class="col-md-offset-4 col-md-4 col-xs-12 col-sm-12 thumbnail" style="height:148px;">
						<a href="#">
							<img id="display_picture" source="<?=base_url('assets/images/')?>" alt="..." style="height:148px; width:156px;">
						</a>
					</div>
					<div class="col-md-12">
						<center>
							<h4><span id="customer_id">Please select customer...</span></h4>
						</center>
						<table class="table">
							<tr>
								<td width="30%"><b>Firstname:</b></td>
								<td id="firstname"></td>
							</tr>
							<tr>
								<td><b>Middlename:</b></td>
								<td id="middlename"></td>
							</tr>
							<tr>
								<td><b>Lastname:</b></td>
								<td id="lastname"></td>
							</tr>
							<tr>
								<td><b>Mobile Number:</b></td>
								<td id="mobilenumber"></td>
							</tr>
							<tr>
								<td><b>Address:</b></td>
								<td id="address"></td>
							</tr>
							<tr>
								<td><b>Registered:</b></td>
								<td id="registered"></td>
							</tr>
							<tr>
								<td><b>Guarantor Name:</b></td>
								<td id="guarantor_name"></td>
							</tr>
							<tr>
								<td><b>Status:</b></td>
								<td id="deleted_at"></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>

<div class="row">
	<div class="col-md-12 col-sm-12 col-xs-12" style="padding-left: 10px; padding-right: 10px;">
		<div class="x_panel">
			<div class="x_title">
				<h2>Account Overview</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<a href="#" class="thumbnail">
							<img src="" alt="...">
						</a>
					</div>
					<div class="col-md-12">
						<table class="table">
							<tr>
								<td width="35%"><b>Customer ID:</b></td>
								<td>asd</td>
							</tr>
							<tr>
								<td><b>Firstname:</b></td>
								<td>asd</td>
							</tr>
							<tr>
								<td><b>Middlename:</b></td>
								<td>asd</td>
							</tr>
							<tr>
								<td><b>Lastname:</b></td>
								<td>asd</td>
							</tr>
							<tr>
								<td><b>Mobile Number:</b></td>
								<td>asd</td>
							</tr>
							<tr>
								<td><b>Address:</b></td>
								<td>asd</td>
							</tr>
							<tr>
								<td><b>Registered:</b></td>
								<td>asd</td>
							</tr>
							<tr>
								<td><b>Guarantor Name:</b></td>
								<td>asd</td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Modal title</h4>
			</div>
			<div class="modal-body">
				<form id="form_customer" add-url="<?=base_url('customers/add_customer')?>" update-url="<?=base_url('customers/update_customer')?>" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label class="control-label" for="in_firstname">Firstname</label> <i><span class="control-label errhandler" errhandler="firstname"></span></i>
						<input type="text" name="firstname" class="form-control" id="in_firstname" placeholder="Firstname">
					</div>
					<div class="form-group">
						<label class="control-label" for="in_middlename">Middlename</label> <i><span class="control-label errhandler" errhandler="middlename"></span></i>
						<input type="text" name="middlename" class="form-control" id="in_middlename" placeholder="Middlename">
					</div>
					<div class="form-group">
						<label class="control-label" for="in_lastname">Lastname</label> <i><span class="control-label errhandler" errhandler="lastname"></span></i>
						<input type="text" name="lastname" class="form-control" id="in_lastname" placeholder="Lastname">
					</div>
					<div class="form-group">
						<label class="control-label" for="in_mobilenumber">Mobile Number</label> <i><span class="control-label errhandler" errhandler="mobilenumber"></span></i>
						<input type="text" name="mobilenumber" class="form-control" id="in_mobilenumber" placeholder="Mobile Number">
					</div>
					<div class="form-group">
						<label class="control-label" for="in_address">Address</label> <i><span class="control-label errhandler" errhandler="address"></span></i>
						<input type="text" name="address" class="form-control" id="in_address" placeholder="Address">
					</div>
					<div class="form-group">
						<label class="control-label" for="in_guarantor">Guarantor</label>
						<select class="form-control" id="in_guarantor" name="guarantor_customers_id">
							<option value="0" selected="selected"></option>
							<?php
								foreach($data['customers'] as $customer){
									echo '<option value="'.$customer['id'].'"><table><tr><td>'.$customer['customer_id'].'</td><td>&nbsp;|&nbsp;</td><td>'.$customer['firstname'].' '.$customer['lastname'].'</td></tr></table></option>';
								}
							?>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label" for="dp">Display Picture</label> <i><span class="control-label errhandler" errhandler="dp"></span></i>
						<input type="file" name="dp" id="dp">
						<p class="help-block">Max dimension: 1024x768 px | Max filesize: 2MB | Accepts only: jpeg,png,jpg</p>
					</div>
					<input type="hidden" value="" name="id"/>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success pull-left">Save</button>
				</form>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>