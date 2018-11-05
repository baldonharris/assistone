<?php
/**
 * Created by PhpStorm.
 * User: baldonharris
 * Date: 09/10/2017
 * Time: 10:48 PM
 */
?>
<div ng-controller="fundsController" class="row" ng-init="base_url='<?= base_url() ?>'" ng-cloak>
    <div class="col-md-6 col-sm-12 col-xs-12" style="padding-left:10px; padding-right: 10px;">
        <div class="x_panel give-min-height-inv">
            <div class="x_title">
                <h2>Buckets</h2>
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
                <div class="row" id="curr_page" page="<?= $page['curr_page'] ?>">
                    <div class="list-group" id="investor_list" get-url="<?=base_url('investors/get_investor')?>">
                        <button class="list-group-item" ng-repeat="bucket in buckets track by $index" ng-click="returns($index)">{{ bucket.name }}</button>
                        <?php
//                        foreach($data['investors'] as $investor){
//                            if(!$investor['deleted_at']){
//                                echo '<a href="#" investor_id="'.$investor['id'].'" class="list-group-item investors"><table><tr><td>'.$investor['investor_id'].'</td><td>&nbsp;|&nbsp;</td><td>'.$investor['firstname'].' '.$investor['lastname'].'</td></tr></table></a>';
//                            }else{
//                                echo '<a href="#" investor_id="'.$investor['id'].'" class="list-group-item investors list-group-item-danger"><table><tr><td>'.$investor['investor_id'].'</td><td>&nbsp;|&nbsp;</td><td>'.$investor['firstname'].' '.$investor['lastname'].'</td></tr></table></a>';
//                            }
//                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-sm-12 col-xs-12" style="padding-left: 10px; padding-right: 10px;">
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
                            <h4 class="investor_id"><span>Please select a bucket...</span></h4>
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