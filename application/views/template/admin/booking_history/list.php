<?php
# @Author: Awan Tengah
# @Date:   2017-02-06T16:08:00+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-05-03T04:26:59+07:00
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-app="order_productModule" ng-controller="order_productController as mc">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <?php echo $page_title; ?>
            <?php if (isset($sub_page_title)): ?>
                <small><?php echo $sub_page_title; ?></small>
            <?php endif; ?>
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo site_url('admin'); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active"><?php echo $on_section . ' ' . $page_title; ?></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Your Page Content Here -->
        <div class="box">
            <div class="box-header">
                <div class="box-tools" ng-cloak>
                    Showing {{mc.numbering + $index}} to {{mc.lengthFilter}} of {{mc.itemsLength}} entries
                </div>
                <br>
            </div>
            <div class="box-body table-responsive">
                <?php alert_message(); ?>
                <table class="table table-hover table-bordered" st-pipe="mc.callServer" st-table="mc.displayed"
                st-safe-src="mc.callServer" refresh-table>
                <thead>
                    <tr>
                        <th width="10" rowspan="2" class="th-top">No</th>
                        <th st-sort="name">User</th>
                        <th st-sort="order_number">Order Number</th>
                        <th st-sort="order_type_text">Order Type</th>
                        <th st-sort="id_custom_product">Product</th>
                        <th st-sort="status_text">Status</th>
                        <th width="160" st-sort="created_at">Created At</th>

                        <th width="110" rowspan="2" class="th-top">Action</th>
                    </tr>
                    <tr>
                        <th><input st-search="name" placeholder="Search.." class="input-sm form-control"></th>
                        <th><input st-search="order_number" placeholder="Search.." class="input-sm form-control"></th>
                        <th><input st-search="order_type_text" placeholder="Search.." class="input-sm form-control"></th>
                        <th><input st-search="id_custom_product" placeholder="Search.." class="input-sm form-control"></th>
                        <th><input st-search="status_text" placeholder="Search.." class="input-sm form-control"></th>
                        <th><input st-search="created_at" placeholder="Search.." class="input-sm form-control"></th>

                    </tr>
                </thead>
                <tbody ng-show="!mc.isLoading" ng-cloak>
                    <tr ng-repeat="row in mc.displayed">
                        <td>{{mc.numbering + $index}}</td>
                        <td>{{row.name}}</td>
                        <td>{{row.order_number}}</td>
                        <td>{{row.order_type_text}}</td>
                        <td>{{row.id_custom_product}}</td>
                        <td>{{row.status_text}}</td>
                        <td>{{row.created_at}}</td>
                        <td class="td-action">
                            <div class="btn-group">
                                <button type="button" class="btn btn-info btn-xs" ng-click="openModal(row)">
                                    View
                                </button>
                                <button type="button" class="btn btn-info dropdown-toggle btn-xs" data-toggle="dropdown"
                                aria-expanded="false">
                                <span class="caret"></span>
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <ul class="dropdown-menu ul-action" role="menu">
                                <li>
                                    <a href="#" ng-click="changeStatus(row)">
                                        <i class="icon ion-android-close"></i> Change Status
                                    </a>
                                </li>
                                <li>
                                    <a href="#" ng-click="showPrintView(row)">
                                        <i class="icon ion-printer"></i> Print
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr ng-show="mc.emptyData">
                    <td colspan="6" class="text-center">Data not found.</td>
                </tr>
            </tbody>
            <tbody ng-show="mc.isLoading" ng-cloak>
                <tr>
                    <td colspan="8" class="text-center">
                        <img src="<?php echo base_url('assets/img/ajaxLoader.gif'); ?>" alt="Loading..">
                    </td>
                </tr>
            </tbody>
            <tfoot>
                <tr>
                    <td class="text-center" st-pagination=""
                    st-items-by-page="<?php echo isset($limit) ? $limit : 10; ?>" colspan="8">
                </td>
            </tr>
        </tfoot>
    </table>
</div>
</div>

