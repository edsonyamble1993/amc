<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'TAM - Annual Maintenance Contract';
?>
<!DOCTYPE html>
<html>
<head>
<style type="text/css">
.page-content {
    background: #34425a !important;
}
.page-inner {
    height: 1000px;
}
.navbar .logo-box {
	 width: 162px !important;
    text-align:center;
}
.menu.accordion-menu a {
    padding-left: 55px !important;
    text-align: left !important;
}
.waves-effect.waves-button {
    float: left;
    width: 100%;
}
.menu-icon {
    float: left;
    margin: 0 !important;
	padding: 15px 0 0 20px;
}
.menu-icon img {
    float: left !important;
	padding-right: 10px;
}
.waves-effect.waves-button > p {
    float: left;
    padding-left: 15px;
}
.arrow {
    display: none;
}
.menu.accordion-menu > li > a, body:not(.page-horizontal-bar):not(.small-sidebar) .menu.accordion-menu a {
    text-align: left;
}
#dashboard .panel-heading {
    background: #f4f4f4 none repeat scroll 0 0;
    border: 1px solid #ddd !important;
}
.col-md-6.daily_summary {
    padding-left: 0px;
    padding-right: 0px;
}
.col-md-6.status_summary {
    padding-right: 0px;
}
.col-md-12.reminder {
    padding-left: 0;
    padding-right: 0;
}
.dataTables_length {
    float: left;
}
</style>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
    <?= $this->Html->meta('icon') ?>
	
	<?= $this->Html->css('jquery-ui.css') ?>
	<?= $this->Html->css('googleaps.css') ?>
	<?= $this->Html->css('fullcalender.css') ?>
	<?= $this->Html->css('themeflash.css') ?>

	<?= $this->Html->css('bootstrap.min.css') ?>
	<?= $this->Html->css('datatable_bootstrap_min.css') ?>
	<?= $this->Html->css('font_awesome.css') ?>
	<?= $this->Html->css('simple-line-icons.css') ?>
	<?= $this->Html->css('validationEngine_jquery.css') ?>
	<?= $this->Html->css('menu_cornerbox.css') ?>
	<?= $this->Html->css('waves_min.css') ?>
	<?= $this->Html->css('switchery.css') ?>
	<?= $this->Html->css('component.css') ?>
	<?= $this->Html->css('weather.css') ?>
	<?= $this->Html->css('MetroJs.css') ?>
	<?= $this->Html->css('toastr.css') ?>
	<?= $this->Html->css('modern_min.css') ?>
	<?= $this->Html->css('style1.css') ?>
	<?= $this->Html->css('green.css') ?>
	<?= $this->Html->css('custom.css') ?>
	<?= $this->Html->css('fileinput.css') ?>
	<?php echo $this->Html->css('school.css');?>
	<?= $this->Html->css('abc.css') ?>
	   <?php echo $this->Html->css('datatable_bootstrap_min.css');?>
	<?php echo $this->Html->css('amc.css');?>
	<?= $this->Html->script('jquery-2.1.4_min.js')?>

    <?php echo $this->Html->script('tinymce/tinymce.min.js');?>
     <?php echo $this->Html->script('ckeditor/ckeditor.js');?>
	<?php echo $this->Html->script('datatable_min.js');?>
 
	  
	<!-- Latest compiled and minified CSS -->

<!-- Latest compiled and minified JavaScript -->

	
	<?php echo $this->Html->script('jQueryValidation_en.js'); ?>	
	<?php echo $this->Html->script('jquery_validationEngine.js');?>
	<?php echo $this->Html->script('multiselection.js');?>
    <?php echo $this->Html->script('jquery.datalist.js');?>
	
    
	<?= $this->Html->script('jquery-ui_min.js')?>
	<?= $this->Html->script('pace_min.js')?>
	<?php //echo  $this->Html->script('bootstrap.js')?>
	<?= $this->Html->script('waves.js')?>
	<?= $this->Html->script('fileinput.js')?>
<?= $this->Html->script('bootstrap.min.js')?>
 <?php echo $this->Html->css("styles_side.css");?>
<!-- <?= $this->Html->script('http://code.jquery.com/jquery-latest.min.js');?> -->
  
	<style type="text/css">
		.page-header-fixed .page-sidebar {
    padding-top: 60px !important;
}		
	</style>
			
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
    
</head>

<body class="page-header-fixed pace-done">
   
	<main class="page-content content-wrap">
	<div class="page-inner" style="min-height:0px !important">
			<div class="page-title"></div>
	
    <?= $this->Flash->render() ?>
	
<div id="main-wrapper">
			<?= $this->fetch('content'); ?>
		</div>
		</div>
		</main>
</body>