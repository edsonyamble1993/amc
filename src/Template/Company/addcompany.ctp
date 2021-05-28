<?php $action = $this->request->params['action'];?>

<div class="row panel-body">			
				<ul role="tablist" class="nav nav-tabs panel_tabs">
                    
                       <li class="<?php echo $action=='index'?'active':''?>">
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__(' Company List'),
array('controller'=>'Company','action' => 'index'),array('escape' => false));
						?>						  
					  </li>

              
					  <li class="<?php echo $action=='addcompany'?'active':''?>">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__( ' Add Company'),
array('controller'=>'Company','action' => 'addcompany'),array('escape' => false));
						?>
					</li>
						
				</ul>



<script type="text/javascript">

jQuery(document).ready(function() {
	jQuery('#client_form').validationEngine();
	jQuery('#date_of_birth').datepicker({
		dateFormat: "yy-mm-dd",
		  changeMonth: true,
	        changeYear: true,
	        yearRange:'-65:+0',
	        onChangeMonthYear: function(year, month, inst) {
	            jQuery(this).val(month + "-" + year);
	        }
                    
                }); 
} );
</script>		
		
			
          <?php echo $this->Form->Create('form1',['id'=>'client_form','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'']]);?>

          <div class="header panel-body">
          		<h3><?php echo __('Personal Information'); ?></h3>
          </div>
			<input type="hidden" name="user_action" value="">
		
				<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Company Id'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
		<?php echo $this->Form->input('',array('name'=>'company_idf','value'=>$c_idf,'class'=>'form-control validate[required]','readonly'));?>
						</div>	
			<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Company  Name'));?></div>
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'company_name','value'=>'','class'=>'form-control','placeholder'=>__('Enter Company Name')));?>
							</div>
				</div>
			<div class="header panel-body">
          		<h3><?php echo __('Address'); ?></h3>
			</div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Address'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'company_address','value'=>'','class'=>'form-control validate[required]'));?>
						</div>
						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('City'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'city','value'=>'','class'=>'form-control validate[required]','placeholder'=>__('Enter City Name')));?>
						</div>
			</div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('State'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'state','value'=>'','class'=>'form-control validate[required]'));?>
						</div>
						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Pin code'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'pincode','value'=>'','class'=>'form-control validate[required]','placeholder'=>__('Enter Pincode')));?>
						</div>
			</div>
			
			<div class="header panel-body">
          		<h3><?php echo __('Contact'); ?></h3>
			</div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Mobile Number'));?> <span class="require-field">*</span>
						</div>
						<!--<div class="col-sm-1">
							<?php echo $this->Form->input('',array('name'=>'mobile_no','value'=>'','class'=>'form-control validate[required]','readonly'));?>
						</div> -->
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'mobile_no','value'=>'','class'=>'form-control validate[required]'));?>
						</div>
						<div class="col-sm-2 label_right">
							
							<label for="alternate-mobile-number"><?php echo __('Alternate Mobile Number ');?><span class="require-field">*</span></label>
							
						</div>
						<!--
						<div class="col-sm-1">
							<?php echo $this->Form->input('',array('name'=>'alt_mobile','value'=>'','class'=>'form-control validate[required]','readonly'));?>
						</div> -->
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'alt_mobile','value'=>'','class'=>'form-control validate[required]','placeholder'=>__('Enter Mobile Number')));?>
						</div>
			</div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Phone Number'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'phone','value'=>'','class'=>'form-control validate[required]'));?>
						</div>
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Email'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'email','value'=>'','class'=>'form-control validate[required]'));?>
						</div>
						
			</div>
		
			
			<div class="header panel-body">
          		<h3><?php echo __('Other Info'); ?></h3>
			</div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Upload Image '));?>
						</div>
						<div class="col-sm-4">
						
						
								<input type="hidden" name="old_image" value="<?php echo '';?>"> 
								<?php echo $this->Form->input('',array('class'=>'file','id'=>'user_image','type'=>'file','name'=>'image','PlaceHolder'=>'Select Image'));?>
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