<div class="row" id="base_url" url="<?=base_url('customers/listing')?>" base-url="<?=base_url()?>">
	<div class="col-md-7 col-sm-12 col-xs-12" style="padding-left:10px; padding-right: 10px;">
		<div class="x_panel">
			<div class="x_title">
				<h2>Customers</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" id="forCustomerSettings"><i class="fa fa-wrench"></i></a>
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
					<div class="input-group col-lg-4 col-lg-offset-4 col-md-12 col-xs-12 col-sm-12 pull-right">
						<form class="form-inline" method="post" action="<?=base_url('customers/search/'.$page['curr_page'].'/'.$set_sortby.'/'.$set_orderby.'/'.$set_display)?>">
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
						<span class="hidden" id="del-btn-url-holder" base-url="<?=base_url('customers/change_customer_status/'.$page['curr_page'].'/'.$set_sortby.'/'.$set_orderby.'/'.$set_display)?>"></span>
						<div class="btn-group hidden-sm hidden-xs hidden-md" role="group" aria-label="...">
							<button type="button" id="btn-update" class="disabled btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Upd
							</button>
							<a base-url="<?=base_url('customers/delete_customer/'.$page['curr_page'].'/'.$set_sortby.'/'.$set_orderby.'/'.$set_display)?>" href="#" class="disabled btn btn-dark btn-sm btn-delete">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Del
							</a>
						</div>
						<div class="btn-group hidden-lg btn-group-xs" role="group" aria-label="...">
							<button type="button" id="btn-update" class="disabled btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Upd
							</button>
							<a base-url="<?=base_url('customers/delete_customer/'.$set_sortby.'/'.$set_orderby.'/'.$set_display)?>" href="#" class="disabled btn btn-dark btn-sm btn-delete">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Del
							</a>
						</div>
					</div>
					<div class="col-md-3 col-md-offset-5 col-sm-6 col-xs-6">
						<div class="btn-group pull-right hidden-sm hidden-xs hidden-md" role="group" aria-label="...">
							<a href="<?= base_url('customers/listing/'.($page['curr_page']-1).'/'.$set_sortby.'/'.$set_orderby.'/'.$set_display) ?>" class="<?= ($page['status']['prev']==0) ? 'disabled' : '' ?> btn btn-default btn-sm">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Prev
							</a>
							<a href="<?= base_url('customers/listing/'.($page['curr_page']+1).'/'.$set_sortby.'/'.$set_orderby.'/'.$set_display) ?>" class="<?= ($page['status']['next']==0) ? 'disabled' : '' ?> btn btn-default btn-sm">
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
					<div class="col-md-offset-3 col-md-6 col-xs-12 col-sm-12">
						<div class="thumbnail">
							<div class="image view view-first" style="height: 100%">
								<img id="display_picture" style="width: 100%; height:100%; display: block;" source="<?=base_url('assets/images/')?>" alt="...">
								<div class="mask">
									<p>Please select customer...</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<center>
							<i class="fa fa-spinner fa-pulse fa-3x fa-fw hidden"></i><span class="sr-only">Loading...</span>
							<h4><span class="customer_id">Please select customer...</span></h4>
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
					<li class="dropdown hidden-lg add-loan-btn">
						<a href="#"><i class="fa fa-plus"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row">
					<div class="col-lg-3 col-xs-12 col-sm-12 hidden-md hidden-sm hidden-xs">
						<a href="#" class="btn btn-primary add-loan-btn btn-sm hidden">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Loan
						</a>
					</div>
				</div>
				<div class="row" style="padding-top:1%">
					<center>
						<i class="fa fa-spinner fa-pulse fa-3x fa-fw hidden"></i><span class="sr-only">Loading...</span>
						<h4 class="customer_id"><span>Please select customer...</span></h4>
					</center>
					<div id="account_overview" class="hidden">
						<div class="table-responsive">
							<table class="table table-bordered table-hover jambo_table" id="loan_table">
								<thead class="headings">
									<tr>
										<th>Loan ID</th>
										<th>Date of Application</th>
										<th>Date of Release</th>
										<th>Amount Loan</th>
										<th>Interest Rate</th>
										<th>Number of Payments</th>
										<th>Total Interest Amount</th>
										<th>Balance</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody id="loan_body">
									<tr class="hidden" id="loan_row_dummy">
										<th id="loan_id"></th>
										<td id="date_of_application"></td>
										<td id="date_of_release"></td>
										<td id="amount_loan"></td>
										<td id="interest_rate"></td>
										<td id="number_of_terms"></td>
										<td id="total_interest_amount"></td>
										<td id="balance"></td>
										<td class="button_more">
											<button type="button" class="btn btn-default btn-xs btn-success view_loan_btn" get-payment="<?=base_url('payments/get_payment')?>">Make Payments</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="customerSettings" tabindex="-1" role="dialog" aria-labelledby="customerSettings" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Settings</h4>
			</div>
			<div class="modal-body">
				<form id="form_setting" action="<?=base_url('customers/'.$this->uri->segment(2))?>" method="post">
					<input type="hidden" name="set_page" value="<?=$page['curr_page']?>"/>
					<div class="form-group">
						<label for="sortby" class="control-label">Sort by:</label>
						<select class="form-control" name="set_sortby">
							<option value="1" <?= ($set_sortby==1) ? 'selected="selected"' : ''  ?>>Customer ID</option>
							<option value="2" <?= ($set_sortby==2) ? 'selected="selected"' : ''  ?>>Firstname</option>
							<option value="3" <?= ($set_sortby==3) ? 'selected="selected"' : ''  ?>>Lastname</option>
						</select>
					</div>
					<div class="form-group">
						<div class="row">
							<div class="col-md-6">
								<label for="orderby" class="control-label">Order by:</label>
								<div class="radio">
									<label>
										<input type="radio" name="set_orderby" id="orderbyasc" value="1" <?= ($set_orderby==1) ? 'checked' : ''  ?>>
										ASC
									</label>
								</div>
								<div class="radio">
									<label>
										<input type="radio" name="set_orderby" id="orderbydesc" value="2" <?= ($set_orderby==2) ? 'checked' : ''  ?>>
										DESC
									</label>
								</div>
							</div>
							<div class="col-md-6">
								<label for="display" class="control-label">Display:</label>
								<div class="checkbox">
									<label>
										<input type="checkbox" value="1" id="display" name="set_display" <?= ($set_display==1) ? 'checked' : ''  ?>>
										Display all
									</label>
								</div>
							</div>
						</div>
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="btn-setting" class="btn btn-success btn-block">Go!</button>
				</form>
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
								foreach($data['guarantors'] as $customer){
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

<div class="modal fade" id="addLoan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Loan</h4>
			</div>
			<div class="modal-body">
				<form id="form_loan" add-url="<?=base_url('loans/add_loan')?>" update-url="<?=base_url('customers/update_loan')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="customer_id" value=""/>
					<div class="form-group">
						<label class="control-label" for="in_date_of_application">Date of Application</label> <i><span class="control-label errhandler" errhandler="date_of_application"></span></i>
						<input type="text" name="date_of_application" class="form-control" id="in_date_of_application" placeholder="Date of Application">
					</div>
					<div class="form-group">
						<label class="control-label" for="in_date_of_release">Date of Release</label> <i><span class="control-label errhandler" errhandler="date_of_release"></span></i>
						<input type="text" name="date_of_release" class="form-control" id="in_date_of_release" placeholder="Date of Release">
					</div>
					<div class="form-group">
						<label class="control-label" for="in_amount_loan">Amount Loan</label> <i><span class="control-label errhandler" errhandler="amount_loan"></span></i>
						<input type="text" name="amount_loan" class="form-control" id="in_amount_loan" placeholder="Amount Loan">
					</div>
					<div class="form-group">
						<label class="control-label" for="in_interest_rate">Interest Rate</label> <i><span class="control-label errhandler" errhandler="interest_rate"></span></i>
						<select name="interest_rate" class="form-control" id="in_interest_rate">
							<option value="1.0">1.0 %</option>
							<option value="2.0">2.0 %</option>
							<option value="3.0">3.0 %</option>
							<option value="4.0">4.0 %</option>
							<option value="5.0">5.0 %</option>
						</select>
					</div>
					<div class="form-group">
						<label class="control-label" for="in_number_of_terms">Number of Payments</label> <i><span class="control-label errhandler" errhandler="number_of_terms"></span></i>
						<input type="text" name="number_of_terms" class="form-control" id="in_number_of_terms" placeholder="Number of Payments">
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success pull-left" id="save_loan">Save</button>
				</form>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="viewloan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Payments</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12 col-sm-12">
						<form id="payment_form">
							<input type="hidden" name="id" id="payment_id" value=""/>
							<div class="form-group">
								<label for="payment_actual_paid_date" class="control-label">Actual Paid Date</label>
								<input type="text" class="form-control" name="payment_actual_paid_date" id="payment_actual_paid_date" placeholder="Actual Paid Date">
							</div>
							<div class="form-group">
								<label for="payment_amount_paid" class="control-label">Amount Paid</label>
								<input type="text" class="form-control" name="payment_amount_paid" id="payment_amount_paid" placeholder="Amount Paid">
							</div>
							<div class="form-group">
								<button type="button" class="btn btn-success btn-block confirm_payment">Confirm Payment</button>
							</div>
						</form>
					</div>
				</div>
				<div class="table-responsive">
					<table class="table table-bordered table-hover jambo_table" id="view_loan_table">
						<thead class="headings">
							<tr>
								<th width="15%">Due Date</th>
								<th>Due Amount</th>
								<th>Actual Paid Date</th>
								<th>Amount Paid</th>
								<th>Payment Balance</th>
								<th>Running Balance</th>
							</tr>
						</thead>
						<tbody id="view_loan_body">
							<tr class="hidden" id="view_loan_row_dummy">
								<th id="due_date"></th>
								<td id="due_amount"></td>
								<td id="actual_paid_date"></td>
								<td id="amount_paid"></td>
								<td id="payment_balance"></td>
								<td id="running_balance"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success pull-left confirm_payment">Confirm Payment</button>
				<button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>