<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url();?>vendor/components/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?=base_url();?>vendor/components/font-awesome/css/all.min.css">
    <script src="<?=base_url();?>vendor/components/jquery/jquery.min.js"></script>
    <title>Document</title>
    <style>
        body {
            font-size: .8em;
        }

        #top-header {
            background-color: #300e6a;
            color: rgba(255, 255, 255, 0.7);
        }

        #top-header-menu {
            list-style-type: none;
            margin-block-start: 0;
            margin-block-end: 0;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            padding-inline-start: 0;
        }

        #top-header-menu li {
            display: inline-block;
            line-height: 50px;
        }

        #top-header-menu li a {
            display: inline-block;
            line-height: 50px;
            margin: 0 7px;
            color: inherit;
        }



        #main-header {
            background-color: #4a1b9d;
            position: relative;
        }
        #main-header .logo-container{
            display: inline-block;
            height: 72px;
            line-height: 72px;
        }
        #main-header .logo-container img{
            display: inline-block;
            line-height: 72px;
            max-height: 60%;
        }
        #main-header #main-header-menu{
            font-size: 1.3em;
            text-transform: uppercase;
            color: #fff;
            list-style-type: none;
            margin-block-start: 0;
            margin-block-end: 0;
            margin-inline-start: 0px;
            margin-inline-end: 0px;
            padding-inline-start: 0;
        }
        #main-header #main-header-menu li{
            display: inline-block;
            line-height: 72px;
        }
        #main-header #main-header-menu li a{
            display: inline-block;
            line-height: 72px;
            margin: 0 7px;
            color: inherit;
        }
        #main-header::after{
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #f9a007;
            height: 3pt;
        }

        #content-wrapper{
            min-height: 50vh;
        }


        #top-footer{
            background-color: #4c16a7!important;
            position: relative;
            color: #fff;
        }
        #top-footer::after{
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            background-color: #f9a007;
            height: 3pt;
        }
        #top-footer #widget-bottom{
            font-size: 1.2em;
        }
    </style>
</head>