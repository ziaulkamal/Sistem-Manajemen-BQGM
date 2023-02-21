<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keywords" content="">
    <title><?php if (!isset($title)) {
        echo "Dev By Zia";
    }else{
        echo $title;
    } ?></title>
    <link href="<?= base_url ('custom_me.css') ?>" rel="stylesheet">
    <link rel="shortcut icon" href="<?= base_url ('public/') ?>assets/images/favicon.png" />
    <link rel="stylesheet" href="<?= base_url ('public/') ?>assets/vendors/core/core.css">
    <link rel="stylesheet" href="<?= base_url ('public/') ?>assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="<?= base_url ('public/') ?>assets/css/demo1/style.css">
    <link rel="stylesheet" href="<?= base_url ('public/') ?>assets/vendors/prismjs/themes/prism.css">
    <link rel="stylesheet" href="<?= base_url ('public/') ?>assets/vendors/flatpickr/flatpickr.min.css">
    <link rel="stylesheet" href="<?= base_url ('public/') ?>assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
    <link rel="stylesheet" href="<?= base_url ('public/') ?>assets/vendors/sweetalert2/sweetalert2.min.css">
    <script src="<?= base_url ('public/') ?>assets/extra/xlsx.full.min.js"></script>
  </head>
  <body class="sidebar-dark">
    <div class="main-wrapper">