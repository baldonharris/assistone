<div ng-controller="adminController" class="row" ng-init="base_url='<?=base_url()?>'">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:10px; padding-right: 10px;">
		<div class="x_panel give-min-height-inv">
			<div class="x_title">
				<h2>Effectivities</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
                <div class="row">
					<div class="remove-padding col-lg-3 col-xs-12 col-sm-12 hidden-md hidden-sm hidden-xs">
						<button class="btn btn-primary btn-sm" ng-click="launch_modal()">
							<span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Add Effectivity
						</button>
					</div>
				</div>
                <div class="row" style="padding-top: 1%;">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover jambo_table">
                            <thead class="headings">
                                <tr>
                                    <th>Submitted Date</th>
                                    <th>Effectivity Date</th>
                                    <th>Number of Buckets</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="effectivity in effectivities">
                                    <td>{{ effectivity.submitted_date }}</td>
                                    <td>{{ effectivity.effectivity_date }}</td>
                                    <td>{{ effectivity.total_buckets }}</td>
                                    <td>
                                        <span class="{{ effectivity.status }}">
                                            {{ effectivity.status }}
                                        </span>
                                    </td>
                                    <td style="text-align:center;">
                                        <div class="btn-group btn-group-xs" role="group" aria-label="...">
                                            <button type="button" class="btn btn-success" ng-click="get_buckets($index)">View Buckets</button>
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
    
    <div class="modal fade" id="add_effectivity_modal" tabindex="-1" role="dialog" aria-labelledby="investorsettings" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Add Effectivity <span></span></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4" style="padding-left:0px;">
                            <div class="control-group">
                                <div class="controls">
                                    <div class="col-md-12 xdisplay_inputx form-group has-feedback" style="padding-left:0;">
                                        <input type="text" class="form-control has-feedback-left" id="effectivity_date" ng-model="effectivity_date" style="padding-right: 0;">
                                        <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true" style="left:0;"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button ng-click="add_percentage()" class="btn btn-primary pull-right" style="margin-right:0;"><i class="fa fa-plus" aria-hidden="true"></i> Add Bucket</button>
                    </div>
                    <div class="row" style="text-align:center;" ng-if="!zero_master_percentages">
                        <h2>Effectivity Date: <span ng-bind="effectivity_date"></span></h2>
                    </div>
                    <table class="table table-bordered table-hover jambo_table" ng-if="!zero_master_percentages">
                        <thead>
                            <tr>
                                <th>Bucket</th>
                                <th>Percentage</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <form name="subject_form" ng-submit="push_percentages()">
                                <tr ng-repeat="percentage in master_percentages track by $index">
                                    <td>
                                        <input ng-model="percentage.bucket_name" type="text" class="form-control" id="Subject" ng-disabled="!check_bucket_index($index)">
                                    </td>
                                    <td>
                                        <input ng-model="percentage.percentage" type="text" class="form-control" id="Percentage" ng-pattern="/^(?:\d*\.)\d+$/" step="0.01">
                                    </td>
                                    <td style="text-align:center;">
                                        <button ng-click="remove_percentage($index)" class="btn btn-danger" ng-show="check_bucket_index($index)"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                            </form>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success pull-left" ng-click="save_bucket()" ng-if="!zero_master_percentages">Save</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal" style="margin-right: 0;">Close</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="view_buckets_modal" tabindex="-1" role="dialog" aria-labelledby="investorsettings" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Buckets <span></span></h4>
                </div>
                <div class="modal-body">
                    <div class="row" style="text-align:center;">
                        <h2>Effectivity Date: {{ effectivity_date_set }}</h2>
                    </div>
                    <table class="table table-bordered table-hover jambo_table">
                        <thead>
                            <tr>
                                <th>Bucket</th>
                                <th>Percentage</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="bucket in buckets track by $index">
                                <td>{{ bucket.bucket_name }}</td>
                                <td>{{ bucket.percentage }}%</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal" style="margin-right: 0;">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>