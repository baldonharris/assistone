<div ng-controller="adminController" class="row" ng-init="base_url='<?=base_url()?>'">
	<div class="col-md-6 col-sm-12 col-xs-12" style="padding-left:10px; padding-right: 10px;">
		<div class="x_panel give-min-height-inv">
			<div class="x_title">
				<h2>Bucket Settings</h2>
				<ul class="nav navbar-right panel_toolbox">
					<li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
				</ul>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
                <div class="row">
                    <div class="col-md-4" style="padding-left:0px;">
                        <div class="control-group">
                            <div class="controls">
                                <div class="col-md-11 xdisplay_inputx form-group has-feedback" style="padding-left:0;">
                                    <input type="text" class="form-control has-feedback-left" id="effectivity_date" ng-model="effectivity_date">
                                    <span class="fa fa-calendar-o form-control-feedback left" aria-hidden="true" style="left:0;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button ng-click="add_percentage()" class="btn btn-primary pull-right" style="margin-right:0;"><i class="fa fa-plus" aria-hidden="true"></i> Add Bucket</button>
                </div>
                <div class="row" style="text-align:center;">
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
                                    <input ng-model="percentage.bucket" type="text" class="form-control" id="Subject">
                                </td>
                                <td>
                                    <input ng-model="percentage.percentage" type="text" class="form-control" id="Percentage" ng-pattern="/^(?:\d*\.)\d+$/" step="0.01">
                                </td>
                                <td style="text-align:center;">
                                    <button ng-click="remove_percentage($index)" class="btn btn-danger"><i class="fa fa-minus" aria-hidden="true"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3"><button type="submit" class="btn btn-success btn-block">Save</button></td>
                            </tr>
                        </form>
                    </tbody>
                </table>
			</div>
		</div>
	</div>

</div>