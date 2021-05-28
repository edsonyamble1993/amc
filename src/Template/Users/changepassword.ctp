<style>
input[type="text"]
{
	font-family: 'Open Sans', sans-serif;
    font-size:13px;
}
</style>
<?php
$user_role=$this->request->session()->read('user_role');

?>


<div class="row schooltitle">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					
					     <li class="active">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-pencil fa-lg')) .__('Change Password'),array('controller'=>'user','action' => 'changepassword'),array('escape' => false));
						?>

					  </li>

				</ul>
</div>


<div class="panel-body">	
	<div class="table-responsive">
		<div id="example_wrapper" class="dataTables_wrapper">
		
			
          <?php echo $this->Form->Create('form1',['id'=>'client_form','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'']]);?>

          <div class="header panel-body">
          		<h3><?php echo __('Change Password'); ?></h3>
          </div>
		 
		  

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Old Password'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-10">
								<?php echo $this->Form->input('',array('name'=>'old_password','class'=>'form-control','placeholder'=>__('Enter Old Password'),'id'=>'old_password','required'=>'required'));?>
							</div>
				</div>
				
				<div class="form-group">
				
				<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('New Password:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-10">
								<?php echo $this->Form->input('',array('name'=>'new_password','class'=>'form-control validate[required]','placeholder'=>__('Enter New Password'),'required'=>'required','id'=>'password'));?>
							</div>
				</div>
				
				
				
				<div class="form-group">
				
				<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Confirm Password:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-10">
								<?php echo $this->Form->input('',array('name'=>'confirm_password','class'=>'form-control validate[required]','placeholder'=>__('Re-Enter Password'),'required'=>'required','id'=>'confirm_password'));?>
							</div>
				</div>
				
				
				
				
			
			
			<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
							<?php echo $this->Form->input(__('Save'),array('type'=>'submit','name'=>'save','class'=>'btn btn-success'));?>
							</div>
				</div>
			<?php $this->Form->end(); ?>
		
		</div>
	</div>
</div>

<script>
var password = document.getElementById("password")
var confirm_password = document.getElementById("confirm_password");

function validatePassword(){
  if(password.value != confirm_password.value) {
    confirm_password.setCustomValidity("Passwords Don't Match");
  } else {
    confirm_password.setCustomValidity('');
  }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

</script>




