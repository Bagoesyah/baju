<?php
# @Author: Awan Tengah
# @Date:   2017-02-03T17:42:33+07:00
# @Last modified by:   Awan Tengah
# @Last modified time: 2017-02-06T15:31:52+07:00



/**
* User: Awan Tengah
*/
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" ng-app="menuModule" ng-controller="menuController as mc">
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
                <?php if (isset($_created) == 1): ?>
                    <a href="<?php echo site_url('admin/menu/add'); ?>" class="btn btn-primary btn-sm">Add Menu</a>
                <?php endif; ?>
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
                        <th st-sort="title">Title</th>
                        <th st-sort="parent">Parent</th>
                        <th st-sort="url">Url</th>
                        <th st-sort="order">Order</th>
                        <th width="160" st-sort="created_at">Created At</th>
                        <th width="110" rowspan="2" class="th-top">Action</th>
                    </tr>
                    <tr>
                        <th><input st-search="title" placeholder="Search.." class="input-sm form-control"></th>
                        <th><input st-search="parent" placeholder="Search.." class="input-sm form-control"></th>
                        <th><input st-search="url" placeholder="Search.." class="input-sm form-control"></th>
                        <th><input st-search="order" placeholder="Search.." class="input-sm form-control"></th>
                        <th><input st-search="created_at" placeholder="Search.."
                            class="input-sm form-control"></th>
                        </tr>
                    </thead>
                    <tbody ng-show="!mc.isLoading" ng-cloak>
                        <tr ng-repeat="row in mc.displayed">
                            <td>{{mc.numbering + $index}}</td>
                            <td>{{row.title}}</td>
                            <td>{{row.parent}}</td>
                            <td>{{row.url}}</td>
                            <td>{{row.order}}</td>
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
                                    <?php if (isset($_updated) == 1): ?>
                                        <li>
                                            <a href="<?php echo site_url('admin/menu/edit/{{row.id}}'); ?>">
                                                <i class="icon ion-compose"></i> Edit
                                            </a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (isset($_deleted) == 1): ?>
                                        <li><a href="#" ng-click="removeItem(row)"><i
                                            class="icon ion-android-close"></i> Delete</a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        <tr ng-show="mc.emptyData">
                            <td colspan="7" class="text-center">Data not found.</td>
                        </tr>
                    </tbody>
                    <tbody ng-show="mc.isLoading" ng-cloak>
                        <tr>
                            <td colspan="7" class="text-center">
                                <img src="<?php echo base_url('assets/img/ajaxLoader.gif'); ?>" alt="Loading..">
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td class="text-center" st-pagination=""
                            st-items-by-page="<?php echo isset($limit) ? $limit : 10; ?>" colspan="7">
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
                        <th>Title</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.title }}</td>
                    </tr>

                    <tr>
                        <th>Parent</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.parent }}</td>
                    </tr>

                    <tr>
                        <th>Controller</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.controller }}</td>
                    </tr>

                    <tr>
                        <th>Url</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.url }}</td>
                    </tr>

                    <tr>
                        <th>Order</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.order }}</td>
                    </tr>

                    <tr>
                        <th>Icon</th>
                        <td width="10">:</td>
                        <td>{{ selected.item.icon }}</td>
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
</div><!-- /.content-wrapper -->

<script>
var app = angular.module('menuModule', ['smart-table', 'oitozero.ngSweetAlert', 'ui.bootstrap']);

app.factory('Resource', ['$q', '$filter', '$timeout', '$http', function ($q, $filter, $timeout, $http) {

    var recordItems = [];

    function getPage(start, number, params) {

        var deferred = $q.defer();

        var getData = $http.get("<?php echo base_url('admin/menu/get_data'); ?>")
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

app.controller('menuController', ['Resource', '$scope', 'SweetAlert', '$http', '$uibModal',
function (service, $scope, SweetAlert, $http, $uibModal) {

    var ctrl = this;

    this.displayed = [];

    this.callServer = function callServer(tableState) {

        ctrl.isLoading = true;
        ctrl.emptyData = true;

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
                    $http.delete("<?php echo base_url('admin/menu/delete'); ?>" + "/" + row.id);
                    $scope.$broadcast('refreshData');
                }
                SweetAlert.swal("Deleted!", "Your record has been deleted.", "success");
            } else {
                SweetAlert.swal("Cancelled", "Your record is safe :)", "error");
            }
        }
    );
}

}]
);

app.controller('ModalInstanceCtrl', function ($scope, $uibModalInstance, item) {

    $scope.items = item;
    $scope.selected = {
        item: $scope.items
    };

    $scope.cancel = function () {
        $uibModalInstance.dismiss('cancel');
    };
});
</script>
