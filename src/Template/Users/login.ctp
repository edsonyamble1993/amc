<html>
<head>
<style type="text/css">
.table > tbody > tr > td{
	border-top:none;
}
.table td, .table > tbody > tr > td, .table > tbody > tr > th, .table > tfoot > tr > td, .table > tfoot > tr > th, .table > thead > tr > td, .table > thead > tr > th {
    padding: 10px !important;
}
.input_text{
	height: 50px;
}
.input_text:hover{
	height: 50px;
	border-color:#22baa0;
	box-shadow: 0px 0px 10px #22baa0;
}

.input_text:focus{
	height: 50px;
	border-color:#22baa0;
	box-shadow: 0px 0px 10px #22baa0;
}

.btn_text{
	height: 45px;
	font-size: 15px;
}
.forgot_link
{
	text-decoration: none !important;
	font-size : 15px;
	
}
#first-form , #second-form
{
	width:40% !important;
	display:inline-block;
	margin-left:35px;
}

</style>


</head>

<body>




<div class="mainlogin login_amc">		
			<div class="panel-body main-class">
				
						
						<table align="center" class="table" style="width:33em">
					

								<tr>
								<td align="center"><?php echo $this->Html->image('amc.png', ['width' => '150','height' => '150','style'=>'border-radius:10%;padding:3px;']);?></td>
								</tr>

								<tr>
									<td align="center"><h2><b><?php echo __('Annual Maintenance Contract Management System');?></b></h2></td>
								</tr>
								<!--<tr>
								<td style="padding:0px 25px;">
								<div id="first-form">
							   <form method="post">
								<input type="hidden" name="username" value="customer@gmail.com">
								<input type="hidden" name="password" value="customer">
								<input type="submit" class="btn btn-primary" name="add" value="Login as Customer">
							   </form>
							   </div>
							   <div id="second-form">
							   <form method="post">
								<input type="hidden" name="username" value="employee@gmail.com">
								<input type="hidden" name="password" value="employee">
								<input type="submit" class="btn btn-primary" name="add" value="Login as Employee">
							   </form>
							   </div>
							   </td>
								</tr>-->
<?php if(isset($flag)){?>
										<tr>
								<td>
							<?php

						
						if((int)$flag == 0){
									echo '<div class="alert alert-danger" style="border-left: 5px solid;">Please Enter Correct Username and Password !</div>';
									}
								
						?>	
		</td>
		</tr>
<?php } ?>
<?php echo $this->Form->Create('form1',['id'=>'formID','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'']]);?>
								<tr>
									<td>
<?php echo $this->Form->input('',array('name'=>'username','type'=>'text','class'=>'form-control input_text validate[required]','PlaceHolder'=>'Enter Email Or Username','required'=>'required'));?>
									</td>
								</tr>
								
								

								<tr>
									<td><?php echo $this->Form->input('',array('type'=>'password','name'=>'password','class'=>'input_text form-control validate[required]','PlaceHolder'=>'Password','required'=>'required'));?></td>
								</tr>

								<tr>
									<td>
									<?php echo $this->Form->input(__('Login'),array('type'=>'submit','name'=>'add','class'=>'btn_text btn btn-success btn-block'));?>
								</td>
								</tr>
								
								<tr>
									<td>
										<a href="<?php echo $this->request->base; ?>/Forgot/forgotpassword" class="forgot_link pull-right">Forgot Password ?</a>
									</td>
								</tr>
								
						</table>
						<?php echo $this->Form->end(); ?>
</hr>
<!--<table class="table" style="background-color:azure;">
	<tbody><tr><th>Role</th><th>Username</th><th>Password</th></tr>
	
	<tr><td>Customer</td><td>customer@gmail.com</td><td>customer</td></tr>
	<tr><td>Employee</td><td>employee@gmail.com</td><td>employee</td></tr>
   </tbody></table>-->
   <!--<table align="center">
   <td style="padding:0px 25px;">
   <form method="post" align="center">
	<input type="hidden" name="username" value="customer@gmail.com">
	<input type="hidden" name="password" value="customer">
	<input type="submit" class="btn btn-primary" name="add" value="Login as Customer">
   </form>
   </td>
   
   <td style="padding:0px 25px;">
   <form method="post">
	<input type="hidden" name="username" value="employee@gmail.com">
	<input type="hidden" name="password" value="employee">
	<input type="submit" class="btn btn-primary" name="add" value="Login as Employee">
   </form>
   </td>
   </table>-->

					
										
			</div>		
</div>

</body>
</html>