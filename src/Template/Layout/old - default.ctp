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
$setting_data = $this->Amc->GetSettingData();
//var_dump($setting_data);
$cakeDescription = $setting_data['title_name'];
?>
<!DOCTYPE html>
<html>
<head>

    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
	 <?php

		if($setting_data['icon'] == ""){ 
			 echo  $this->Html->meta('icon');
		
		}
		else{ 
	
			echo $this->Html->meta('icon','webroot/img/'.$setting_data['icon']);
		}
		?>
	
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
	<?= $this->Html->css('cropper.css') ?>
	<?= $this->Html->css('main_croper.css') ?>
	<?= $this->Html->css('fileinput.css') ?>
	<?php echo $this->Html->css('school.css');?>
	<?= $this->Html->css('abc.css') ?>
	<?php  $this->Html->css('datatable_bootstrap_min.css');?>
	<?php echo $this->Html->css('amc.css');?>
	<?= $this->Html->script('jquery-2.1.4_min.js')?>
	<script src="<?php echo $this->request->webroot;?>bower_components/sweetalert/sweetalert.min.js"></script>
	<link rel="stylesheet" href="<?php echo $this->request->webroot;?>bower_components/sweetalert/sweetalert.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
	
    <?php echo $this->Html->script('tinymce/tinymce.min.js');?>
     <?php echo $this->Html->script('ckeditor/ckeditor.js');?>
	<?php echo $this->Html->script('datatable_min.js');?>
    <?php echo $this->Html->script('ajax-loading.js');?>
	
    
 
	  
	<!-- Latest compiled and minified CSS -->

<!-- Latest compiled and minified JavaScript -->

	
	<?php echo $this->Html->script('jQueryValidation_en.js'); ?>	
	<?php echo $this->Html->script('jquery_validationEngine.js');?>
	<?php echo $this->Html->script('multiselection.js');?>
    <?php echo $this->Html->script('jquery.datalist.js');?>
	
    
	<?= $this->Html->script('jquery-ui_min.js')?>
	<?= $this->Html->script('moment.min.js')?>
	 <?php echo $this->Html->script('fullcalendar.min.js');?>
	<?= $this->Html->script('pace_min.js')?>
	<?php //echo  $this->Html->script('bootstrap.js')?>
	<?= $this->Html->script('waves.js')?>
	<?= $this->Html->script('fileinput.js')?>
     
    
    <?php echo $this->Html->css("styles_side.css");?>
    <?php echo $this->Html->css("imgareaselect-default.css");?>
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
	
	<?php
		use Cake\Controller\Component;
		use Cake\ORM\TableRegistry; 
		$user_role=$this->request->session()->read('user_role');
		$user_id=$this->request->session()->read('user_id');
		$user_image=$this->request->session()->read('user_image');
	
	?>
	
		<div class="navbar" style="height:60px">
                <div class="navbar-inner">
                    <div class="sidebar-pusher">
                        <a class="waves-effect waves-button waves-classic push-sidebar" href="javascript:void(0);">
                            <i class="fa fa-bars"></i>
                        </a>
                    </div>
                    
                  
                    <div class="search-button">
                        <a class="waves-effect waves-button waves-classic show-search" href="javascript:void(0);"><i class="fa fa-search"></i></a>
                    </div>
					
                    <div class="topmenu-outer">
                        <div class="top-menu">
						<div class="col-md-8 col-sm-8 col-xs-6">
                            <ul class="nav navbar-nav navbar-left">
								<li>
									<div class="page-title">
										<h3>
										
																				
										<?php
										
										if(!empty($setting_data['logo'])){
										$logo = '/img/setting/'.$setting_data['logo'];	
										}else
										{
											$logo = '/img/setting/defultlogo.png';
										}
										
										
										$title = $setting_data['title_name'];
										?>
										                 
									   
										<span class="logo">
											<?php echo $this->Html->image($logo, ['width' => '130','height' => '40','style'=>'']);?>                               
									    </span>
											
											<div class="school_subname">
												<font><?php echo __("$title");?> </font>
											</div>
											<font></font>
										</h3>
									</div>
								</li>
                        
                            </ul>
							</div>
                           <?php
										
										if(!empty($user_image)){
										$user_images = '/img/user/'.$user_image;	
										}else
										{
											$user_images = '/img/user/defultimage.png';
										}
										
										
										
										?>
                            <ul class="nav navbar-nav navbar-right col-md-4 col-sm-4 col-xs-6">
                      
                                <li class="dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle waves-effect waves-button waves-classic" href="#">
									<?php echo $this->Html->image($user_images, ['class' => 'img-circle avatar','id'=>'profileimg','width'=>'40','height'=>'40']); ?>
										<span class="user-name">
											<span id="username" style="">&nbsp;<?php   echo $this->Amc->GetUserFullname($user_id); ?></span>
									<i class="fa fa-angle-down"></i></span>
											
                                    </a>
                                    <ul role="menu" class="dropdown-menu dropdown-list">
										<li role="presentation"><?php  echo $this->Html->link($this->Html->tag('i', '  ', array('class' => 'fa fa-user')) . __('Profile'),['controller' => 'Account', 'action' => 'profilesetting',$user_id],['escape' => false]);?>
                       <li role="presentation"><?php  echo $this->Html->link($this->Html->tag('i', '  ', array('class' => 'fa fa-key m-r-xs')) . __('Change Password'),['controller' => 'users', 'action' => 'changepassword'],['escape' => false]);?>
										<li role="presentation"><?php  echo $this->Html->link($this->Html->tag('i', '  ', array('class' => 'fa fa-sign-out m-r-xs')) . __('Log out'),['controller' => 'Users', 'action' => 'logout'],['escape' => false]);?>
                                    </ul>
                                </li>
                       
                            </ul><!-- Nav -->
                        </div><!-- Top Menu -->
                    </div>
                </div>
            </div>	
		
			<div class="page-sidebar sidebar">
              <div class="slimScrollDiv" style="position: relative;width: auto; height: 100%;"><div class="page-sidebar-inner slimscroll" style="width: auto; height: 100%;">
                   
                    <div id="cssmenu">
                    	<?php 

                    		if($this->request->session()->read('user_role') == 'admin'){
                    			echo $this->element('admin');
                    		}else if($this->request->session()->read('user_role') == 'employee'){
                    			echo $this->element('employee');
                    		}else if($this->request->session()->read('user_role') == 'client'){
								echo $this->element('client');
							}

                    	
                    	?>
                    
                    </div>
				
				<div class="slimScrollBar" style="background: rgb(204, 204, 204) none repeat scroll 0% 0%; width: 7px; position: absolute; top: 0px; opacity: 0.3; display: none; border-radius: 0px; z-index: 99; right: 0px; height: 1088px;"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 0px; background: rgb(51, 51, 51) none repeat scroll 0% 0%; opacity: 0.2; z-index: 90; right: 0px;"></div></div><!-- Page Sidebar Inner -->
            
            </div>
            
            </div>
	<div class="page-inner" style="min-height:700px !important">
			<div class="page-title"></div>
	
    <?= $this->Flash->render() ?>
	
		<div id="main-wrapper">
			<?= $this->fetch('content'); ?>
		</div>
	
    <footer>    

 <div class="panel-group">
  <div class="panel panel-default">
    <div class="panel-body">All rights reserved by AMC Master</div>
  </div>
</div>
	
    </footer>
</div> 
        
        <script>
            $(document).ready(function(){
               $("input[type=search]").focus();
            });
        </script>

</main>
</body>
</html>