</section><!-- /.content -->
<script type="text/ng-template" id="myModalContent.html">
    <div class="modal-header">
        <h3 class="modal-title">Details</h3>
    </div>
    <div class="modal-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <tbody>

                    <tr>
                        <th>Name</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.name }}</td>
                    </tr>

                    <tr>
                        <th>Order Number</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.order_number }}</td>
                    </tr>

                    <tr>
                        <th>Order Type</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.order_type_text }}</td>
                    </tr>

                    <tr>
                        <th>Quantity</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.quantity }}</td>
                    </tr>

                    <tr>
                        <th>Base</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.base }}</td>
                    </tr>

                    <tr>
                        <th>Option</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.option }}</td>
                    </tr>

                    <tr>
                        <th>Delivery Cost</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.delivery_cost }}</td>
                    </tr>

                    <tr>
                        <th>Tax</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.tax }}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.status_text }}</td>
                    </tr>

                    <tr>
                        <th>Spec</th>
                        <td width="10">:</td>
                        <td>
                            <ol style="padding-left: 1em;">
                                <li>Fabric: {{selected.item.fabric_title + ' ('+selected.item.fabric_code+')'}}</li>
                                <li>Collar: {{selected.item.collar_title}}</li>
                                <li>Cuffs: {{selected.item.cuff_title || 'None'}}</li>
                                <li>Sleeve: {{selected.item.sleeve_title || 'Long Sleeve'}}</li>
                                <li>
                                    Body Type:
                                    <ul class="list-unstyled">
                                        <li>Front: {{selected.item.body_type_front_title || 'None'}}</li>
                                        <li>Back: {{selected.item.body_type_back_title || 'None'}}</li>
                                        <li>Hem: {{selected.item.body_type_hem_title || 'None'}}</li>
                                    </ul>
                                </li>
                                <li>Pocket: {{selected.item.pocket_title}}</li>
                                <li>
                                    Button:
                                    <ul class="list-unstyled">
                                        <li>Button: {{selected.item.button_title}}</li>
                                        <li>Button Hole: {{selected.item.button_hole_title || 'Match Fabric Color'}}</li>
                                        <li>Button Thread: {{selected.item.button_thread_title || 'Match Fabric Color'}}</li>
                                    </ul>
                                </li>
                                <li>
                                    Cleric:
                                    <ul class="list-unstyled">
                                        <li>Type: {{selected.item.cleric_category || 'None'}}</li>
                                        <li>Fabric: {{selected.item.cleric_title ? selected.item.cleric_title + '('+selected.item.cleric_fabric_code+')' : 'None'}}</li>
                                    </ul>
                                </li>
                                <li>
                                    Embroidery:
                                    <ul class="list-unstyled">
                                        <li>Position: {{selected.item.embroidery_position_title || 'None'}}</li>
                                        <li>Font: {{selected.item.embroidery_font_title || 'None'}}</li>
                                        <li>Color: {{selected.item.embroidery_color_title || 'None'}}</li>
                                        <li>Text: {{selected.item.embroidery_text}}</li>
                                    </ul>
                                </li>
                                <li>
                                    Option:
                                    <ul class="list-unstyled">
                                        <li>Stitch Thread: {{selected.item.option_amf_stitch_title || 'None'}}</li>
                                        <li>Interlining: {{selected.item.option_interlining_title || 'Standard'}}</li>
                                        <li>Sewing: {{selected.item.option_sewing_title || 'Standard'}}</li>
                                        <li>Tape: {{selected.item.option_tape_title || 'None'}}</li>
                                    </ul>
                                </li>
                                <li>Special Request Verify: {{selected.item.special_request_verify}}</li>
                            </ol>
                        </td>
                    </tr>

                    <tr>
                        <th>Main Size</th>
                        <td width="10">:</td>
                        <td>
                            <ol style="padding-left: 1em;">
                                <li>Arround Neck: {{selected.item.around_neck_selection}}</li>
                                <li>Sleeve Length Right: {{selected.item.sleeve_length_right_selection}}</li>
                                <li>Sleeve Length Left: {{selected.item.sleeve_length_left_selection}}</li>
                                <li>Body Type: {{selected.item.body_type_selection}}</li>
                                <li>Sleeve Type: {{selected.item.sleeve_type_selection}}</li>
                            </ol>
                        </td>
                    </tr>

                    <tr>
                        <th>Size</th>
                        <td width="10">:</td>
                        <td>
                            <ol style="padding-left: 1em;">
                                <li>Neck: {{selected.item.neck}}</li>
                                <li>Shoulder: {{selected.item.shoulder}}</li>
                                <li>Chest: {{selected.item.chest}}</li>
                                <li>Waist: {{selected.item.waist}}</li>
                                <li>Hip: {{selected.item.hip}}</li>
                                <li>Arm Hole: {{selected.item.arm_hole}}</li>
                                <li>Back Length (~88cm): {{selected.item.back_length_88}}</li>
                                <li>Back Length (89cm~): {{selected.item.back_length_89}}</li>
                                <li>Aloha (~88cm): {{selected.item.aloha_88}}</li>
                                <li>Aloha (89cm~)	: {{selected.item.aloha_89}}</li>
                                <li>Cuffs Circle: {{selected.item.cuffs_circle}}</li>
                                <li>Short Sleeve: {{selected.item.short_sleeve}}</li>
                                <li>Sleeve Circle: {{selected.item.sleeve_circle}}</li>
                            </ol>
                        </td>
                    </tr>

                    <tr>
                        <th>Created At</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.created_at }}</td>
                    </tr>

                    <tr>
                        <th>Updated At</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.updated_at }}</td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="modal-footer">
        <button class="btn btn-warning" type="button" ng-click="cancel()">Close</button>
    </div>
