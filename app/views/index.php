<html lang="en">
    <head>
        <meta charset="UTF-8">        
        <base href="/">
        <title>Sistem Informasi Pegawai</title>

        <link rel="stylesheet" href="<?php echo asset('bootstrap/css/bootstrap.css'); ?>"> <!-- load bootstrap via cdn -->
        <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css"> 
        <style>
            .nav, .pagination, .carousel, .panel-title a { cursor: pointer; }
            body { padding-top: 70px; }
            .nav-tabs > .active > a, .nav-tabs > .active > a:hover { 
                outline: 0;
                color: #555555;
                background-color: #ffffff;
                border: 1px solid #ddd;
                border-bottom-color: transparent;
                cursor: default;
            }
            .air {
                position: fixed;
                top:0px;
                width:225px;
            }
        </style>
        <script data-main="angular/main.js" src="//marcoslin.github.io/angularAMD/js/lib/requirejs/require.js"></script>
    </head>
    <body>
    <ng-header class="navbar navbar-default navbar-fixed-top ui-scrollfix" role="navigation" ui-scrollfix="+0"></ng-header> 
</div>
<div class="container">
    <!--        Loading icon -->
    <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>
    <!--        div dimana untuk menampilkan konten-->
    <div ng-view ng-hide="loading"></div>
</div>
<ng-footer class="footer"></ng-footer>
</body>
</html>