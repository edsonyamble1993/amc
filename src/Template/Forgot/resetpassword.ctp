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
.mainlogin
{
	height:508px;
}
#reset_label
{
	padding:9px;
	width: 100%;
	margin-bottom: 5px;
	display: table-cell;
	vertical-align:middle !important;
    text-align:center !important;
	height: 45px;
    font-size: 15px;
	color: #fff;
    background-color: #22BAA0;
    border-color: transparent;
	border: 1px solid transparent;
    border-radius: 0;
	outline: 0!important;
	display: block;
	font-weight: 400;
    line-height: 1.42857143;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
	font-family: inherit;
	letter-spacing: normal;
    word-spacing: normal;
    text-transform: none;
    text-indent: 0px;
    text-shadow: none;
	box-sizing: border-box;
	   
}
</style>

<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#user_form').validationEngine(); 
} );
</script>
</head>

<body>
<div class="mainlogin login_amc">		
	<div class="panel-body main-class">
		<?php echo $this->Form->Create('form1',['id'=>'user_form','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'']]);?>
						
		<table align="center" class="table" style="width:33em">
				
			<tr>
				<td align="center"><?php echo $this->Html->image('amc.png', ['width' => '150','height' => '150','style'=>'border-radius:10%;padding:3px;']);?></td>
			</tr>

			<tr>
				<td align="center"><h2><b><?php echo __('Annual Maintenance Contract');?></b></h2></td>
			</tr>
			
			<tr>
			<td>
				<span id='reset_label'>Reset Password</span>
			</td>
			</tr>
			
			<tr>
				<td>
				<input type="password" name="create_password" id="create_password" class="form-control validate[required]" value="" placeholder='Enter Password'/>
				</td>
			</tr>
			
			<tr>
				<td>
				<input type="password" name="password" id="con_pass" class="form-control validate[required,equals[create_password]]" value="" placeholder='Confirm Password'/>
				
				</td>
			</tr>
									
			<tr>
				<td>
				<input type='submit' name='go' class='btn_text btn btn-success btn-block'>
				</td>
			</tr>						
	</table>

<?php $this->Form->end(); ?>
					
										
	</div>		
</div>

</body>
</html>