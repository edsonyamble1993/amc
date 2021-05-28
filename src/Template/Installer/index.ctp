<div class="pg-header">
	<h4 class="install_title"><?php echo __("TAM - Annual Maintenance Contract Software");?></h4>
</div>
<div class="step-content">
<!-- <form id="example-form" method="post" class="form-horizontal"> -->
<?php echo $this->Form->create("",["id"=>"install-form","class"=>"form-horizontal"]);?>
    <div>
		<h3><?php echo __("Database Setup");?></h3>
			<section>
				<h4><?php echo __("Database Setup");?></h4>
				<hr/>
				<div class="form-group">
					<label class="control-label col-md-3"><?php echo __("Database Name")?><span class="text-danger"> *</span></label>
					<div class="col-md-5">
					<div class="input text">
					<input type="text" name="db_name" class="form-control required">
					</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><?php echo __("Database Username")?><span class="text-danger"> *</span></label>
					<div class="col-md-5">
					<div class="input text">
					<input type="text" name="db_username" class="form-control required">
					</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><?php echo __("Database Password")?></label>
					<div class="col-md-5">
					<div class="input text">
					<input type="text" name="db_pass" class="form-control">
					</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><?php echo __("Host")?><span class="text-danger"> *</span></label>
					<div class="col-md-5">
					<div class="input text">
					<input type="text" name="db_host" class="form-control required">
					</div>
					</div>
				</div>
				<div class="col-md-offset-3">
					<p> (*) <?php echo __("Fields are required.")?></p>
				</div>
			</section>
        <h3><?php echo __("System Setting")?></h3>
        <section> 
		  <h4><?php echo __("System Setting")?></h4>
		  <hr/>
		  <div class="form-group">
			  <label class="control-label col-md-3"><?php echo __("System Name")?><span class="text-danger"> *</span></label>
			  <div class="col-md-8">
			  <div class="input text">
			  <input type="text" name="name" class="form-control required" value="AMC Master - Annual Maintenance Contract Management System">
			  </div>
			  </div>
		  </div>		  		  
		  
			
			<div class="form-group">
				<label class="control-label col-md-3"><?php echo __("Email")?> <span class="text-danger">*</span></label>
				<div class="col-md-8">
				<div class="input text">
				<input type="text" name="email" class="form-control required email" value="">
				</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3"><?php echo __("Address")?> <span class="text-danger">*</span></label>
				<div class="col-md-8">
				<div class="input text">
				<input type="text" name="address" class="form-control required" value="">
				</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3"><?php echo __("First Name")?> <span class="text-danger">*</span></label>
				<div class="col-md-8">
				<div class="input text">
				<input type="text" name="firstname" class="form-control required " value="">
				</div>
				</div>
			</div>
			<div class="form-group">
				<label class="control-label col-md-3"><?php echo __("Last Name")?> <span class="text-danger">*</span></label>
				<div class="col-md-8">
				<div class="input text">
				<input type="text" name="lastname" class="form-control required " value="">
				</div>
				</div>
			</div>
			
			<div class="col-md-offset-3">
					<p> (*) <?php echo __("Fields are required.")?></p>
			</div>
        </section>  
		 <h3><?php echo __("Login Details");?></h3>
		<section>
		<h4><?php echo __("Login Details");?></h4>
				<hr/>
				<div class="form-group">
					<label class="control-label col-md-3"><?php echo __("Email")?><span class="text-danger"> *</span></label>
					<div class="col-md-5">
					<div class="input text">
					<input type="email" name="loginemail" class="form-control required">
					</div>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3"><?php echo __("Password")?><span class="text-danger"> *</span></label>
					<div class="col-md-5">
					<div class="input text">
					<input type="password" id="password" name="password" class="form-control required password">
					</div>
					</div>
				</div>
				
				<div class="form-group">
					<label class="control-label col-md-3"><?php echo __("Confirm Password")?><span class="text-danger"> *</span></label>
					<div class="col-md-5">
					<div class="input text">
					<input type="password" name="confirm" id="confirm" class="form-control required">
					</div>
					</div>
				</div> 			
		</section>
        <h3><?php echo __("Finish");?></h3>
		<section id="final">
			<h4><?php echo __("Please Note :");?></h4>
			<hr/>					
			<p>
				<?php echo __("1. It may take couple of minutes to set-up database.");?>
			</p>			
			<p>
				<?php echo __("2. Do not refresh page after to you click on install button.");?>
			</p>
			<p>
				<?php echo __("3. You will be acknowledge with success message once after installation finishes.");?>
			</p>
			<p>
				<?php echo __("4. Click on install to complete the installation.")?>
			</p>
			
			<div id="loader" style="display:none;">
				<p>			
					<hr/>
					<h4>Please Wait System is now installing..</h4>
				</p>
				<span>
					<img src="<?php echo $this->request->base;?>/webroot/img/ajax-loader.gif" />
				</span>
			</div>
		</section>
    </div>	
<?php echo $this->Form->end();?>
<!-- </form> -->
</div>

<script>
$(function ()
 {
	 
var form = $("#install-form");
form.validate({
    errorPlacement: function errorPlacement(error, element) { element.before(error); },
    rules: {
        confirm: {
            equalTo: "#password"
        }
    }
});
form.children("div").steps({
	 labels: {
        cancel: "Cancel",
        current: "current step:",
        pagination: "Pagination",
        finish: "Install Now",
        next: "Next Step",
        previous: "Previous Step",
        loading: "Loading ..."
    },	
    headerTag: "h3",
    bodyTag: "section",	
    transitionEffect: "slideLeft",
    onStepChanging: function (event, currentIndex, newIndex)
    {
        form.validate().settings.ignore = ":disabled,:hidden";
        return form.valid();
    },
    onFinishing: function (event, currentIndex)
    {
		$("#loader").css("display","block");
        form.validate().settings.ignore = ":disabled";
        return form.valid();
    },
    onFinished: function (event, currentIndex)
    {				
        form.submit();
    }
});
});
</script>