<?php session_start(); ?>
<?php ob_start(); ?>
<?php header('Strict-Transport-Security: max-age=31536000; includeSubDomains'); ?>
<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
    <title>All Pass 管理員後台</title>
    <link rel=stylesheet type="text/css" href="./source/css/materialize.min.css">
    <link rel=stylesheet type="text/css" href="./source/css/style.css">
    <link rel=stylesheet type="text/css" href="./source/css/icon.css">
</head>
<?php include("backend-nav.php"); ?>
