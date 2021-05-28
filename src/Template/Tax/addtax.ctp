
<?php

    $acount_tax_name=(isset($get_row_update))?$get_row_update['acount_tax_name']:'';
    $tax=(isset($get_row_update))?$get_row_update['tax']:'';
	$title_tab=(isset($get_row_update))?'Edit Tax':'Add Tax';
   
?>


<?php 

use Cake\Routing\Router;
$action = $this->request->params['action'];

?>
<div class="row panel-body">			
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					 
                    <li class="">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Tax'),array('controller'=>'tax','action' => 'viewtax'),array('escape' => false));
						?>

					  </li>

					  
				
					
					 
					   <li class="active">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__($title_tab),array('controller'=>'tax','action' => 'addtax'),array('escape' => false));
						?>

					  </li>
					
					<li class="">
						<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('View Income Tax Code'),array('controller'=>'tax','action' => 'viewcode'),array('escape' => false));
						?>
					</li>
						
					<li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Income Tax Code'),array('controller'=>'tax','action' => 'internationcode'),array('escape' => false));
						?>

					  </li>
				</ul>


    
    
    

			
         <?php echo $this->Form->Create('form1',['id'=>'formID','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'addtax']]);?>

 <div class="header">
          		<h3><?php echo __('Task Information'); ?></h3>
          </div>
		 				
					

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Account Tax Name'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4" name="subject">
								<?php echo $this->Form->input('',array('name'=>'acount_tax_name','value'=>$acount_tax_name,'id'=>'','class'=>'form-control','placeholder'=>__('Account Tax Name'),'required'=>'required'));?>
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Account Tax(In percentage)'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4" name="subject">
								<?php echo $this->Form->input('',array('name'=>'tax','value'=>$tax,'id'=>'','class'=>'form-control','placeholder'=>__('Account Tax'),'required'=>'required'));?>
							</div>
							

                    
                    	
							
							
				</div>
				<div class="header">
          		<h3><?php echo __(''); ?></h3>
          </div>



			<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
							<?php echo $this->Form->input(__('Save'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
							</div>
				</div>
			<?php $this->Form->end(); ?>

</div>			

