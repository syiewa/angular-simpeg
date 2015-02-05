<html>
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
            .subnav.affix {
                position :fixed;
                width: 100%;
                left: 0;
                right: 0;
                top: 40px;
                z-index:10;
                background: white;
                border: 1px solid #e5e5e5;
                margin-bottom: 40px;
            }
            .subnav{
                margin-bottom: 20px;
            }
            .panel{
                margin-top: 40px;
            }
        </style>
        <script data-main="angular/main.js" src="//marcoslin.github.io/angularAMD/js/lib/requirejs/require.js"></script>
    </head>
    <body>
    <ng-header class="navbar navbar-default navbar-fixed-top" role="navigation"></ng-header> 
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