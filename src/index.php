<?php
if(isset($_REQUEST['Member_Registration_Template'])){
	update_option('Member_Registration',$_REQUEST['Member_Registration']);
	update_option('registration_email_template',$_REQUEST['registration_email_template']);	
} 
 if(isset($_REQUEST['Member_approve_email_template_save'])){
	update_option('Member_approve_subject',$_REQUEST['Member_approve_subject']);
	update_option('Member_approve_email_template',$_REQUEST['Member_approve_email_template']);	
}

if(isset($_REQUEST['Member_removed_committee_email_template_save'])){
	update_option('Member_removed_committee_subject',$_REQUEST['Member_removed_committee_subject']);
	update_option('Member_removed_committee_email_template',$_REQUEST['Member_removed_committee_email_template']);	
		
} 
if(isset($_REQUEST['add_user_subject_email_template_save'])){
	update_option('add_user_subject',$_REQUEST['add_user_subject']);
	update_option('add_user_email_template',$_REQUEST['add_user_email_template']);	
		
} 
if(isset($_REQUEST['add_notice_email_template_save'])){
	
	update_option('add_notice_subject',$_REQUEST['add_notice_subject']);
	update_option('add_notice_email_template',$_REQUEST['add_notice_email_template']);	
	
} 
if(isset($_REQUEST['add_event_email_template_save'])){
	
	update_option('add_event_subject',$_REQUEST['add_event_subject']);
	update_option('add_event_email_template',$_REQUEST['add_event_email_template']);	
	
} 
?>

<div class="page-inner" style="min-height:1088px !important">
	<div class="page-title">
		<h3><img src="<?php echo get_option( 'amgt_system_logo' ) ?>" class="img-circle head_logo" width="40" height="40" /><?php echo get_option( 'amgt_system_name' );?>
		</h3>
	</div>
	
