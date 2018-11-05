<div class="row" id="base_url" url="<?=base_url('customers/listing')?>" base-url="<?=base_url()?>">
	<div class="col-md-7 col-sm-12 col-xs-12" style="padding-left:10px; padding-right: 10px;">
		<div class="x_panel give-min-height">
			<div class="x_title">
				<h2>Customers</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
					<li class="dropdown">
						<a href="#" id="forCustomerSettings"><i class="fa fa-wrench"></i></a>
					</li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
                <div class="row">
                    <div class="input-group pull-right">
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
					<a id="dummy_list_item" href="#" status="approved" customer_id="" class="hidden list-group-item customers"><table><td id="dummy-cust-id"></td><td>&nbsp;|&nbsp;</td><td id="dummy-cust-name"></td></table></a>
					<div class="list-group" id="customer_list" get-url="<?=base_url('customers/get_customer')?>">
                        <?php foreach($data['customers'] as $customer){ ?>
                            <?php if(!$customer['deleted_at']){ ?>
                                <a href="#" status="approved" customer_id="<?=$customer['id']?>" class="list-group-item customers"><table><tr><td><?=$customer['customer_id']?></td><td>&nbsp;|&nbsp;</td><td><?=$customer['firstname'].' '.$customer['lastname']?></td></tr></table></a>
                            <?php }else{ ?>
                                <a href="#" status="approved" customer_id="<?=$customer['id']?>" class="list-group-item customers list-group-item-danger"><table><tr><td><?=$customer['customer_id']?></td><td>&nbsp;|&nbsp;</td><td><?=$customer['firstname'].' '.$customer['lastname']?></td></tr></table></a>
                            <?php } ?>
                        <?php } ?>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3 col-md-offset-9 col-sm-offset-6 col-sm-6 col-xs-offset-6 col-xs-6">
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
		<div class="x_panel give-min-height">
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
						<div class="loading-section">
							<center>
								<i class="fa fa-spinner fa-pulse fa-3x fa-fw hidden"></i><span class="sr-only">Loading...</span>
								<h4><span class="customer_id">Please select customer...</span></h4>
							</center>
						</div>
						<table class="table cust_info">
							<tr>
								<td style="width: 20%;"><b>Firstname:</b></td>
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
		<div class="x_panel acc_overview_min_height">
			<div class="x_title">
				<h2>Account Overview</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<div class="row" style="padding-top:1%">
					<div class="loading-section">
						<center>
							<i class="fa fa-spinner fa-pulse fa-3x fa-fw hidden"></i><span class="sr-only">Loading...</span>
							<h4 class="customer_id"><span>Please select customer...</span></h4>
						</center>
					</div>
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
										<th>No. of Payments</th>
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
										<td class="button_more" style="text-align:center;">
                                            <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                                <button type="button" class="btn btn-success view_loan_btn" get-payment="<?=base_url('payments/get_payment')?>">Payments</button>
                                            </div>
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
						<form id="payment_form" add_payment="<?= base_url('payments/add_payment') ?>">
							<input type="hidden" name="payment-loan-id" value=""/>
							<div class="form-group">
								<label for="payment_amount_paid" class="control-label">Amount Paid</label>
								<input type="text" class="form-control" name="payment_amount_paid" id="payment_amount_paid" placeholder="Amount Paid">
							</div>
							<div class="form-group">
								<div class="radio">
									<label>
										<input type="radio" id="rad_due_amount" name="pay_amount" value="option1"> Due Amount
									</label>
									<label>
										<input type="radio" id="rad_payoff" name="pay_amount" value="option1"> Payoff Amount 
									</label>
								</div>
							</div>
							<div class="form-group">
								<label for="payment_actual_paid_date" class="control-label">Actual Paid Date</label>
								<input type="text" class="form-control" name="payment_actual_paid_date" id="payment_actual_paid_date" placeholder="Actual Paid Date">
							</div>
							<div class="form-group">
								<div class="radio">
									<label>
										<input type="radio" id="rad_due_date" name="pay_date" value="option1"> Due Date
									</label>
									<label>
										<input type="radio" id="rad_cur_date" name="pay_date" value="option1"> Current Date 
									</label>
								</div>
							</div>
							<div class="form-group">
								<input type="hidden" name="id" id="payment_id" value=""/>
								<input type="hidden" name="payment_payment_balance" value=""/>
								<input type="hidden" name="payment_running_balance" value=""/>
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
				<div class="row">
					<button type="button" class="btn btn-success pull-left confirm_payment">Confirm Payment</button>
					<button type="button" class="btn btn-warning pull-left payoff_information" loan-id payoff_information_r="<?= base_url('payments/payoff_information')?>">Payoff Information</button>
					<button type="button" class="btn btn-primary pull-right" data-dismiss="modal">Close</button>
				</div>
				<div class="row payoff_div">
					<hr/>
					<h1>₱<span></span></h1>
				</div>
			</div>
		</div>
	</div>
</div>