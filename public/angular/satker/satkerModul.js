define(['app'], function(app) {
    var url = 'admin/satker';
    app.controller('editsatkerController', function($scope,$routeParams, dataService) {
        $scope.header = "Edit Data Satuan Kerja";
        // set var statusId yang diambil dari parameter route.
        $scope.statusId = $routeParams;
        $scope.loading = true;
        $scope.submitted = false;
        // ambil data dari database dengan ajax
        dataService.edit(url,$scope.statusId).success(function(data) {
            $scope.statusData = data;
            $scope.loading = false;
        });
        // proses edit data saat submit , mengirimkan data via ajax dan disimpan ke dalam database
        $scope.processForm = function(isValid) {
            if (isValid) {
                dataService.update(url,$scope.statusId, $scope.statusData).
                        success(function(data) {
                            if (data.success) {
                                window.location.href = '/satker';
                            }
                        }).
                        error(function(data) {
                            console.log(data);
                        });
            } else {
                $scope.submitted = true;
            }
        };
    });

    app.controller('newsatkerController', function($scope, dataService) {
        $scope.header = "Tambah Data Satuan Kerja";
        $scope.statusData = {}; //data awal bernilai array kosong;
        $scope.submitted = false; // submitted bernilai false 
        $scope.processForm = function(isValid) { // fungsi dimana saat proses form terjadi
            // jika valid maka akan mengirimkan data ke url admin/satker dengan $scope.statusData sebagai datanya , dan jika sukses post data maka akan kembali ke base url.
            if (isValid) {
                dataService.save(url,$scope.statusData).
                        success(function(data) {
                            if (data.success) {
                                window.location.href = '/satker';
                            }
                        }).
                        error(function(data) {
                        });
            } else {
                $scope.submitted = true;
            }
        };
    });
    app.controller('listsatkerController', function($scope, $filter, dataService) {
        $scope.header = "Data Satuan Kerja";
        $scope.statuses = {}; // data statuses awal yang merupakan array kosong.
        $scope.loading = true; // loading icon bernilai true
        getSatker(); // memanggil fungsi getSatker()
        // fungsi untuk menuju halaman edit data
        $scope.edit = function(id) {
            window.location.href = '/satker/edit/' + id;
        };
        $scope.sort = function(field) {
            $scope.statuses = $filter('orderBy')($scope.statuses, field, $scope.sort.order);
            $scope.sort.field = field;
            $scope.sort.order = !$scope.sort.order;
        }
        $scope.sort.field = 'satker';
        $scope.sort.order = false;
        // fungsi untuk delete data
        $scope.delete = function(id) {
            if (confirm("Anda yakin untuk menghapus data?") === true) {
                dataService.destroy(url,id).success(function(data) {
                    $scope.loading = true;
                    if (data.success) {
                        getSatker();
                    }
                });
            }
        };
        function getSatker() {
            dataService.get(url).success(function(data) {
                $scope.fields = data.field;
                $scope.statuses = data.values;
                $scope.totalItems = $scope.statuses.length;
                $scope.currentPage = 1;
                $scope.numPerPage = 5;
                // fungsi sorting data ASC/DESC
                $scope.paginate = function(value) {
                    var begin, end, index;
                    begin = ($scope.currentPage - 1) * $scope.numPerPage;
                    end = begin + $scope.numPerPage;
                    index = $scope.statuses.indexOf(value);
                    return (begin <= index && index < end);
                };
                $scope.$watch('query', function(query) {
                    $scope.statuses = data.values;
                    $scope.statuses = $filter('filter')($scope.statuses, $scope.query);
                    $scope.totalItems = $scope.statuses.length;
                    $scope.currentPage = 1;
                    $scope.numPerPage = 5;
                }, true);
                $scope.loading = false;
            })
        }

    });

}); // load aplikasi dengan nama myApp dan plugin ngRoute dan ui.bootstrap
