<div class="row">
	<div class="col-md-3 col-sm-12 col-xs-12" style="padding-left:10px; padding-right: 10px;">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">Customers</h3>
			</div>
			<div class="panel-body">
				<center><div class="btn-group" role="group" aria-label="...">
					<button type="button" class="btn btn-success btn-sm" id="btn-add" data-toggle="modal" data-target="#myModal">
						<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add
					</button>
					<button type="button" class="btn btn-info btn-sm">
						<span class="glyphicon glyphicon-search" aria-hidden="true"></span> Search
					</button>
				</div></center><br/>
				<div class="list-group" get-url="<?=base_url('customers/get_customer')?>">
					<?php
						foreach($data['customers'] as $customer){
							echo '<a href="#" customer_id="'.$customer['id'].'" class="list-group-item customers"><table><tr><td>'.$customer['customer_id'].'</td><td>&nbsp;|&nbsp;</td><td>'.$customer['firstname'].' '.$customer['lastname'].'</td></tr></table></a>';
						}
					?>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-9 col-sm-12 col-xs-12" style="padding-left: 10px; padding-right: 10px;">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">
					<h3 class="panel-title">Information</h3>
				</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-offset-4 col-md-4 col-xs-12 col-sm-12 thumbnail" style="height:210px;">
						<a href="#">
							<img id="display_picture" source="<?=base_url('assets/images/')?>" alt="..." style="height:200px; width:200px;">
						</a>
					</div>
					<div class="col-md-12">
						<center><span id="please">Please select customer......</span></center>
						<table class="table">
							<tr>
								<td width="35%"><b>Customer ID:</b></td>
								<td id="customer_id"></td>
							</tr>
							<tr>
								<td><b>Firstname:</b></td>
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
						</table>
					</div>
				</div>
				<div class="row">
					<center><div class="btn-group" role="group" aria-label="...">
						<button type="button" id="btn-update" class="disabled btn btn-warning btn-sm" data-toggle="modal" data-target="#myModal">
							<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Update
						</button>
						<button type="button" id="btn-delete" class="disabled btn btn-danger btn-sm">
							<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Delete
						</button>
					</div></center>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-9 col-md-offset-3 col-sm-12 col-xs-12" style="padding-left: 10px; padding-right: 10px;">
		<div class="panel panel-primary">
			<div class="panel-heading">
				<h3 class="panel-title">
					<h3 class="panel-title">Loans</h3>
				</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12 col-xs-12 col-sm-12">
						<a href="#" class="thumbnail">
							<img src="..." alt="...">
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
						<label for="in_firstname">Firstname</label>
						<input type="text" name="firstname" class="form-control" id="in_firstname" placeholder="Firstname">
					</div>
					<div class="form-group">
						<label for="in_middlename">Middlename</label>
						<input type="text" name="middlename" class="form-control" id="in_middlename" placeholder="Middlename">
					</div>
					<div class="form-group">
						<label for="in_lastname">Lastname</label>
						<input type="text" name="lastname" class="form-control" id="in_lastname" placeholder="Lastname">
					</div>
					<div class="form-group">
						<label for="in_mobilenumber">Mobile Number</label>
						<input type="text" name="mobilenumber" class="form-control" id="in_mobilenumber" placeholder="Mobile Number">
					</div>
					<div class="form-group">
						<label for="in_address">Address</label>
						<input type="text" name="address" class="form-control" id="in_address" placeholder="Address">
					</div>
					<div class="form-group">
						<label for="in_guarantor">Guarantor</label>
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
						<label for="dp">Display Picture</label>
						<input type="file" name="dp" id="dp">
						<p class="help-block">Example block-level help text here.</p>
					</div>
				
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-success pull-left">Save</button>
				</form>
				<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>