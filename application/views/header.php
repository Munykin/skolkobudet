<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?=$title;?></title>
    <?if ( $loged!== FALSE) { echo'<meta name="robots" content="noindex, nofollow" />';}?>
    
    <link rel="icon" type="image/png" href="<?=base_url()?>favicon.png" />
    <link rel="apple-touch-icon-precomposed" href="<?=base_url()?>apple-favicon.png"/>    
    <link rel="stylesheet" href="<?=base_url()?>css/screen.css" type="text/css" media="screen, projection"/>
    <!--[if lt IE 8]><link rel="stylesheet" href="<?=base_url()?>css/ie.css" type="text/css" media="screen, projection"/><![endif]-->
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/style.css" type="text/css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/chosen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/jquery.jgrowl.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?=base_url()?>css/tipsy.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>javascript/fancyBox/source/jquery.fancybox.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?=base_url()?>javascript/coda-slider-2.0/stylesheets/coda-slider-2.0.css" media="screen" />
    <script type="text/javascript" src="<?=base_url()?>js/jquery.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/jquery.blockUI.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/chosen.jquery.min.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/jquery.jgrowl.js"></script>
    <script type="text/javascript" src="<?=base_url()?>js/jquery.tipsy.js"></script>
	<script type="text/javascript" src="<?=base_url()?>javascript/fancyBox/source/jquery.fancybox.js"></script>
	<script type="text/javascript" src="<?=base_url()?>javascript/carouFredSel-5.5.0/jquery.carouFredSel-5.5.0-packed.js"></script>
	<script type="text/javascript" src="<?=base_url()?>javascript/coda-slider-2.0/javascripts/jquery.easing.1.3.js"></script>
	<script type="text/javascript" src="<?=base_url()?>javascript/coda-slider-2.0/javascripts/jquery.coda-slider-2.0.js"></script>
	<script type="text/javascript" src="<?=base_url()?>js/customer.js"></script>
</head>
<body>
<div class="container">
    <div class="span-24" id="header">
        <div class="span-17 rel">
        <a id="logo" href="<?=base_url()?>" style="text-decoration: none;"></a>
        <div id="desc"></div>
        &nbsp;
        </div>
        <div id="login" class="span-7 last">
            <?php if($loged === FALSE){ $this->load->view('loginform'); } else { $this->load->view('logedin'); }?>
        </div>
        <div class="clear"></div>
    </div><div class="clear"></div>
</div>
    <?php /* СТРОКА МЕНЮ */?>
<div class="container">
    <div class="span-24" id="mainmenu">
        <ul>
            <li<?php if($curentpage=='home') {echo ' class="curent"';}?>>
                <a href="<?=base_url()?>">Онлайн-рассчет<span>стоимости квартиры</span></a>
            </li><li<?php if($curentpage=='analytics') {echo ' class="curent"';}?>>
                <a href="<?=base_url()?>analytics/">Анализы<span>рынка</span></a>
            </li><li<?php if($curentpage=='advices') {echo ' class="curent"';}?>>
                <a href="<?=base_url()?>advices/">Советы<span>эксперта</span></a>
            </li><li<?php if($curentpage=='about') {echo ' class="curent"';}?>>
                <a href="<?=base_url()?>about/">О сервисе</a>
            </li>
        </ul>
    </div>
    <div class="clear"></div>
</div>
<?php /* /СТРОКА МЕНЮ */?>