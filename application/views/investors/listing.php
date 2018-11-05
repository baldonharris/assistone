<div class="row" id="base_url" url="<?=base_url('investors/listing')?>" base-url="<?=base_url()?>">
	<div class="col-md-6 col-sm-12 col-xs-12" style="padding-left:10px; padding-right: 10px;">
		<div class="x_panel give-min-height-inv">
			<div class="x_title">
				<h2>Investors</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" id="forinvestorsettings"><i class="fa fa-wrench"></i></a>
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
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add investor
						</button>
					</div>
					<div class="input-group col-lg-4 col-lg-offset-4 col-md-12 col-xs-12 col-sm-12 pull-right">
						<form class="form-inline" method="post" action="<?=base_url('investors/search/'.$page['curr_page'].'/'.$set_sortby.'/'.$set_orderby.'/'.$set_display)?>">
							<div class="form-group top_search">
								<div class="input-group">
									<input type="text" name="search_" class="form-control" id="search_investor" placeholder="Search investor...">
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
					<a id="dummy_list_item" href="#" investor_id="" class="hidden list-group-item investors"><table><td id="dummy-cust-id"></td><td>&nbsp;|&nbsp;</td><td id="dummy-cust-name"></td></table></a>
					<div class="list-group" id="investor_list" get-url="<?=base_url('investors/get_investor')?>">
						<?php
							foreach($data['investors'] as $investor){
								if(!$investor['deleted_at']){
									echo '<a href="#" investor_id="'.$investor['id'].'" class="list-group-item investors"><table><tr><td>'.$investor['investor_id'].'</td><td>&nbsp;|&nbsp;</td><td>'.$investor['firstname'].' '.$investor['lastname'].'</td></tr></table></a>';
								}else{
									echo '<a href="#" investor_id="'.$investor['id'].'" class="list-group-item investors list-group-item-danger"><table><tr><td>'.$investor['investor_id'].'</td><td>&nbsp;|&nbsp;</td><td>'.$investor['firstname'].' '.$investor['lastname'].'</td></tr></table></a>';
								}
							}
						?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-sm-6 col-xs-6">
						<span class="hidden" id="del-btn-url-holder" base-url="<?=base_url('investors/change_investor_status/'.$page['curr_page'].'/'.$set_sortby.'/'.$set_orderby.'/'.$set_display)?>"></span>
						<div class="btn-group hidden-sm hidden-xs hidden-md" role="group" aria-label="...">
							<button type="button" id="btn-update" class="disabled btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Upd
							</button>
							<a base-url="<?=base_url('investors/delete_investor/'.$page['curr_page'].'/'.$set_sortby.'/'.$set_orderby.'/'.$set_display)?>" href="#" class="disabled btn btn-dark btn-sm btn-delete">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Del
							</a>
						</div>
						<div class="btn-group hidden-lg btn-group-xs" role="group" aria-label="...">
							<button type="button" id="btn-update" class="disabled btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">
								<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span> Upd
							</button>
							<a base-url="<?=base_url('investors/delete_investor/'.$set_sortby.'/'.$set_orderby.'/'.$set_display)?>" href="#" class="disabled btn btn-dark btn-sm btn-delete">
								<span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Del
							</a>
						</div>
					</div>
					<div class="col-md-3 col-md-offset-6 col-sm-6 col-xs-6">
						<div class="btn-group pull-right hidden-sm hidden-xs hidden-md" role="group" aria-label="...">
							<a href="<?= base_url('investors/listing/'.($page['curr_page']-1).'/'.$set_sortby.'/'.$set_orderby.'/'.$set_display) ?>" class="<?= ($page['status']['prev']==0) ? 'disabled' : '' ?> btn btn-default btn-sm">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Prev
							</a>
							<a href="<?= base_url('investors/listing/'.($page['curr_page']+1).'/'.$set_sortby.'/'.$set_orderby.'/'.$set_display) ?>" class="<?= ($page['status']['next']==0) ? 'disabled' : '' ?> btn btn-default btn-sm">
								Next <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> 
							</a>
						</div>
						<div class="btn-group pull-right hidden-lg btn-group-xs" role="group" aria-label="...">
							<a href="<?= base_url('investors/listing/'.($page['curr_page']-1)) ?>" class="<?= ($page['status']['prev']==0) ? 'disabled' : '' ?> btn btn-default btn-sm">
								<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
							</a>
							<a href="<?= base_url('investors/listing/'.($page['curr_page']+1)) ?>" class="<?= ($page['status']['next']==0) ? 'disabled' : '' ?> btn btn-default btn-sm">
								<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span> 
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-md-6 col-sm-12 col-xs-12" style="padding-left: 10px; padding-right: 10px;">
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
					<div class="col-md-12">
						<div class="loading-section">
							<center>
								<i class="fa fa-spinner fa-pulse fa-3x fa-fw hidden"></i><span class="sr-only">Loading...</span>
								<h4><span class="investor_id">Please select investor...</span></h4>
							</center>
						</div>
						<table class="inv_info">
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
						</table>
					</div>
				</div>
			</div>
		</div>
		
		
		<div class="x_panel">
			<div class="x_title">
				<h2>Investments</h2>
                <ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown hidden-lg add-transaction-btn">
						<a href="#"><i class="fa fa-plus"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row">
					<div class="col-md-12">
						<div class="loading-section">
							<center>
								<i class="fa fa-spinner fa-pulse fa-3x fa-fw hidden"></i><span class="sr-only">Loading...</span>
								<h4><span class="investor_id">Please select investor...</span></h4>
							</center>
						</div>
						<table class="inv_info">
							<tr>
								<td><b>Total Investment:</b></td>
								<td>₱<span id="investor-total-investment"></span></td>
							</tr>
							<tr>
								<td><b>Total Investment Return:</b></td>
								<td>₱<span id="investor-total-investment-return"></span></td>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
        
        <div class="x_panel acc_overview_min_height">
			<div class="x_title">
				<h2>Transactions</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown hidden-lg add-transaction-btn">
						<a href="#"><i class="fa fa-plus"></i></a>
					</li>
					<li class="dropdown">
						<a href="#" id="forinvestorsettings"><i class="fa fa-wrench"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row">
					<div class="col-lg-3 col-xs-12 col-sm-12 hidden-md hidden-sm hidden-xs">
						<a href="#" class="btn btn-primary add-transaction-btn btn-sm hidden">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Transaction
						</a>
					</div>
				</div>
				<div class="row" style="padding-top:1%">
					<div class="loading-section">
						<center>
							<i class="fa fa-spinner fa-pulse fa-3x fa-fw hidden"></i><span class="sr-only">Loading...</span>
							<h4 class="investor_id"><span>Please select investor...</span></h4>
						</center>
					</div>
					<div id="account_overview" class="hidden">
						<div class="table-responsive">
							<table class="table table-bordered table-hover jambo_table" id="transaction_table">
								<thead class="headings">
									<tr>
										<th>Transaction ID</th>
										<th>Date of Transaction</th>
										<th>Invested Amount</th>
										<th>Type</th>
                                        <th>Investment Return</th>
									</tr>
								</thead>
								<tbody id="transaction_body">
									<tr class="hidden" id="transaction_row_dummy">
										<th id="transaction_id"></th>
										<td id="date_of_transaction"></td>
										<td id="amount_transaction"></td>
                                        <td id="type_transaction">
                                            <span></span>
                                        </td>
                                        <td style="text-align:center;"><button type="button" class="btn btn-warning btn-xs view_transaction_btn">View</button></td>
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

