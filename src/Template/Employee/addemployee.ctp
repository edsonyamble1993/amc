<?php 
use Cake\Routing\Router;

$action = $this->request->params['action'];

$client_id= (isset($emp_update_row)) ? $emp_update_row['client_id'] : $user_idf ;
$first_name=(isset($emp_update_row))? $emp_update_row['first_name']: '';
$middle_name=(isset($emp_update_row))?$emp_update_row['middle_name']: '';
$last_name=(isset($emp_update_row))?$emp_update_row['last_name']:'';
$dob=(isset($emp_update_row))?date($this->Amc->getDateFormat(),strtotime($emp_update_row['dob'])):date("Y-m-d");
$gender=(isset($emp_update_row))?$emp_update_row['gender']:'Male';
$ms=(isset($emp_update_row))?$emp_update_row['marital_status']:'Unmarried';
$address=(isset($emp_update_row))?$emp_update_row['address']:'';
$city=(isset($emp_update_row))?$emp_update_row['city']:'';
$state=(isset($emp_update_row))?$emp_update_row['state']:'';
$pincode=(isset($emp_update_row))?$emp_update_row['pincode']:'';
$mobile_no=(isset($emp_update_row))?$emp_update_row['mobile_no']:'';
$alt_mobile_no=(isset($emp_update_row))?$emp_update_row['alt_mobile']:'';
$phone=(isset($emp_update_row))?$emp_update_row['phone']:'';
$email=(isset($emp_update_row))?$emp_update_row['email']:'';
$photo=(isset($emp_update_row))?$emp_update_row['photo']:'';
$btn_name=(isset($emp_update_row))?'Edit Employee':'Add Employee';
$user_role=$this->request->session()->read('user_role');





?>
<script>
    jQuery(document).ready(function () {
       jQuery('#sample_input').awesomeCropper(
        { width: 150, height: 150, debug: true }
        );
    });
    </script>
<?php if($user_role == 'admin'){
	?>

<div class="row panel-body">			
				<ul role="tablist" class="nav nav-tabs panel_tabs">
                    
                       <li class="">
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Employee List'),
array('controller'=>'Employee','action' => 'index'),array('escape' => false));
						?>						  
					  </li>
                    
					  <li class="active">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__($btn_name),array(),array('escape' => false));
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

			
          <?php echo $this->Form->Create('form1',['id'=>'client_form','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'']]);?>

          <div class="header panel-body">
          		<h3><?php echo __('Personal Information'); ?></h3>
          </div>
		
		 <input type="hidden" value="employee" name="role">
	
				<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Employee Id'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'client_id','value'=>$client_id,'class'=>'form-control validate[required]','readonly','required'=>'required'));?>
						</div>
						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('First Name'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'first_name','value'=>$first_name,'class'=>'form-control validate[required]','placeholder'=>__('Enter First Name'),'required'=>'required'));?>
						</div>
				</div>


				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Middle Name'));?></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'middle_name','value'=>$middle_name,'class'=>'form-control','placeholder'=>__('Enter Middle Name')));?>
							</div>
							
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Last Name:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'last_name','value'=>$last_name,'class'=>'form-control validate[required]','placeholder'=>__('Enter Last Name'),'required'=>'required'));?>
							</div>
							
				</div>

			

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Gender'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								<?php 
							
							
							$gender_options = array('Male' => __(' Male '), 'Female' => __(' Female '));
							echo $this->Form->radio('gender',$gender_options,array('default'=>$gender));
							?>
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Date Of Birth:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
							<input type="date" name="dob"  class="form-control validate[required]" placeholder="Enter Date Of Birth" id="date_of_birth1" required="required" value="<?php echo date("Y-m-d",strtotime($dob)); ?>">
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
							<?php echo $this->Form->input('',array('name'=>'address','value'=>$address,'class'=>'form-control validate[required]','placeholder'=>__('Enter Address'),'required'=>'required'));?>
						</div>
						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('City'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'city','value'=>$city,'class'=>'form-control validate[required]','placeholder'=>__('Enter City Name'),'required'=>'required'));?>
						</div>
			</div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('State'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'state','value'=>$state,'class'=>'form-control validate[required]','placeholder'=>__('Enter State'),'required'=>'required'));?>
						</div>
						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Pin code'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'pincode','value'=>$pincode,'class'=>'form-control validate[required]','placeholder'=>__('Enter Pincode'),'required'=>'required'));?>
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
							<?php echo $this->Form->input('',array('name'=>'mobile_no','value'=>$mobile_no,'class'=>'form-control validate[required]','placeholder'=>__('Enter Mobile'),'required'=>'required'));?>
						</div>
						<div class="col-sm-2 label_right">
							
							<label for="alternate-mobile-number"><?php echo __('Alternate Mobile Number ');?><span class="require-field">*</span></label>
							
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'alt_mobile','value'=>$alt_mobile_no,'class'=>'form-control validate[required]','placeholder'=>__('Enter Alternate Mobile')));?>
						</div>
			</div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Phone Number'));?>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'phone','value'=>$phone,'class'=>'form-control validate[required]','placeholder'=>__('Enter Phone Number')));?>
						</div>
						
						
			</div>
		
			
			<div class="header panel-body">
          		<h3><?php echo __('Other Info'); ?></h3>
			</div>
			<div class="form-group">
			<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Email'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<div id="error_message" style="color:red"></div>
							<?php echo $this->Form->email('',array('name'=>'email','id'=>'email','value'=>$email,'class'=>'form-control validate[required]','placeholder'=>__('Enter Email'),'required'=>'required'));?>
						</div>
						
						<?php 
						if(isset($emp_update_row)){
							
						}else{
							?>
							
							<script>
							$(document).ready(function(){
								
								
								$("body").on("keyup","#email",function(){
									
												var get_email_val=$("#email").val();
									
									jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo Router::url(["controller" => "client","action" => "checkemail"]);?>',
                      data : {email_text:get_email_val},
                     success: function (response){	
                           if(response > 0){
								$("#error_message").text("Email Already Exists !");
							  
							  
							   
								
						   }else{
							   $("#error_message").text("");
							
							
						   }
						},
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                },
				beforeSend:function(){
					
					$("#error_message").text("Cheking...");
				}
       });
				
									
								})
								
								
								
								
								
							});
							
							
							
						
						</script>
							
							
							
							
							<?php
							
							
							
							
						}
						
						?>
						
						
						
						
						
                
                
                
                
						
						
						
			</div>
			<div class="form-group">
                
               
                <div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Password'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'password','type'=>'password','class'=>'form-control validate[required]','placeholder'=>__('Enter Password'),'required'=>'required'));?>
						</div>
                
					
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Upload Image '));?> 
						</div>
						<div class="col-sm-4">
								<input type="hidden" name="old_image" value="<?php echo $photo; ?>"> 

						<?php
							echo '<br>';
							if(isset($emp_update_row)){
								echo $this->Html->image('user/'.$photo, ['class' => 'avatar','id'=>'profileimg','width'=>'120','height'=>'100']);
							echo '<br>';echo '<br>';	
							}
							 ?>
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
							<?php echo $this->Form->input(__('Save'),array('type'=>'submit','name'=>'add','id'=>'save','class'=>'btn btn-success'));?>
							</div>
				</div>
			<?php $this->Form->end(); ?>
		
</div>	
<?php }else{ ?>
<div class="extra_information">
<span class="new_add_text">you are not authorized this page.</span>
</div>
<?php } ?>		