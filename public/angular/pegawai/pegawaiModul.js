define(['app'], function(app) {
    var url = 'admin/pegawai';
    app.directive('ngEdit', function() {
        return {
            restrict: 'E',
            templateUrl: 'view/pegawai/edit.html'
        }
    });
    app.directive('ngPegawai', function() {
        return {
            restrict: 'E',
            templateUrl: 'view/pegawai/editpegawai.html',
            controller: function($scope, $routeParams, dataService, $location) {
                if (!$routeParams.action) {
                    $scope.header = 'Edit Data ' + $routeParams.data;
                }
            }
        }
    })
    app.directive('dateValidator', function() {
        return {
            require: 'ngModel',
            link: function(scope, elem, attr, ngModel) {
                function validate(value) {
                    // it is a date
                    if (value !== undefined && value != null) {
                        ngModel.$setValidity('badDate', true);
                        if (value instanceof Date) {
                            var d = Date.parse(value);
                            // it is a date
                            if (isNaN(d)) {
                                ngModel.$setValidity('badDate', false);
                            }
                        } else {
                            var myPattern = new RegExp(/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/);
                            if (value != '' && !myPattern.test(value)) {
                                ngModel.$setValidity('badDate', false);
                            }
                        }
                    }
                }
                scope.$watch(function() {
                    return ngModel.$viewValue;
                }, validate);
            }
        };
    });
    app.controller('editpegawaiController', function($scope, $routeParams, dataService, $location) {
        $scope.data = $routeParams.data;
        $scope.kampret = true;
        // set var statusId yang diambil dari parameter route.
        $scope.statusId = $routeParams.id;
        $scope.loading = true;
        $scope.submitted = false;
        $scope.opened = false;
        $scope.openedtgl = false;
        $scope.openedsk = false;
        $scope.openedmulai = false;
        $scope.openedselesai = false;
        $scope.dateOptions = {
            formatYear: 'yy',
            startingDay: 1
        };
        $scope.status = [];
        dataService.get('admin/pegawai/create').success(function(data) {
            $scope.status = data.status;
            $scope.golongan = data.golongan;
            $scope.jabatan = data.jabatan;
            $scope.statusjabatan = data.statusjabatan;
            $scope.unitkerja = data.unitkerja;
            $scope.satuankerja = data.satuankerja;
            $scope.lokasikerja = data.lokasikerja;
            $scope.eselon = data.eselon;
        });
        $scope.maxDate = new Date();
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
                                $location.path('/backend/pegawai');
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

    app.controller('newpegawaiController', function($scope, dataService, $location, $compile, $upload, $routeParams) {
        $scope.kampret = false;
        $scope.data = 'pegawai';
        $scope.header = "Tambah Data Pegawai";
        $scope.opened = false;
        $scope.openedtgl = false;
        $scope.openedsk = false;
        $scope.openedmulai = false;
        $scope.openedselesai = false;
        $scope.dateOptions = {
            formatYear: 'yy',
            startingDay: 1
        };
        dataService.get('admin/pegawai/create').success(function(data) {
            $scope.status = data.status;
            $scope.golongan = data.golongan;
            $scope.jabatan = data.jabatan;
            $scope.statusjabatan = data.statusjabatan;
            $scope.unitkerja = data.unitkerja;
            $scope.satuankerja = data.satuankerja;
            $scope.lokasikerja = data.lokasikerja;
            $scope.eselon = data.eselon;
        });
        $scope.maxDate = new Date();
        $scope.statusData = {}; //data awal bernilai array kosong;
        $scope.submitted = false; // submitted bernilai false 

        $scope.processForm = function(isValid) { // fungsi dimana saat proses form terjadi
            // jika valid maka akan mengirimkan data ke url admin/backend/pegawai dengan $scope.statusData sebagai datanya , dan jika sukses post data maka akan kembali ke base url.
            if (isValid) {
                if ($scope.statusData.foto) {
                    $upload.upload({
                        url: url,
                        method: 'POST',
                        file: $scope.statusData.foto,
                        data: $scope.statusData
                    }).success(function(data, status, headers, config) {
                        console.log(data);
                    });

                } else {
                    dataService.save(url, $scope.statusData).
                            success(function(data) {
                                if (data.success) {
                                    $location.path('/backend/pegawai');
                                }
                            }).
                            error(function(data) {
                            });
                }
            } else {
                $scope.submitted = true;
            }
        };
    });
    app.controller('listpegawaiController', function($scope, $filter, dataService, $location, $window) {
        $scope.header = "Data Pegawai";
        $scope.statuses = {}; // data statuses awal yang merupakan array kosong.
        $scope.loading = true; // loading icon bernilai true
        getPegawai(); // memanggil fungsi getPegawai()
        // fungsi untuk menuju halaman edit data
        $scope.edit = function(id) {
            $location.path('/backend/pegawai/edit/' + id);
        };
        $scope.sort = function(field) {
            $scope.statuses = $filter('orderBy')($scope.statuses, field, $scope.sort.order);
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
                        getPegawai();
                    }
                });
            }
        };
        function getPegawai() {
            dataService.get(url).success(function(data) {
                $scope.fields = data.field;
                $scope.statuses = data.values;
                $scope.totalItems = $scope.statuses.length;
                $scope.currentPage = 1;
                $scope.numPerPage = 20;
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
                    $scope.numPerPage = 20;
                }, true);
                $scope.loading = false;
            })
        }

    });

}); // load aplikasi dengan nama myApp dan plugin ngRoute dan ui.bootstrap