<div id="main-wrapper">
<div class="row">
<div class="col-md-12">
<div class="panel panel-white">
	<div class="panel-body">
		<div class="panel-group" id="accordion">
		
		
	 <!-----------Registration Email Template---------------->
		<div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
          <?php _e('Registration Email Template ','hospital_mgt'); ?>
        </a>
      </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
      <div class="panel-body">
        <form id="registration_email_template_form" class="form-horizontal" method="post" action="" name="parent_form">
			
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label"><?php _e('Email Subject','hospital_mgt');?><span class="require-field">*</span> </label>
				<div class="col-md-8">
					<input class="form-control validate[required]" name="Member_Registration" id="Member_Registration" placeholder="Enter email subject" value="<?php print get_option('Member_Registration'); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label"><?php _e('Registration Email Template','hospital_mgt'); ?><span class="require-field">*</span> </label>
				<div class="col-md-8">
					<textarea style="min-height:200px;" name="registration_email_template" class="form-control validate[required]"><?php print get_option('registration_email_template'); ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-md-8">
					<label><?php _e('You can use following variables in the email template:','hr_mgt');?></label><br>
					<label><strong><?php _e('{{member_name}} -','apartment_mgt');?> </strong><?php _e('Name of Member','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{apartment_name}} -','apartment_mgt');?> </strong><?php _e('Name Of Apartment','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{unit_name}} -','apartment_mgt');?> </strong><?php _e('Unit Name','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{building_name}} -','apartment_mgt');?> </strong><?php _e('Building Name','apartment_mgt'); ?></label><br>
				</div>
			</div>
			<div class="col-sm-offset-3 col-sm-8">        	
				<input value="Save" name="Member_Registration_Template" class="btn btn-success" type="submit">
			</div>
		</form>
      </div>
    </div>
  </div>
  
  
   <!-----------Member Approved by Admin Template----------------->
        <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
          <?php _e('Member Approved by Admin Template ','apartment_mgt'); ?>
        </a>
      </h4>
    </div>
    <div id="collapseTwo" class="panel-collapse collapse ">
      <div class="panel-body">
        <form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
		
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label"><?php _e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
				<div class="col-md-8">
					<input class="form-control validate[required]" name="Member_approve_subject" id="Member_approve_subject" placeholder="Enter email subject" value="<?php print get_option('Member_approve_subject'); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label"><?php _e('Member Approved by Admin Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
				<div class="col-md-8">
					<textarea style="min-height:200px;" name="Member_approve_email_template" class="form-control validate[required]"><?php print get_option('Member_approve_email_template'); ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-md-8">
					<label><?php _e('You can use following variables in the email template:','hr_mgt');?></label><br>
					<label><strong><?php _e('{{member_name}} -','apartment_mgt');?> </strong><?php _e('Name of Member','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{apartment_name}} -','apartment_mgt');?> </strong><?php _e('Name Of Apartment','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{loginlink}} -','apartment_mgt');?> </strong><?php _e('Login Page Link','apartment_mgt'); ?></label><br>
				</div>
			</div>
			<div class="col-sm-offset-3 col-sm-8">        	
				<input value="Save" name="Member_approve_email_template_save" class="btn btn-success" type="submit">
			</div>
		</form>
      </div>
    </div>
  </div>
   <!-----------Member Removed from committee member--------------------->
	 <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
          <?php _e('Member Removed from committee member','apartment_mgt'); ?>
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse ">
      <div class="panel-body">
        <form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
		
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label"><?php _e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
				<div class="col-md-8">
					<input class="form-control validate[required]" name="Member_removed_committee_subject" id="Member_removed_committee_subject" placeholder="Enter email subject" value="<?php print get_option('Member_removed_committee_subject'); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label"><?php _e('Member Removed from committee Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
				<div class="col-md-8">
					<textarea style="min-height:200px;" name="Member_removed_committee_email_template" class="form-control validate[required]"><?php print get_option('Member_removed_committee_email_template'); ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-md-8">
					<label><?php _e('You can use following variables in the email template:','apartment_mgt');?></label><br>
					<label><strong><?php _e('{{member_name}} -','apartment_mgt');?> </strong><?php _e('Name of Member','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{apartment_name}} -','apartment_mgt');?> </strong><?php _e('Name Of Apartment','apartment_mgt'); ?></label><br>
				</div>
			</div>
			<div class="col-sm-offset-3 col-sm-8">        	
				<input value="Save" name="Member_removed_committee_email_template_save" class="btn btn-success" type="submit">
			</div>
		</form>
      </div>
    </div>
  </div>
  <!-----------ADD OTHER USER IN SYSTEM TEMPLATE--------------------->
    <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFour">
          <?php _e('Add Other User in system Template','apartment_mgt'); ?>
        </a>
      </h4>
    </div>
    <div id="collapseFour" class="panel-collapse collapse ">
      <div class="panel-body">
        <form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
		
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label"><?php _e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
				<div class="col-md-8">
					<input class="form-control validate[required]" name="add_user_subject" id="add_user_subject" placeholder="Enter email subject" value="<?php print get_option('add_user_subject'); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label"><?php _e('Add Other User in system Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
				<div class="col-md-8">
					<textarea style="min-height:200px;" name="add_user_email_template" class="form-control validate[required]"><?php print get_option('add_user_email_template'); ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-md-8">
					<label><?php _e('You can use following variables in the email template:','apartment_mgt');?></label><br>
					<label><strong><?php _e('{{member_name}} -','apartment_mgt');?> </strong><?php _e('Name of Member','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{apartment_name}} -','apartment_mgt');?> </strong><?php _e('Name Of Apartment','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{rolename}} -','apartment_mgt');?> </strong><?php _e('User Role','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{username}} -','apartment_mgt');?> </strong><?php _e('Username','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{password}} -','apartment_mgt');?> </strong><?php _e('Password','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{loginlink}} -','apartment_mgt');?> </strong><?php _e('Login Page Link','apartment_mgt'); ?></label><br>
				</div>
			</div>
			<div class="col-sm-offset-3 col-sm-8">        	
				<input value="Save" name="add_user_subject_email_template_save" class="btn btn-success" type="submit">
			</div>
		</form>
      </div>
    </div>
  </div>
  
	 <!-----------Add NOTICE TEMPLATE--------------------->
    <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseFive">
          <?php _e('Add Notice Template','apartment_mgt'); ?>
        </a>
      </h4>
    </div>
    <div id="collapseFive" class="panel-collapse collapse ">
      <div class="panel-body">
        <form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
		
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label"><?php _e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
				<div class="col-md-8">
					<input class="form-control validate[required]" name="add_notice_subject" id="add_notice_subject" placeholder="Enter email subject" value="<?php print get_option('add_notice_subject'); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label"><?php _e('Add Notice Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
				<div class="col-md-8">
					<textarea style="min-height:200px;" name="add_notice_email_template" class="form-control validate[required]"><?php print get_option('add_notice_email_template'); ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-md-8">
					<label><?php _e('You can use following variables in the email template:','apartment_mgt');?></label><br>
					<label><strong><?php _e('{{member_name}} -','apartment_mgt');?> </strong><?php _e('Name of Member','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{apartment_name}} -','apartment_mgt');?> </strong><?php _e('Name Of Apartment','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{notice_title}} -','apartment_mgt');?> </strong><?php _e('Notice Title','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{notice_type}} -','apartment_mgt');?> </strong><?php _e('Notice Type','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{notice_valid_date}} -','apartment_mgt');?> </strong><?php _e('Notice Valid Date','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{notice_content}} -','apartment_mgt');?> </strong><?php _e('Notice Content','apartment_mgt'); ?></label><br>
				</div>
			</div>
			<div class="col-sm-offset-3 col-sm-8">        	
				<input value="Save" name="add_notice_email_template_save" class="btn btn-success" type="submit">
			</div>
		</form>
      </div>
    </div>
  </div>	
  
   <!-----------Add EVENT TEMPLATE------------------>
    <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
        <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapsesix">
          <?php _e('Add Event Template','apartment_mgt'); ?>
        </a>
      </h4>
    </div>
    <div id="collapsesix" class="panel-collapse collapse ">
      <div class="panel-body">
        <form id="registration_email_template" class="form-horizontal" method="post" action="" name="parent_form">
		
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label"><?php _e('Email Subject','apartment_mgt');?> <span class="require-field">*</span></label>
				<div class="col-md-8">
					<input class="form-control validate[required]" name="add_event_subject" id="add_notice_subject" placeholder="Enter email subject" value="<?php print get_option('add_event_subject'); ?>">
				</div>
			</div>
			<div class="form-group">
				<label for="first_name" class="col-sm-3 control-label"><?php _e('Add Notice Email Template','apartment_mgt'); ?> <span class="require-field">*</span></label>
				<div class="col-md-8">
					<textarea style="min-height:200px;" name="add_event_email_template" class="form-control validate[required]"><?php print get_option('add_event_email_template'); ?></textarea>
				</div>
			</div>
			<div class="form-group">
				<div class="col-sm-offset-3 col-md-8">
					<label><?php _e('You can use following variables in the email template:','apartment_mgt');?></label><br>
					<label><strong><?php _e('{{member_name}} -','apartment_mgt');?> </strong><?php _e('Name of Member','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{apartment_name}} -','apartment_mgt');?> </strong><?php _e('Name Of Apartment','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{event_title}} -','apartment_mgt');?> </strong><?php _e('Event Title','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{event_start_date}} -','apartment_mgt');?> </strong><?php _e('Event Start Date','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{event_end_date}} -','apartment_mgt');?> </strong><?php _e('Event End Date','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{event_start_time}} -','apartment_mgt');?> </strong><?php _e('Event Start Time','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{event_end_time}} -','apartment_mgt');?> </strong><?php _e('Event End Time','apartment_mgt'); ?></label><br>
					<label><strong><?php _e('{{event_description}} -','apartment_mgt');?> </strong><?php _e('Event Description','apartment_mgt'); ?></label><br>
				</div>
			</div>
			<div class="col-sm-offset-3 col-sm-8">        	
				<input value="Save" name="add_event_email_template_save" class="btn btn-success" type="submit">
			</div>
		</form>
      </div>
    </div>
  </div>	
		
        </div>
	</div>
</div>
</div>
</div>
</div>