</script>

<script type="text/ng-template" id="myChangeStatus.html">
    <div class="modal-header">
        <h3 class="modal-title">Change Status</h3>
    </div>
    <div class="modal-body">
        <div class="form-group">
            <label>Change Status <br>(*Pilih approve untuk order yang disetujui terlebih dahulu untuk pengurangan material-material yang digunakan.)</label>
            <select ng-model="change_status" class="form-control">
                <option value="">Choose</option>
                <option ng-repeat="row in orderProductStatus" ng-if="row.id != '1' && row.id != '2' && row.id != '3' && row.id != '4'" value="{{row.id}}">{{row.title}}</option>
            </select>
        </div>
        <a href="#" ng-click="changeStatusOrder()" class="btn btn-primary">Change</a>
    </div>
</script>
</div><!-- /.content-wrapper -->

<script>
var app = angular.module('order_productModule', ['smart-table', 'oitozero.ngSweetAlert', 'ui.bootstrap']);

app.factory('Resource', ['$q', '$filter', '$timeout', '$http', function ($q, $filter, $timeout, $http) {

    function getPage(start, number, params) {

        var deferred = $q.defer();

        var getData = $http.get("<?php echo base_url('admin/booking_history/get_data'); ?>")
        .then(function (response) {

            recordItems = response.data;

            var filtered = params.search.predicateObject ? $filter('filter')(recordItems, params.search.predicateObject) : recordItems;

            if (params.sort.predicate) {
                filtered = $filter('orderBy')(filtered, params.sort.predicate, params.sort.reverse);
            }

            var result = filtered.slice(start, start + number);

            $timeout(function () {
                //note, the server passes the information about the data set size
                deferred.resolve({
                    data: result,
                    itemsLength: recordItems.length,
                    numberOfPages: Math.ceil(filtered.length / number)
                });
            }, 300);
        });

        return deferred.promise;
    }

    return {
        getPage: getPage
    };

}]);

app.directive("refreshTable", function(){
    return {
        require:'stTable',
        restrict: "A",
        link:function(scope,elem,attr,table){
            scope.$on("refreshData", function() {
                table.pipe(table.tableState());
            });
        }
    }}
);

