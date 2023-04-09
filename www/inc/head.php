<?php
include $_SERVER['DOCUMENT_ROOT']."/lib_inc.php";
include $_SERVER['DOCUMENT_ROOT']."/config_mng_inc.php";
include $_SERVER['DOCUMENT_ROOT']."/inc/language.php"; //언어셋 파일

$v_txt = "20220901";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="canonical" href="<?=STATIC_HTTP?>">
    <meta name="Author" contents="<?=APP_TITLE?>">
    <meta name="Publisher" content="<?=APP_TITLE?>">
    <meta name="Other Agent" content="<?=APP_TITLE?>">
    <meta name="copyright" content="<?=APP_TITLE?>">
    <meta name="Generator" content="<?=APP_TITLE?>">
    <meta name="Keywords" content="<?=KEYWORDS?>">
    <meta name="Description" content="<?=DESCRIPTION?>">
    <meta name="subject" content="<?=APP_TITLE?>">
    <meta name="title" content="<?=APP_TITLE?>">
    <meta name="Distribution" content="<?=DESCRIPTION?>">
    <meta name="description" content="<?=DESCRIPTION?>">
    <meta name="Descript-xion" content="<?=KEYWORDS?>">
    <meta name="keywords" content="<?=KEYWORDS?>">
    <meta itemprop="name" content="<?=APP_TITLE?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
    <meta property="og:author" content="<?=APP_TITLE?>">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="<?=APP_TITLE?>">
    <meta property="og:image" content="./img/market_graphic.png">
    <meta property="og:image:width" content="1066">
    <meta property="og:image:height" content="558">
    <meta property="og:url" content="http://<?=APP_DOMAIN?>">
    <meta property="og:title" id="ogtitle" itemprop="name" content="<?=APP_TITLE?>">
    <meta property="og:description" content="<?=DESCRIPTION?>">
    <title><?=APP_TITLE?></title>
    <meta name="apple-mobile-web-app-title" content="<?=APP_TITLE?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?=CDN_HTTP?>/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?=CDN_HTTP?>/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?=CDN_HTTP?>/images/favicon-16x16.png">
    <link rel="manifest" href="<?=CDN_HTTP?>/images/menifest.json">
    <link rel="mask-icon" href="<?=CDN_HTTP?>/images/safari-pinned-tab.svg" color="#ffffff">
    <meta name="msapplication-TileColor" content="#2d89ef">
    <meta name="theme-color" content="#ffffff">

    <meta name="referrer" content="no-referrer-when-downgrade">
    <meta name="robots" content="all">


    <!-- CSS -->    
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">-->
    <link rel="stylesheet" href="./css/bootstrap.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="./css/custom.css">
    <link rel="stylesheet" href="./css/common.css">
    <link rel="stylesheet" href="./css/design.css">

    <!-- ICON & FONT-->    
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">    
    <link rel="icon" type="image/png"  href="./img/favicon.png">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link rel="preconnect" href="https://fonts.googleapis.com">    

    <!--JS-->
    <script src="./js/jquery-1.12.4.min.js"></script>
    <script src="./js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <script src="./js/common.js"></script>
    <script src="./js/default.js"></script>
</head>
