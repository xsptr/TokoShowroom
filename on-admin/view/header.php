<?php
session_start();
if (!isset($_SESSION['admin']) || empty($_SESSION['admin'])){
  header("location: ../index.php");
}
include 'config/koneksi.php';
include 'config/fungsi_indotgl.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="Creative - Bootstrap 3 Responsive Admin Template">
  <meta name="author" content="GeeksLabs">
  <meta name="keyword" content="Creative, Dashboard, Admin, Template, Theme, Bootstrap, Responsive, Retina, Minimal">
  <link rel="shortcut icon" href="img/favicon.png">

  <title>Silvana 221 Motor - Admin Page</title>

  <!-- Bootstrap CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap theme -->
  <link href="css/bootstrap-theme.css" rel="stylesheet">
  <!-- external css -->
  <!-- font icon -->
  <link href="css/elegant-icons-style.css" rel="stylesheet">
  <link href="css/all.min.css" rel="stylesheet">
  <link href="css/daterangepicker.css" rel="stylesheet">
  <link href="css/bootstrap-datepicker.css" rel="stylesheet">
  <link href="css/bootstrap-colorpicker.css" rel="stylesheet">
  <!-- date picker -->

  <!-- color picker -->

  <!-- Custom styles -->
  <link href="css/style.css" rel="stylesheet">
  <link href="css/style-responsive.css" rel="stylesheet">

<!-- HTML5 shim and Respond.js IE8 support of HTMl5 -->
<!-- [if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <script src="js/lte-ie7.js"</script>
    <![endif]-->



  <!-- =======================================================
    Theme Name: NiceAdmin
    Theme URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
    Author: BootstrapMade
    Author URL: https://bootstrapmade.com
    PHP&Customize: Esaputra
  ======================================================= -->
</head>

<body>