define(['app'], function(app) {
    var url = 'admin/penghargaanpegawai';
    app.directive('ngPenghargaanpegawai', function() {
        return {
            restrict: 'E',
            templateUrl: 'view/penghargaanpegawai/list.html',
            controller: function($scope, $routeParams, dataService, $location, $filter) {
                if (!$routeParams.action) {
                    $scope.data = {};
                    $scope.header = 'Data Penghargaan Pegawai';
                    $scope.pegawaiId = $routeParams.id;
                    dataService.get('admin/pegawai/edit/' + $routeParams.id + '/penghargaanpegawai').success(function(data) {
                        $scope.fields = data.field;
                        $scope.data = data.values;
                        $scope.totalItems = $scope.data.length;
                        $scope.currentPage = 1;
                        $scope.numPerPage = 20;
                        // fungsi sorting data ASC/DESC
                        $scope.paginate = function(value) {
                            var begin, end, index;
                            begin = ($scope.currentPage - 1) * $scope.numPerPage;
                            end = begin + $scope.numPerPage;
                            index = $scope.data.indexOf(value);
                            return (begin <= index && index < end);
                        };
                        $scope.$watch('query', function(query) {
                            $scope.data = data.values;
                            $scope.data = $filter('filter')($scope.data, $scope.query);
                            $scope.totalItems = $scope.data.length;
                            $scope.currentPage = 1;
                            $scope.numPerPage = 20;
                        }, true);
                        $scope.loading = false;
                    })
                    $scope.edit = function(id) {
                        $location.path('/backend/penghargaanpegawai/edit/' + id + '/' + pegawaiId);
                    };
                    $scope.sort = function(field) {
                        $scope.data = $filter('orderBy')($scope.data, field, $scope.sort.order);
                        $scope.sort.field = field;
                        $scope.sort.order = !$scope.sort.order;
                    }
                    $scope.sort.field = 'nama_pegawai';
                    $scope.sort.order = false;
                    // fungsi untuk delete data
                    $scope.delete = function(id) {
                        if (confirm("Anda yakin untuk menghapus data?") === true) {
                            dataService.destroy(url, id).success(function(data) {
                                $scope.loading = true;
                                if (data.success) {
                                    dataService.get('admin/pegawai/edit/' + $routeParams.id + '/penghargaanpegawai').success(function(data) {
                                        $scope.fields = data.field;
                                        $scope.data = data.values;
                                        $scope.totalItems = $scope.data.length;
                                        $scope.currentPage = 1;
                                        $scope.numPerPage = 20;
                                        // fungsi sorting data ASC/DESC
                                        $scope.paginate = function(value) {
                                            var begin, end, index;
                                            begin = ($scope.currentPage - 1) * $scope.numPerPage;
                                            end = begin + $scope.numPerPage;
                                            index = $scope.data.indexOf(value);
                                            return (begin <= index && index < end);
                                        };
                                        $scope.$watch('query', function(query) {
                                            $scope.data = data.values;
                                            $scope.data = $filter('filter')($scope.data, $scope.query);
                                            $scope.totalItems = $scope.data.length;
                                            $scope.currentPage = 1;
                                            $scope.numPerPage = 20;
                                        }, true);
                                        $scope.loading = false;
                                    })
                                }
                            });
                        }
                    };
                }
            },
        };
    });
    app.controller('editpenghargaanpegawaiController', function($scope, $routeParams, dataService, $location) {
        $scope.header = "Edit Data Pelatihan Pegawai";
        // set var statusId yang diambil dari parameter route.
        $scope.statusId = $routeParams.id;
        $scope.idpegawai = $routeParams.subaction;
        $scope.loading = true;
        dataService.get('admin/penghargaanpegawai/create').success(function(data) {
            $scope.penghargaan = data.penghargaan;
        });
        // ambil data dari database dengan ajax
        dataService.edit(url, $scope.statusId).success(function(data) {
            $scope.statusData = data;
            $scope.loading = false;
        });
        // proses edit data saat submit , mengirimkan data via ajax dan disimpan ke dalam database
        $scope.processForm = function(isValid) {
            if (isValid) {
                dataService.update(url, $scope.statusId, $scope.statusData).
                        success(function(data) {
                            if (data.success) {
                                $location.path('/backend/pegawai/edit/' + $scope.idpegawai + '/penghargaanpegawai');
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

    app.controller('newpenghargaanpegawaiController', function($scope, dataService, $location, $routeParams) {
        $scope.statusData = {}; //data awal bernilai array kosong;
        $scope.idpegawai = $routeParams.id
        $scope.header = "Tambah Data Penghargaan Pegawai";
        $scope.opened = false;
        $scope.maxDate = new Date();
        $scope.dateOptions = {
            formatYear: 'yy',
            startingDay: 1
        };
        dataService.get('admin/penghargaanpegawai/create').success(function(data) {
            $scope.penghargaan = data.penghargaan;
        });
        $scope.statusData['id_pegawai'] = $scope.idpegawai;
        $scope.submitted = false; // submitted bernilai false 
        $scope.processForm = function(isValid) { // fungsi dimana saat proses form terjadi
            // jika valid maka akan mengirimkan data ke url admin/penghargaanpegawai dengan $scope.statusData sebagai datanya , dan jika sukses post data maka akan kembali ke base url.
            if (isValid) {
                dataService.save(url, $scope.statusData).
                        success(function(data) {
                            if (data.success) {
                                $location.path('/backend/pegawai/edit/' + $scope.statusData['id_pegawai'] + '/penghargaanpegawai');
                            }
                        }).
                        error(function(data) {
                        });
            } else {
                $scope.submitted = true;
            }
        }
        ;
    });
});