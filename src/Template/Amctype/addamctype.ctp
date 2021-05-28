
<div class="row">			
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
                    
                  <li class="">	
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('AmcType List'),array('controller'=>'Group','action' => 'grouplist'),array('escape' => false));
						?> 
				</li>
                    
					  <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add AmcType'),array('controller'=>'Group','action' => 'addgroup'),array('escape' => false));
						?> 
					  </li> 
				</ul>
</div>



<div class="row">			
		<div class="panel-body">
		
		
		
			
          <?php echo $this->Form->Create('form1',['id'=>'formID','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'addexam']]);?>
          
          

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('AMC type:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-10">
							<?php echo $this->Form->input('',array('name'=>'amctype','value'=>'','class'=>'form-control validate[required]','placeholder'=>__('Enter AMC Type')));?>
							</div>
				</div>

				
				<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
							<?php echo $this->Form->input(__('Add Type'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
							</div>
				</div>
				
			<?php $this->Form->end(); ?>
		</div>
</div>			

<script>
$(function(){

	

});
</script>