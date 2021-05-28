<?php
$years=(isset($warranty_update))?$warranty_update['years']:'';
$months=(isset($warranty_update))?$warranty_update['months']:'';
$days=(isset($warranty_update))?$warranty_update['days']:'';
?>

<div class="row">			
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
                    
                  <li class="">	
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Warranty List'),array('controller'=>'Warranty','action' => 'warrantylist'),array('escape' => false));
						?> 
				</li>
                    
					  <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Warranty'),array('controller'=>'Warranty','action' => 'addwarranty'),array('escape' => false));
						?> 
					  </li> 
				</ul>
</div>



<div class="row">			
		<div class="panel-body">
		
		
			
          <?php echo $this->Form->Create('form1',['id'=>'formID','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'']]);?>
          
          

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Years:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-10">
							<?php echo $this->Form->input('',array('name'=>'years','value'=>$years,'class'=>'form-control validate[required]','placeholder'=>__('Enter Years'),'required'=>'required'));?>
							</div>
				</div>

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Months:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-10">
							<?php echo $this->Form->input('',array('name'=>'months','value'=>$months,'class'=>'form-control validate[required]','placeholder'=>__('Enter Month '),'required'=>'required'));?>
							</div>
				</div>

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Days:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-10">
							<?php echo $this->Form->input('',array('name'=>'days','value'=>$days,'class'=>'form-control validate[required]','placeholder'=>__('Enter Day'),'required'=>'required'));?>
							</div>
				</div>

				
				<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
							<?php echo $this->Form->input(__('Add Warranty'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
							</div>
				</div>
				
			<?php $this->Form->end(); ?>
		</div>
</div>			

<script>
$(function(){

	

});
</script>