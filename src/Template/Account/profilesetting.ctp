<div class="row panel-body">			
				<ul role="tablist" class="nav nav-tabs panel_tabs">
                    
                    <?php $user_id = $updateprofiledata['user_id']; ?>
					  <li class="active">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__( 'Profile Setting'),array('controller'=>'Account','action' => 'profilesetting',$user_id),array('escape' => false));
						?>
  
					  </li>
				</ul>

<script>
$(function(){

	jQuery('#date_of_birth').datepicker({
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
<style>
input[type="text"]
{
	font-family: 'Open Sans', sans-serif;
    font-size:13px;
}
</style>
			
          <?php echo $this->Form->Create('form1',['id'=>'client_form','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'profilesetting']]);?>

          <div class="header panel-body">
          		<h3><?php echo __('Personal Information'); ?></h3>
          </div>
		
		 <input type="hidden" value="<?php echo $updateprofiledata['role']; ?>" name="role">
	
				<div class="form-group">
						
						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('First Name'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'first_name','value'=>$updateprofiledata['first_name'],'class'=>'form-control validate[required]','placeholder'=>__('Enter First Name'),'required'=>'required'));?>
						</div>
						<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Middle Name'));?></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'middle_name','value'=>$updateprofiledata['middle_name'],'class'=>'form-control','placeholder'=>__('Enter Middle Name')));?>
							</div>
				</div>


				<div class="form-group">
							
							
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Last Name:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'last_name','value'=>$updateprofiledata['last_name'],'class'=>'form-control validate[required]','placeholder'=>__('Enter Last Name'),'required'=>'required'));?>
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Marital Status'));?></div>
                    
							<div class="col-sm-4" style="padding-top:6px;">
							<style type="text/css">
								label{padding-left:5px;}
							</style>
							<?php 			
							$marrital_options = array('Unmarried' => __(' Unmarried '), 'Married' => __( ' Married ' ));
							echo $this->Form->radio('marital_status',$marrital_options,array('default'=>$updateprofiledata['marital_status']));
						 ?>
							</div>
							
				</div>

			

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Gender'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4" style="padding-top:6px;">
								<?php 
							
							$gender=$updateprofiledata['gender'];
							$gender_options = array('Male' => __(' Male '), 'Female' => __(' Female '));
							echo $this->Form->radio('gender',$gender_options,array('default'=>$gender));
							?>
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Date Of Birth:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'dob','value'=>date('Y-m-d',strtotime($updateprofiledata['dob'])),'id'=>'date_of_birth','class'=>'form-control validate[required]','placeholder'=>__('Enter Date Of Birth'),'required'=>'required'));?>
							</div>
				</div>


				<div class="form-group">
							
				</div>
			<div class="header panel-body">
          		<h3><?php echo __('Address'); ?></h3>
			</div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Address'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'address','value'=>$updateprofiledata['address'],'class'=>'form-control validate[required]','required'=>'required'));?>
						</div>
						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('City'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'city','value'=>$updateprofiledata['city'],'class'=>'form-control validate[required]','placeholder'=>__('Enter City Name'),'required'=>'required'));?>
						</div>
			</div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('State'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'state','value'=>$updateprofiledata['state'],'class'=>'form-control validate[required]','required'=>'required'));?>
						</div>
						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Pin code'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'pincode','value'=>$updateprofiledata['pincode'],'class'=>'form-control validate[required]','placeholder'=>__('Enter First Name'),'required'=>'required'));?>
						</div>
			</div>
			
			<div class="header panel-body">
          		<h3><?php echo __('Contact'); ?></h3>
			</div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Mobile Number'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'mobile_no','value'=>$updateprofiledata['mobile_no'],'class'=>'form-control validate[required]','required'=>'required'));?>
						</div>
						<div class="col-sm-2 label_right">
							
							<label for="alternate-mobile-number"><?php echo __('Alternate Mobile Number ');?></label>
							
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'alt_mobile','value'=>$updateprofiledata['alt_mobile'],'class'=>'form-control validate[required]','placeholder'=>__('Alternate Mobile Number')));?>
						</div>
			</div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Phone Number'));?> 
						
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'phone','value'=>$updateprofiledata['phone'],'class'=>'form-control validate[required]'));?>
						</div>
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Email'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'email','value'=>$updateprofiledata['email'],'class'=>'form-control validate[required]','required'=>'required'));?>
						</div>
						
			</div>
		
			
			<div class="header panel-body">
          		<h3><?php echo __('Profile Photo'); ?></h3>
			</div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Upload Image '));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
								<input type="hidden" name="old_image" value="<?php echo $updateprofiledata['photo']; ?>"> 

						<?php
							
								echo $this->Html->image('user/'.$updateprofiledata['photo'], ['class' => 'upload_image','id'=>'profileimg','width'=>'120','height'=>'100']);
							
							 ?>

									<?php //echo $this->Form->input('',array('class'=>'file','id'=>'user_image','type'=>'file','name'=>'image','PlaceHolder'=>'Select Image'));?>
	<div class="cropme" style="width: 220px; height: 200px;"></div>
      <script>
        // Init Simple Cropper
        $('.cropme').simpleCropper();
		$('.ok').click(function(){
		var data = $('.cropme').find('img').attr('src');
		console.log(data);
		$('.imagedata').val(data);
		});	
		
      </script>
		<input type="hidden" class="imagedata" name="client_image">
	    <input type="hidden" class="originaladdedimage" value="" name="originaladdedimage">
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