<?php
#Connect to Database
require 'inc/dbconnect.inc.php';
require 'inc/functions.inc.php';

#Get Page Information
$currentFile = $_SERVER["PHP_SELF"];
$parts = Explode('/', $currentFile);
$current_page =  $parts[count($parts) - 1];

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>AFT</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap-select.min.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div id = "aiesec_topbanner">
          <a href = "https://www.aiesec.org/">
              <img src = "https://s3-eu-west-1.amazonaws.com/aiesecorg/static/img/logo_white.png" alt = "AIESEC Logo"/></a>

          <ul class="pull-right" id = "nav">
              <li><a href = "https://www.aiesec.org/#/home">AIESEC Home</a></li>
              <!-- ><li class = "sel"><a href = "#">I'm Selected!</a></li> -->
              <li><a href = "https://opportunities.aiesec.org">Opportunities</a></li>
              <li><a href = "http://blog.aiesec.org">Blog</a></li>
              
          </ul>

          <div class = "clearfix"></div>
        </div>
      <div class="container-full">
        <div class="navbar-collapse collapse">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">AFT</a>
        </div>
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="how-to-use.php">How to Use</a></li>
            <li><a href="aft.php">Available Form Tracker</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
