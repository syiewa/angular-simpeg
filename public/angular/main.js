require.config({
    baseUrl: "angular",
    // alias libraries paths.  Must set 'angular'
    paths: {
        'jquery': '../lib/jquery.min',
        'bootstrap': '../bootstrap/js/bootstrap.min',
        'angular': '../lib/angular.min',
        'angular-route': 'services/angular-route.min',
        'angularAMD': 'services/angularAMD.min',
        'ui-bootstrap': 'services/ui-bootstrap-tpls-0.12.0.min',
        'ngScrollSpy': 'services/ngScrollSpy.min',
        'angularFileUpload': 'services/angular-file-upload.min',
        'angularFileUploadShim': 'services/angular-file-upload-shim.min',
        'golongan': 'golongan/golonganModul',
        'statuspegawai': 'statuspegawai/statusPegawaiModul',
        'eselon': 'eselon/eselonModul',
        'unitkerja': 'unitkerja/unitkerjaModul',
        'satuankerja': 'satuankerja/satuankerjaModul',
        'ppk': 'ppk/ppkModul',
        'pelatihan': 'pelatihan/pelatihanModul',
        'jabatan': 'jabatan/jabatanModul',
        'statusjabatan': 'statusjabatan/statusjabatanModul',
        'penghargaan': 'penghargaan/penghargaanModul',
        'hukuman': 'hukuman/hukumanModul',
        'lokasipelatihan': 'lokasipelatihan/lokasipelatihanModul',
        'lokasikerja': 'lokasikerja/lokasiKerjaModul',
        'pegawai': 'pegawai/pegawaiModul',
        'keluarga': 'keluarga/keluargaModul',
        'riwayatpangkat': 'riwayatpangkat/riwayatpangkatModul',
        'riwayatjabatan': 'riwayatjabatan/riwayatjabatanModul',
        'pendidikan': 'pendidikan/pendidikanModul',
        'pelatihanpegawai': 'pelatihanpegawai/pelatihanpegawaiModul',
        'penghargaanpegawai': 'penghargaanpegawai/penghargaanpegawaiModul',
        'seminar': 'seminar/seminarModul',
        'organisasi': 'organisasi/organisasiModul',
        'gajipokok': 'gajipokok/gajipokokModul',
        'hukumanpegawai': 'hukumanpegawai/hukumanpegawaiModul',
        'dp3': 'dp3/dp3Modul',
        'home': 'home/homeModul',
        'users': 'users/usersModul'
    },
    // Add angular modules that does not support AMD out of the box, put it in a shim
    shim: {
        'angularAMD': ['angular'],
        'angular-route': ['angular'],
        'ui-bootstrap': ['angular'],
        'ngScrollSpy': ['angular'],
        'angularFileUpload': ['angular'],
        'angularFileUploadShim': ['angular'],
        'bootstrap': {"deps": ['jquery']},
    },
    // kick start application
    deps: ['app']
});
require(['jquery', 'bootstrap', 'home', 'golongan','gajipokok','dp3','seminar','hukumanpegawai','organisasi', 'keluarga','users', 'riwayatpangkat', 'riwayatjabatan', 'penghargaanpegawai', 'pendidikan', 'pelatihanpegawai', 'statuspegawai', 'eselon', 'unitkerja', 'satuankerja', 'ppk', 'pelatihan', 'jabatan', 'statusjabatan', 'penghargaan', 'hukuman', 'lokasipelatihan', 'lokasikerja', 'pegawai'], function($) {
    return {};
});
