define(['app'], function(app) {
    var url = 'admin/satuankerja';
    app.controller('editsatuankerjaController', function($scope, $routeParams, dataService, $location) {
        $scope.header = "Edit Data Satuan Kerja";
        // set var statusId yang diambil dari parameter route.
        $scope.statusId = $routeParams;
        $scope.loading = true;
        $scope.submitted = false;
        $scope.unitkerja = [];
        // ambil data dari database dengan ajax
        dataService.edit(url, $scope.statusId).success(function(data) {
            $scope.statusData = data.value;
            $scope.unitkerja = data.unitkerja;
            $scope.loading = false;
        });
        // proses edit data saat submit , mengirimkan data via ajax dan disimpan ke dalam database
        $scope.processForm = function(isValid) {
            if (isValid) {
                dataService.update(url, $scope.statusId, $scope.statusData).
                        success(function(data) {
                            if (data.success) {
                                $location.path('/backend/satuankerja');
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

    app.controller('newsatuankerjaController', function($scope, dataService, $location) {
        $scope.header = "Tambah Data Satuan Kerja";
        $scope.statusData = {}; //data awal bernilai array kosong;
        $scope.submitted = false; // submitted bernilai false 
        $scope.unitkerja = [];
        dataService.get('admin/dropdownunitkerja').success(function(data) {
            $scope.unitkerja = data.dropdown;
        });
        $scope.processForm = function(isValid) { // fungsi dimana saat proses form terjadi
            // jika valid maka akan mengirimkan data ke url admin/backend/satuankerja dengan $scope.statusData sebagai datanya , dan jika sukses post data maka akan kembali ke base url.
            if (isValid) {
                dataService.save(url, $scope.statusData).
                        success(function(data) {
                            if (data.success) {
                                $location.path('/backend/satuankerja');
                            }
                        }).
                        error(function(data) {
                        });
            } else {
                $scope.submitted = true;
            }
        };
    });
    app.controller('listsatuankerjaController', function($scope, $filter, dataService, $location) {
        $scope.header = "Data Satuan Kerja";
        $scope.statuses = {}; // data statuses awal yang merupakan array kosong.
        $scope.loading = true; // loading icon bernilai true
        getSatker(); // memanggil fungsi getSatker()
        // fungsi untuk menuju halaman edit data
        $scope.edit = function(id) {
            $location.path('/backend/satuankerja/edit/' + id);
        };
        $scope.sort = function(field) {
            $scope.statuses = $filter('orderBy')($scope.statuses, field, $scope.sort.order);
            $scope.sort.field = field;
            $scope.sort.order = !$scope.sort.order;
        }
        $scope.sort.field = 'nama_satuan_kerja';
        $scope.sort.order = false;
        // fungsi untuk delete data
        $scope.delete = function(id) {
            if (confirm("Anda yakin untuk menghapus data?") === true) {
                dataService.destroy(url, id).success(function(data) {
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
