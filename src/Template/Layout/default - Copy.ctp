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
<!--	<?= $this->Html->css('uniform_default_min.css') ?> -->
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
    <?php echo $this->Html->script('ajax-loading.js');?>
    
 
	  
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
                        <!--            <li role="presentation"><a href="calendar.html"><i class="fa fa-calendar"></i>Calendar</a></li>
                                        <li role="presentation"><a href="inbox.html"><i class="fa fa-envelope"></i>Inbox<span class="badge badge-success pull-right">4</span></a></li>
                                        <li class="divider" role="presentation"></li>
                                        <li role="presentation"><a href="lock-screen.html"><i class="fa fa-lock"></i>Lock screen</a></li> -->
                                        <li role="presentation"><?php  echo $this->Html->link($this->Html->tag('i', '  ', array('class' => 'fa fa-key m-r-xs')) . __('Change Password'),['controller' => 'Changepassword', 'action' => 'changepassword'],['escape' => false]);?>
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
                    	
                    
                    <ul>
                    
<li class=""><i class="fa fa-tachometer image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Dashboard'),['controller' => 'Dashboard', 'action' => 'dashboard']);?></a>
   </li>
                    <?php  if($this->Amc->findstatus($user_role,'company')==1 || $this->Amc->findstatus($user_role,'product')==1 || $this->Amc->findstatus($user_role,'purchase')==1 || $this->Amc->findstatus($user_role,'amc_warranty')==1) {?>	
					<li class="has-sub"><i class="fa fa-user image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Master'),['controller' => 'company', 'action' => 'companylist']);?>
					
				
						<ul>
							<?php if($this->Amc->findstatus($user_role,'purchase')==1){   ?>
        					<li class='has-sub'><i class="fa fa-shopping-cart image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Purchase'),['controller' => 'Purchase', 'action' => 'viewpurchase']);?>
           				 		<ul>
              						<li><?php echo $this->Html->link(__('Add Purchase'),['controller' => 'Purchase', 'action' => 'purchase']);?></li>
									<li><?php echo $this->Html->link(__('Purchase List'),['controller' => 'Purchase', 'action' => 'viewpurchase']);?></li>
									
           				   	   </ul>
        					</li>
        					<?php } ?>
        			
                
        					<?php if($this->Amc->findstatus($user_role,'product')==1){   ?>
        					<li class='has-sub'><i class="fa fa-product-hunt image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Product'),['controller' => 'Product', 'action' => 'productlist']);?>
           				 		<ul>
								  <?php if($user_role == 'admin'){   ?>
              						<li><?php echo $this->Html->link(__('Add Product'),['controller' => 'Product', 'action' => 'addproduct']);?></li>
									<?php } ?>
									<li><?php echo $this->Html->link(__('Product List'),['controller' => 'Product', 'action' => 'productlist']);?></li>
           				   	   </ul>
        					</li>
        					<?php } ?>
							
<?php if($this->Amc->findstatus($user_role,'amc_warranty')==1){   ?>
        					<li class='has-sub'><i class="fa fa-bullseye image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Amc Warranty'),['controller' => 'Warranty', 'action' => 'warrantylist']);?>
           				 		<ul>
              							<li><?php echo $this->Html->link(__('Add Amc Warranty'),['controller' => 'Warranty', 'action' => 'addwarranty']);?></li>
							<li><?php echo $this->Html->link(__('Amc Warranty List'),['controller' => 'Warranty', 'action' => 'warrantylist']);?></li>
           				   	   </ul>
        					</li>
        	<?php } ?>
						</ul>
							
					</li>
					
					<?php } ?>
	<?php if($this->Amc->findstatus($user_role,'client')==1){   ?>				
   	<li class='has-sub'><i class="fa fa-users image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Client'),['controller' => 'Client', 'action' => 'clientlist']);?></a>
      <ul>
	  <?php if($user_role == 'admin'){   ?>
         <li class=''><?php echo $this->Html->link(__('Add Client'),['controller' => 'Client', 'action' => 'addclient']);?></li>
		   <?php } ?>
       	 <li class=''><?php echo $this->Html->link(__('Client List'),['controller' => 'Client', 'action' => 'clientlist']);?></li>
        
      </ul>
   </li>

<?php } ?>
<?php if($this->Amc->findstatus($user_role,'employee')==1){   ?>
    <li class='has-sub'><i class="fa fa-user-plus image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Employee'),['controller' => 'Employee', 'action' => 'employeelist']);?></a>
      <ul>
	  <?php if($user_role == 'admin'){   ?>
         <li class=''><?php echo $this->Html->link(__('Add Employee'),['controller' => 'Employee', 'action' => 'addemployee']);?></li>
		 <?php } ?>
         <li class=''><?php echo $this->Html->link(__('Employee List'),['controller' => 'Employee', 'action' => 'employeelist']);?></li>
        
      </ul>
   </li>
   <?php } ?>
   
   <?php if($this->Amc->findstatus($user_role,'quotation')==1){   ?>
     	<li class='has-sub'><i class="fa fa-credit-card-alt image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Quotation'),['controller' => 'quotation', 'action' => 'quotationlist']);?></a>
      <ul>
	  <?php if($user_role == 'admin'){   ?>
         <li class=''><?php echo $this->Html->link(__('Add Quotation'),['controller' => 'quotation', 'action' => 'addquotation']);?></li>
		 <?php } ?>
        <li class=''><?php echo $this->Html->link(__('Quotation List'),['controller' => 'quotation', 'action' => 'quotationlist']);?></li>
      </ul>
   </li>
     <?php } ?>
    <?php if($this->Amc->findstatus($user_role,'sales')==1){   ?>
   	<li class='has-sub'><i class="fa fa-tty image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Sales'),['controller' => 'Sales', 'action' => 'viewsales']);?></a>
      <ul>
	  <?php if($user_role == 'admin'){   ?>
         <li class=''><?php echo $this->Html->link(__('Add Sales Invoice'),['controller' => 'sales', 'action' => 'sales']);?></li>
		 <?php } ?>
        <li class=''><?php echo $this->Html->link(__('Sales List'),['controller' => 'sales', 'action' => 'viewsales']);?></li>
        
  
      </ul>
   </li>
    <?php } ?>
      
   
   <?php if($this->Amc->findstatus($user_role,'amc')==1){   ?>
   <li class='has-sub'><i class="fa fa-bookmark image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('AMC'),['controller' => 'amc', 'action' => 'viewamc']);?></a>
      <ul>
         <li class=''><?php echo $this->Html->link(__('Add AMC'),['controller' => 'amc', 'action' => 'addamc']);?></li>
        <li class=''><?php echo $this->Html->link(__('AMC List'),['controller' => 'amc', 'action' => 'viewamc']);?></li>
   
         
      </ul>
   </li>
      <?php } ?> 
	  
	  
	  
   <?php if($this->Amc->findstatus($user_role,'complaint')==1){   ?>
   <li class='has-sub'><i class="fa fa-indent image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Complaint'),['controller' => 'complaint', 'action' => 'viewcomplaint']);?></a>
      <ul>
         <li class=''><?php echo $this->Html->link(__('Add Complaint'),['controller' => 'complaint', 'action' => 'addcomplaint']);?></li>
        <li class=''><?php echo $this->Html->link(__('Complaint List'),['controller' => 'complaint', 'action' => 'viewcomplaint']);?></li>
        
     <!--   <li class=''><?php echo $this->Html->link(__('Open Complaint'),['controller' => '', 'action' => '']);?></li>-->
         
      </ul>
   </li>
   
   <?php } ?> 
   
      <?php if($this->Amc->findstatus($user_role,'service')==1){   ?>
   <li class='has-sub'><i class="fa fa-slack image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('service'),['controller' => 'service', 'action' => 'viewservice']);?></a>
      <ul>
         <li class=''><?php echo $this->Html->link(__('Add Service'),['controller' => 'service', 'action' => 'addservice']);?></li>
        <li class=''><?php echo $this->Html->link(__('Service List'),['controller' => 'service', 'action' => 'viewservice']);?></li>
   
         
      </ul>
   </li>
      <?php } ?> 
   
   <?php if($this->Amc->findstatus($user_role,'task')==1){   ?>
      <li class='has-sub'><i class="fa fa-tasks image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Task'),['controller' => 'Dailytask', 'action' => 'dailytask']);?></a>
      <ul>
	  <li class=''><?php echo $this->Html->link(__('Add Task'),['controller' => 'task', 'action' => 'addtask']);?></li>
         <li class=''><?php echo $this->Html->link(__('View Task'),['controller' => 'task', 'action' => 'viewtask']);?></li>
        
		
      </ul>
   </li>
   <?php } ?>
     <?php if($this->Amc->findstatus($user_role,'expenses')==1){   ?>
     <li class='has-sub'><i class="fa fa-expand image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Expenses'),['controller' => 'Expenses', 'action' => 'viewexpenses']);?></a>
      <ul>
         <li class=''><?php echo $this->Html->link(__('Add Expenses'),['controller' => 'Expenses', 'action' => 'addexpenses']);?></li>
        <li class=''><?php echo $this->Html->link(__('Expenses List'),['controller' => 'Expenses', 'action' => 'viewexpenses']);?></li>
      </ul>
   </li>
 <?php } ?>
 <?php if($this->Amc->findstatus($user_role,'income')==1){   ?>
    <li class='has-sub'><i class="fa fa-money image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Income'),['controller' => 'Income', 'action' => 'viewincome']);?></a>
      <ul>
         <li class=''><?php echo $this->Html->link(__('Add Income'),['controller' => 'Income', 'action' => 'addincome']);?></li>
        <li class=''><?php echo $this->Html->link(__('Income List'),['controller' => 'Income', 'action' => 'viewincome']);?></li>
      </ul>
   </li>
   <?php } ?>
   <?php if($this->Amc->findstatus($user_role,'setting')==1){   ?>
   	<li class='has-sub'><i class="fa fa-sun-o image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Accounts'),['controller' => 'Member', 'action' => 'memberlist']);?></a>
   </li>
   <li class='has-sub'><i class="fa fa-cog image_icon" aria-hidden="true"></i><?php echo $this->Html->link(__('Setting'),['controller' => 'Setting', 'action' => 'Setting']);?></a>
      <ul>
         <li class=''><i class="fa fa-sliders image_icon"></i><?php echo $this->Html->link(__('Genral Setting'),['controller' => 'Setting', 'action' => 'Setting']);?></li>
		 <li class=''><i class="fa fa-key image_icon"></i><?php echo $this->Html->link(__('Access Rights'),['controller' => 'Setting', 'action' => 'accessrights']);?></li>
      </ul>
   </li>
    <?php } ?>
	
                    </ul>
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
    </footer>
</div> 
	
</main>
</body>
</html>
