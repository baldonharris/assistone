<div ng-controller="collectionStatementController">
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
                </tr>
            </thead>
            <tbody ng-init="get_url='<?=base_url('reports/get_collection_statement')?>'">
                <tr ng-repeat="report in collection_statement">
                    <td style="font-weight:bold;">{{ report.loan_id }}</td>
                    <td>{{ report.customer_name }}</td>
                    <td>{{ report.date_of_release }}</td>
                    <td style="text-align:right;">{{ report.amount_loan | currency:"" }}</td>
                    <td style="text-align:right;">{{ report.total_amount_paid | currency:"" }}</td>
                    <td style="text-align:right;">{{ report.current_balance | currency:"" }}</td>
                    <td style="text-align:right;">{{ report.due_amount | currency:"" }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>