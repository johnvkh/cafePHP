<div class="col-md-10 col-sm-9" ng-app="firstapp" ng-controller="Index">
    <div class="panel panel-default">
        <div class="panel-body">
            <div style="float: left;">
                <input type="text" ng-model="searchtext" class="form-control" placeholder="
                       <?= $lang_search ?> ชื่อพนักงานขาย" ng-change="getlist(searchtext, '1')">
            </div>
            <br />
            <table id="headerTable" class="table table-hover table-bordered">
                <thead>
                    <tr class="trheader">
                        <th><?= $lang_period ?></th>
                        <th><?= $lang_by ?></th>
                        <th><?= $lang_shift_open_time ?></th>
                        <th><?= $lang_shift_closing_time ?></th>
                        <th><?= $lang_money_drawer_start ?></th>
                        <th><?= $lang_money_last_drawer ?></th>
                        <th><?= $lang_difference_money ?></th>
                        <th><?= $lang_number_sold_products ?></th>
                        <th><?= $lang_circulation ?></th>
                        <th><?= $lang_discount_bill ?></th>
                        <th><?= $lang_sumall ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-repeat="x in list">
                        <td>{{x.shift_id| number}}</td>
                        <td>{{x.user_name}}</td>
                        <td>{{x.shift_start_time}}</td>
                        <td>
                            <span ng-if="x.shift_end_time=='01-01-1970 07:00:00'"></span>
                            <span ng-if="x.shift_end_time!='01-01-1970 07:00:00'">	{{x.shift_end_time}}</span>
                        </td>
                        <td style="text-align:right;">{{x.shift_money_start| number:2}}</td>
                        <td style="text-align:right;">{{x.shift_money_end| number:2}}</td>
                        <td style="color:#fff;background-color:#f0ad4e;text-align:right;">{{x.shift_money_end - x.shift_money_start| number:2}}</td>
                        <td style="text-align:right;">{{x.sumsale_num| number}}</td>
                        <td style="text-align:right;">{{x.sumsale_price| number:2}}</td>
                        <td style="text-align:right;">{{x.discount_last| number:2}}</td>
                        <td style="color:#fff;background-color:#f0ad4e;text-align:right;">{{x.sumsale_price - x.discount_last| number:2}}</td>
                    </tr>
                </tbody>
            </table>
            <form class="form-inline">
                <div class="form-group">
                    <?= $lang_show ?>
                    <select class="form-control" name="" id="" ng-model="perpage" ng-change="getlist(searchtext, '1', perpage)">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                        <option value="1000">1000</option>
                        <option value="3000">3000</option>
                        <option value="5000">5000</option>
                        <option value="10000">10000</option>
                        <option value="100000">100000</option>
                        <option value="1000000">1000000</option>
                    </select>
                    <?= $lang_page ?>
                    <select name="" id="" class="form-control" ng-model="selectthispage"  ng-change="getlist(searchtext, selectthispage, perpage)">
                        <option  ng-repeat="i in pagealladd" value="{{i.a}}">{{i.a}}</option>
                    </select>
                </div>
            </form>
            <hr />
            <button id="btnExport" class="btn btn-default" onclick="fnExcelReport();"> <span class="glyphicon glyphicon-save" aria-hidden="true"></span>
                <?= $lang_downloadexcel ?>
            </button>
        </div>
    </div>
</div>
<script>
    var app = angular.module('firstapp', []);
    app.controller('Index', function ($scope, $http, $location) {
        $scope.ParsefloatFunc = function (data) {
            return parseFloat(data);
        };
        $scope.printDiv = function () {
            window.scrollTo(0, 0);
            window.print();
        };
        $scope.printDivfullsend = function (x) {
            $('#Openonesend').modal('show');
            $scope.dataprintsend = x;
            setTimeout(function () {
                $scope.printDiv();
            }, 1000);
        };
        $scope.lung = '1';
        $scope.Selectlung = function (x) {
            $scope.lung = x;
        };
        $("#dayfrom").datetimepicker({
            timepicker: false,
            format: 'd-m-Y',
            lang: 'th'  // แสดงภาษาไทย
        });
        $("#dayto").datetimepicker({
            timepicker: false,
            format: 'd-m-Y',
            lang: 'th'  // แสดงภาษาไทย
        });
        $scope.dayfrom = '<?php echo date('01-m-Y', time()); ?>';
        $scope.dayto = '<?php echo date('d-m-Y', time()); ?>';
        $scope.perpage = '10';
        $scope.getlist = function (searchtext, page, perpage) {
            if (!searchtext) {
                searchtext = '';
            }
            if (searchtext != '') {
                $scope.dayfrom = '';
                $scope.dayto = '';
            }
            if (!page) {
                var page = '1';
            }
            if (!perpage) {
                var perpage = '10';
            }
            $http.post("Salereportshift/get", {
                searchtext: searchtext,
                page: page,
                perpage: perpage
            }).success(function (data) {
                $scope.list = data.list;
                $scope.pageall = data.pageall;
                $scope.numall = data.numall;
                $scope.pagealladd = [];
                for (i = 1; i <= $scope.pageall; i++) {
                    $scope.pagealladd.push({a: i});
                }
                $scope.selectpage = page;
                $scope.selectthispage = page;
            });
        };
        $scope.getlist('', '1');
    });
</script>
