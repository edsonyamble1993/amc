<div id="main-wrapper">
<div class="row">
<div class="col-md-12">
<div class="panel panel-white">
	<div class="panel-body">
		<div class="panel-group" id="accordion">
		<style>
		.toggle_accordian
		{
			width:100%;
			float:left;
			padding:15px;
			cursor: pointer;
		}
		.panel-heading
		{
			padding:0px!important;
		}
		</style>
		
		
		 <?php if(!empty($mail_list))
		 {
			foreach($mail_list as $mail_lists)
			{
				?>
				
				<!-----------Registration Email Template---------------->
		<div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a data-toggle="collapse" data-target="#demo<?php echo $mail_lists['id']; ?>" class="toggle_accordian">
        <?php echo $mail_lists['notification_label']; ?>
        </a>
      </h4>
    </div>
    <div id="demo<?php echo $mail_lists['id']; ?>" class="collapse">
      <div class="panel-body">
        <form id="registration_email_template_form" class="form-horizontal" method="post" action="" name="parent_form">
			
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label">Email Subject<span class="require-field">*</span> </label>
				<div class="col-md-8">
					<input class="form-control validate[required]" name="subject" id="Member_Registration" placeholder="Enter email subject" value="<?php echo $mail_lists['subject'];  ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label">Sender email<span class="require-field">*</span> </label>
				<div class="col-md-8">
					<input class="form-control validate[required]" name="send_from" id="Member_Registration" placeholder="Enter Sender Email" value="<?php echo $mail_lists['send_from'];  ?>">
				</div>
			</div>
			<input class="form-control validate[required]" type="hidden" name="mail_id" id="mail_id"  value="<?php echo $mail_lists['id'];  ?>">
				
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label">Registration Email Template<span class="require-field">*</span> </label>
				<div class="col-md-8">
					<textarea style="min-height:200px;" name="notification_text" class="form-control validate[required]"><?php echo $mail_lists['notification_text'];  ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-md-8">
					<label>You can use following variables in the email template</label><br>
					<label><strong><?php echo $mail_lists['description_of_mailformate'];  ?></strong></label><br>
					</div>
			</div>
			<div class="col-sm-offset-3 col-sm-8">        	
				<input value="Save"  class="btn btn-success" type="submit">
			</div>
		</form>
      </div>
    </div>
  </div>
				
		<?php	}				
		 }?>
		
  
  
  
  
  
  </div>
  </div>
  </div>
  </div>
  </div>
  </div>