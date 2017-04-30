<div ng-controller="homeController" ng-init="base_url='<?= base_url() ?>'">    
    <div class="row">
        <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Cash Flows</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <canvas id="line" class="chart chart-line" data="graph_data"
                                labels="labels" legend="true" series="series"
                                click="onClick" options="options" height="70">
                                </canvas>
                            </div>
                            <div class="tiles">
                                <div class="col-md-4 tile">
                                    <span><i class="fa fa-money"></i> Total Current Reservations</span>
                                    <h2>₱ <span ng-bind="current_loan_reservation_amount"></span></h2>
                                    <button class="btn btn-xs btn-primary">View Details</button>
                                </div>
                                <div class="col-md-4 tile">
                                    <span><i class="fa fa-money"></i> Total Expired Reservations</span>
                                    <h2>₱ <span ng-bind="expired_loan_reservation_amount"></span></span></h2>
                                    <button class="btn btn-xs btn-primary">View Details</button>
                                </div>
                                <div class="col-md-4 tile">
                                    <span><i class="fa fa-money"></i> Cash On Hand</span>
                                    <h2>₱ <span ng-bind="total_cash_on_hand"></span></span></h2>
                                    <button class="btn btn-xs btn-primary">View Details</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>