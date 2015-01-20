<html lang="en">
    <head>
        <meta charset="UTF-8">        
        <base href="/">
        <title>Laravel & Angular Data Status</title>

        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css"> <!-- load bootstrap via cdn -->
        <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css"> 
        <link rel="stylesheet" href="<?php echo asset('flowplayer/skin/minimalist.css'); ?>" />
        <style>
            .nav, .pagination, .carousel, .panel-title a { cursor: pointer; }
        </style>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
        <script src="<?php echo asset('flowplayer/flowplayer.min.js'); ?>"></script>
        <script>
            flowplayer.conf = {
                live: true, // mandatory with live streams
                rtmp: "rtmp://93.174.95.125:1935/edge/_definst_/nz7l9vc5nv1og7b",
                ratio: 9 / 16
            };
        </script>
    </head>
    <body class="container">
        <div class="flowplayer play-button fixed-controls">

            <video>
                <source type="video/flash" src="stream">
            </video>

        </div>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    </body>
</html>