<div class="modal fade" id="investorsettings" tabindex="-1" role="dialog" aria-labelledby="investorsettings" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel">Settings</h4>
			</div>
			<div class="modal-body">
				<form id="form_setting" action="<?=base_url('investors/'.$this->uri->segment(2))?>" method="post">
					<input type="hidden" name="set_page" value="<?=$page['curr_page']?>"/>
					<div class="form-group">
						<label for="sortby" class="control-label">Sort by:</label>
						<select class="form-control" name="set_sortby">
							<option value="1" <?= ($set_sortby==1) ? 'selected="selected"' : ''  ?>>investor ID</option>
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
				<form id="form_investor" add-url="<?=base_url('investors/add_investor')?>" update-url="<?=base_url('investors/update_investor')?>" method="post" enctype="multipart/form-data">
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

<div class="modal fade" id="addTransaction" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"></h4>
			</div>
			<div class="modal-body">
				<form id="form_transaction" add-url="<?=base_url('transactions/add_transaction')?>" update-url="<?=base_url('investors/update_transaction')?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="investor_id" value=""/>
                    <div class="form-group">
						<label class="control-label" for="in_type_transaction">Type of Transaction</label> <i><span class="control-label errhandler" errhandler="type_transaction"></span></i>
                        <select class="form-control" name="type_transaction" id="in_type_transaction">
                            <option value="I">Investment</option>
                            <option value="W">Withdrawal</option>
                        </select>
					</div>
					<div class="form-group">
						<label class="control-label" for="in_date_of_transaction">Date of Transaction</label> <i><span class="control-label errhandler" errhandler="date_of_transaction"></span></i>
						<input type="text" name="date_of_transaction" class="form-control" id="in_date_of_transaction" placeholder="Date of Transaction">
					</div>
					<div class="form-group">
						<label class="control-label" for="in_amount_transaction">Amount Transaction</label> <i><span class="control-label errhandler" errhandler="amount_transaction"></span></i>
						<input type="text" name="amount_transaction" class="form-control" id="in_amount_transaction" placeholder="Amount Transaction">
					</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success pull-left" id="save_transaction">Save</button>
				</form>
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<div class="modal fade" id="view_transaction_details" tabindex="-1" role="dialog" aria-labelledby="investorsettings" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Transaction Detail: <span></span></h4>
			</div>
			<div class="modal-body">
				<div class="loading-section">
                    <center>
                        <i class="fa fa-spinner fa-pulse fa-3x fa-fw hidden"></i><span class="sr-only">Loading...</span>
                    </center>
                </div>
                <table class="table table-bordered table-hover jambo_table">
                    <thead class="headings">
                        <tr>
                            <th>Loan ID</th>
                            <th>Percentage</th>
                            <th>Return</th>
                        </tr>
                    </thead>
                    <tbody id="returns_body">
                        <tr class="hidden" id="returns_row_dummy">
                            <th id="return_loan_id"></th>
                            <td id="return_percentage"></td>
                            <td id="return_return" style="text-align:right;"></td>
                        </tr>
                    </tbody>
                </table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>