app.controller('order_productController', ['Resource', '$scope', 'SweetAlert', '$http', '$uibModal',
function (service, $scope, SweetAlert, $http, $uibModal) {

    var ctrl = this, printWindow;

    this.displayed = [];

    this.callServer = function callServer(tableState) {

        ctrl.isLoading = true;
        ctrl.emptyData = false;

        var pagination = tableState.pagination;

        var start = pagination.start || 0;     // This is NOT the page number, but the index of item in the list that you want to use to display the table.
        var number = pagination.number || <?php echo isset($limit) ? $limit : 10; ?>;  // Number of entries showed per page.

        service.getPage(start, number, tableState).then(function (result) {
            ctrl.displayed = result.data;
            ctrl.itemsLength = result.itemsLength;
            ctrl.emptyData = ctrl.displayed.length > 0 ? false : true;
            ctrl.numbering = ctrl.emptyData == true ? start : start + 1;
            ctrl.lengthFilter = ctrl.emptyData == true ? 0 : (ctrl.numbering - 1 + ctrl.displayed.length);
            tableState.pagination.numberOfPages = result.numberOfPages;//set the number of pages so the pagination can update
            ctrl.isLoading = false;
        });
    };

    $scope.openModal = function (mcId) {
        var modalInstance = $uibModal.open({
            templateUrl: 'myModalContent.html',
            controller: 'ModalInstanceCtrl',
            resolve: {
                items: function () {
                    return $scope.items;
                },
                item: function () {
                    return mcId;
                }
            }
        });

        modalInstance.result.then(function (selectedItem) {
            $scope.selected = selectedItem;
        });
    };

    $scope.changeStatus = function (mcId) {
        var modalInstance = $uibModal.open({
            templateUrl: 'myChangeStatus.html',
            controller: 'ChangeStatusInstanceCtrl',
            resolve: {
                items: function () {
                    return $scope.items;
                },
                item: function () {
                    return mcId;
                }
            }
        });

        modalInstance.result.then(function (selectedItem) {
            $scope.selected = selectedItem;
        });
    };

    $scope.removeItem = function removeItem(row) {
        SweetAlert.swal({
            title: "Are you sure?",
            text: "Your will not be able to recover this record!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55", confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            closeOnConfirm: false,
            closeOnCancel: false
        },
        function (isConfirm) {
            if (isConfirm) {
                var index = ctrl.displayed.indexOf(row);
                if (index !== -1) {
                    $http.delete("<?php echo base_url('admin/booking_history/delete'); ?>" + "/" + row.id);
                    $scope.$broadcast('refreshData');
                }
                SweetAlert.swal("Deleted!", "Your record has been deleted.", "success");
            } else {
                SweetAlert.swal("Cancelled", "Your record is safe :)", "error");
            }
        });
    }

    $scope.showPrintView = function showPrintView(row) {
        var orderNumber = row.order_number,
        urlPrint = '<?php echo base_url(); ?>api/order/print_view/' + orderNumber + '?ac=printButton';
        printWindow = window.open(urlPrint,'printWindow','height=600,width=1200,toolbar=0,titlebar=0,left=40,top=40,status=0');
    }

}]);

app.controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, item) {

    $scope.items = item;
    $scope.selected = {
        item: $scope.items
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});

app.controller('ChangeStatusInstanceCtrl', function ($scope, $uibModalInstance, item, $http) {

    $scope.items = item;
    $scope.selected = {
        item: $scope.items
    };
    $scope.orderProductStatus = {};

    $scope.orderProductStatus = $http.get("<?php echo base_url('api/order/get_order_product_status'); ?>").then(function (response) {
        $scope.orderProductStatus = response.data;
    }, function error(response) {
        $scope.orderProductStatus = response.statusText;
    });

    $scope.changeStatusOrder = function() {
        var id_order_product_status = $scope.change_status;
        var id_order_product = $scope.selected.item.id;
        var order_number = $scope.selected.item.order_number;
        $http.get("<?php echo base_url('api/order/update_order_product_status_on_admin'); ?>", {params: {id_order_product_status: id_order_product_status, id_order_product: id_order_product, order_number: order_number}}).then(function (response) {
            window.location.href = "<?php echo current_url(); ?>";
        }, function error(response) {
            alert('Failed');
        });
    }

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});
</script>
