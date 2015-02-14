<html>
    <head>
        <meta charset="UTF-8">        
        <base href="/">
        <title>Sistem Informasi Pegawai</title>

        <link rel="stylesheet" href="<?php echo asset('bootstrap/css/bootstrap.css'); ?>"> <!-- load bootstrap via cdn -->
        <link rel="stylesheet" href="<?php echo asset('lib/font-awesome-4.3.0/css/font-awesome.min.css'); ?>"> 
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
            .tabs-below > .nav-tabs,
            .tabs-right > .nav-tabs,
            .tabs-left > .nav-tabs {
                border-bottom: 0;
            }

            .tab-content > .tab-pane,
            .pill-content > .pill-pane {
                display: none;
            }

            .tab-content > .active,
            .pill-content > .active {
                display: block;
            }

            .tabs-below > .nav-tabs {
                border-top: 1px solid #ddd;
            }

            .tabs-below > .nav-tabs > li {
                margin-top: -1px;
                margin-bottom: 0;
            }

            .tabs-below > .nav-tabs > li > a {
                -webkit-border-radius: 0 0 4px 4px;
                -moz-border-radius: 0 0 4px 4px;
                border-radius: 0 0 4px 4px;
            }

            .tabs-below > .nav-tabs > li > a:hover,
            .tabs-below > .nav-tabs > li > a:focus {
                border-top-color: #ddd;
                border-bottom-color: transparent;
            }

            .tabs-below > .nav-tabs > .active > a,
            .tabs-below > .nav-tabs > .active > a:hover,
            .tabs-below > .nav-tabs > .active > a:focus {
                border-color: transparent #ddd #ddd #ddd;
            }

            .tabs-left > .nav-tabs > li,
            .tabs-right > .nav-tabs > li {
                float: none;
            }

            .tabs-left > .nav-tabs > li > a,
            .tabs-right > .nav-tabs > li > a {
                min-width: 74px;
                margin-right: 0;
                margin-bottom: 3px;
            }

            .tabs-left > .nav-tabs {
                float: left;
                margin-right: 19px;
                border-right: 1px solid #ddd;
            }

            .tabs-left > .nav-tabs > li > a {
                margin-right: -1px;
                -webkit-border-radius: 4px 0 0 4px;
                -moz-border-radius: 4px 0 0 4px;
                border-radius: 4px 0 0 4px;
            }

            .tabs-left > .nav-tabs > li > a:hover,
            .tabs-left > .nav-tabs > li > a:focus {
                border-color: #eeeeee #dddddd #eeeeee #eeeeee;
            }

            .tabs-left > .nav-tabs .active > a,
            .tabs-left > .nav-tabs .active > a:hover,
            .tabs-left > .nav-tabs .active > a:focus {
                border-color: #ddd transparent #ddd #ddd;
                *border-right-color: #ffffff;
            }

            .tabs-right > .nav-tabs {
                float: right;
                margin-left: 19px;
                border-left: 1px solid #ddd;
            }

            .tabs-right > .nav-tabs > li > a {
                margin-left: -1px;
                -webkit-border-radius: 0 4px 4px 0;
                -moz-border-radius: 0 4px 4px 0;
                border-radius: 0 4px 4px 0;
            }

            .tabs-right > .nav-tabs > li > a:hover,
            .tabs-right > .nav-tabs > li > a:focus {
                border-color: #eeeeee #eeeeee #eeeeee #dddddd;
            }

            .tabs-right > .nav-tabs .active > a,
            .tabs-right > .nav-tabs .active > a:hover,
            .tabs-right > .nav-tabs .active > a:focus {
                border-color: #ddd #ddd #ddd transparent;
                *border-left-color: #ffffff;
            }
        </style>
        <script data-main="angular/main.js" src="<?php echo asset('lib/require.js'); ?>"></script>
    </head>
    <body>
    <ng-header class="navbar navbar-default navbar-fixed-top" role="navigation"></ng-header> 
    <div class="container">
        <!--        Loading icon -->
        <p class="text-center" ng-show="loading"><span class="fa fa-meh-o fa-5x fa-spin"></span></p>
        <!--        div dimana untuk menampilkan konten-->
        <div ng-view ng-hide="loading"></div>
    </div>
    <ng-footer class="footer"></ng-footer>
</body>
</html>