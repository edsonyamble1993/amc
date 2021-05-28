<div class="row panel-body">			
				<ul role="tablist" class="nav nav-tabs panel_tabs">
                    
                       <li class="">
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Complaint List'),
array('controller'=>'Complaint','action' => 'viewcomplaint'),array('escape' => false));
						?>						  
					  </li>
                    
					  <li class="<?php echo 'active';?>">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Edit Status Complaint'),array('controller'=>'Complaint','action' => 'updatestatuscomplaint',$complaint_id),array('escape' => false));
						?>
  
					  </li>
				</ul>
				<div class="header panel-body">
          		<h3><?php echo __('Complaint Information'); ?></h3>
          </div>
		  <?php echo $this->Form->Create('form1',['id'=>'client_form','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'']]);?>

				<div class="form-group">
						


							<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Status:'));?>
						</div>
						<div class="col-sm-4">
						<select class="form-control" name="employee_status" >
						<option value="1">Open</option>
						<option value="2">Progress</option>
						<option value="0">Closed</option>
						</select>
						</div>
						
				</div>
				<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Employee Review'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->textarea('',array('name'=>'employer_review','value'=>'','class'=>'form-control validate[required]','required'=>'required'));?>
						</div>
						
						
						
			</div>
			<div class="form-group">
			<div class="col-sm-2 label_right">
							
							<label for="alternate-mobile-number"><?php echo __('Closed Date ');?><span class="require-field">*</span></label>
							
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'close_date','id'=>'close_date','class'=>'form-control validate[required]','placeholder'=>__('Close Date'),'required'=>'required'));?>
						</div>
			</div>
			<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
							<?php echo $this->Form->input(__('Save'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
							</div>
				</div>
			<?php $this->Form->end(); ?>
			
</div>
<script>
$(function(){

	jQuery('#complaint_date,#close_date,#assign_date').datepicker({
		dateFormat: "yy-mm-dd",
		  changeMonth: true,
	        changeYear: true,
	        yearRange:'-65:+0',
	        onChangeMonthYear: function(year, month, inst) {
	            jQuery(this).val(month + "-" + year);
	        }
                    
                });




});
</script>
