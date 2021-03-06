<div ng-controller="collectionStatementController" ng-init="base_url='<?=base_url()?>'" ng-cloak>
    <div class="row x_title">
        <div class="col-md-10">
            <h3><?=$header?> <small><?=$subheader?></small></h3>
        </div>
        <!--div class="col-md-2 col-sm-12 col-xs-12">
            <div class="input-prepend input-group pulll-right">
                <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                <input type="text" class="form-control" name="in-loan-date-range" id="in-loan-date-range" ng-model="in_loan_date_range">
            </div>
        </div-->
    </div>
    <div class="row">
        <div class="col-md-2">
            <select class="form-control" ng-options="item.due_date for item in due_dates" ng-model="model_due_date_option" ng-change="loans()"></select>
        </div>
        <div class="col-md-10" style="text-align:right;">
            <button type="button" class="btn btn-danger" aria-label="Left Align" id="printBtn">
                <span class="fa fa-file-pdf-o" aria-hidden="true"></span> Generate PDF
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align:center;">
            <h2>Due date: {{ selected_due_date }}</h2>
        </div>
    </div>
    <div class="row" id="printDiv">
        <div class="print_mode">
            <div class="row site_title" style="text-align:center;">
                <img src="<?=base_url('assets/img/assistone/logo.png')?>"/> <span id="assist">assist</span><span id="one">one</span>
            </div>
            <div class="row" style="text-align:center;font-size:10px">Bunga mar, Jagna, Bohol</div>
            <div class="row" style="text-align:center;font-size:10px">Phone: 555-555-555</div>
            <div class="row" style="text-align:center;font-size:10px">Website: http://www.ayudauno.com</div>
            <div class="row" style="text-align:center;font-size:20px;font-weight:bold;">Collection Statement</div>
            <div class="row" style="text-align:center;font-size:15px;font-weight:bold;">Due Date: {{ selected_due_date }}</div>
            <div class="row">
                <div class="col-md-1">Submitted by: <?= $this->session->userdata('fullname') ?></div>
            </div>
        </div>
        <table class="table table-bordered table-hover jambo_table">
            <thead>
                <tr>
                    <th>Loan ID</th>
                    <th>Customer Name</th>
                    <th>Date of Release</th>
                    <th>Amount Loan</th>
                    <th>Total Amount Paid</th>
                    <th>Current Balance</th>
                    <th>Due Amount</th>
                    <th>Amount Paid</th>
                </tr>
            </thead>
            <tbody>
                <tr><td colspan="8" style="text-align:center;" ng-if="notice_loading">Loading data...</td></tr>
                <tr><td colspan="8" style="text-align:center;" ng-if="notice_no_data">No available data...</td></tr>
                <tr ng-repeat="report in collection_statement">
                    <td style="font-weight:bold;">{{ report.loan_id }}</td>
                    <td>{{ report.customer_name }}</td>
                    <td>{{ report.date_of_release }}</td>
                    <td style="text-align:right;">{{ report.amount_loan | currency:"" }}</td>
                    <td style="text-align:right;">{{ report.total_paid_amount | currency:"" }}</td>
                    <td style="text-align:right;">{{ report.current_balance | currency:"" }}</td>
                    <td style="text-align:right;">{{ report.due_amount | currency:"" }}</td>
                    <td style="text-align:right;">{{ report.amount_paid | currency:"" }}</td>
                </tr>
                <tr ng-if="!notice_no_data">
                    <td style="text-align:right;font-weight:bold;" colspan="6">Total</td>
                    <td style="text-align:right;font-weight:bold;">{{ total_amounts.total_due_amount | currency:"" }}</td>
                    <td style="text-align:right;font-weight:bold;">{{ total_amounts.total_paid_amount | currency:"" }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>