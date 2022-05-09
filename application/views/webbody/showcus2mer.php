<div class="container" ng-app="firstapp" ng-controller="Index" style="margin-left: 0px; padding-left: 0px; padding-right: 0px; margin-right: 0px;width: 975px;">
    <div ng-if="money_change_showcus[0].money_change_showcus == '0.01' && listsale == ''">
        <video width="980px" autoplay loop>
            <source src="<?php echo $base_url; ?>/video/video.mp4" type="video/mp4">
            <source src="video.ogg" type="video/ogg">
            Your browser does not support HTML5 video.
        </video>
        <hr />
        <center>
            <h1 style="font-weight:bold;font-size:40px;color:orange;"> ເຊີນລູກຄ້າທ່ານຕໍ່ໄປ</h1>
        </center>
    </div>

    <div ng-if="money_change_showcus[0].money_change_showcus != '0.01' && listsale == ''" class="panel panel-default">
        <br />
        <table class="table" style="font-size:50px;font-weight:bold;">
            <tr>
                <td class="text-right" width="40%">ຮັບເງິນ</td>
                <td class="text-right" style="color:green;">{{money_change_showcus[0].money_from_cus_showcus| number:2}}</td>
                <td width="20%"></td>
            </tr>
            <tr>
                <td class="text-right">ຍອດເງິນຊຳລະ</td>
                <td class="text-right" style="color:green;">{{money_change_showcus[0].price_value_showcus| number:2}}</td>
                <td width="20%"></td>
            </tr>
            <tr>
                <td class="text-right"> ເງິນທອນ</td>
                <td class="text-right" style="color:red;"> {{money_change_showcus[0].money_change_showcus| number:2}}</td>
                <td width="20%"></td>
            </tr>
        </table>
        <br />
    </div>

    <div ng-show="listsale != ''" class="panel panel-default" style="font-size:30px;font-weight:bold;">
        <div class="panel-body">
            <div style="height: 570px;overflow: auto;">
                <table class="table table-hover">
                    <thead style="background-color:orange;color:#fff;">
                        <tr>
                            <th>ສິນຄ້າ</th>
                            <th class="text-center">ຈຳນວນ</th>
                            <th>ລາຄາ</th>
                            <th class="text-right">ລວມ</th>
                        </tr>
                    </thead>
                    <tbody style="color:green;">
                        <tr ng-repeat="x in listsale">
                            <td>
                                {{x.product_name}}
                                <input type="hidden" ng-model="x.product_id">
                            </td>
                            <td align="center">
                                {{x.product_sale_num| number}}
                            </td>
                            <td>
                                {{x.product_price| number}}
                            </td>
                            <td align="right">{{(x.product_price - x.product_price_discount) * x.product_sale_num  | number }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <table class="table">
                <tbody style="background-color:orange;color:#fff;text-shadow: -1px 0 black, 0 1px black, 1px 0 black, 0 -1px black;">
                    <tr style="font-size:50px;">
                        <td colspan="2" align="right"><?= $lang_all ?>ທັງໝົດ</td>
                        <td align="right" style="font-weight: bold;">{{Sumsalenum() | number}} ອັນ</td>
                        <td align="right" style="background-color:#fff;font-weight: bold;color:red;border:1px solid orange;">{{Sumsaleprice() | number}} ກີບ</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    var app = angular.module('firstapp', []);
    app.controller('Index', function ($scope, $http) {
        $scope.Showlistorder = function () {
            $http.post("<?php echo $base_url; ?>/sale/Salepic/showlistorder", {
            }).success(function (data) {
                $scope.listsale = data;
            });
        };
        $scope.Showlistorder();
        setInterval(function () {
            $scope.Showlistorder();
        }, 1000);
        $scope.Showmoney_change = function () {
            $http.post("<?php echo $base_url; ?>/sale/Salepic/showmoneychange", {
            }).success(function (data) {
                $scope.money_change_showcus = data;
            });
        };
        setInterval(function () {
            $scope.Showmoney_change();
        }, 1000);

        $scope.Sumsalenum = function () {
            var total = 0;
            angular.forEach($scope.listsale, function (item) {
                total += parseFloat(item.product_sale_num);
            });
            return total;
        };

        $scope.Sumsaleprice = function () {
            var total = 0;

            angular.forEach($scope.listsale, function (item) {
                total += parseFloat((item.product_price - item.product_price_discount) * item.product_sale_num);
            });
            return total;
        };
    });

</script>
