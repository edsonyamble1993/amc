<?php 
use Cake\Routing\Router;


$client_id= (isset($client_update_row)) ? $client_update_row['client_id'] : $user_idf ;

$user_role=$this->request->session()->read('user_role');

?>
<style>
img{
  max-width:180px;
}
input[type=file]{
padding:10px;
background:#2d2d2d;}
</style>

<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/imgareaselect/0.9.10/js/jquery.imgareaselect.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<link  href="https://cdn.rawgit.com/fengyuanchen/cropper/v2.0.1/dist/cropper.min.css" rel="stylesheet">
<script src="https://cdn.rawgit.com/fengyuanchen/cropper/v2.0.1/dist/cropper.min.js"></script>
<link rel="stylesheet" href="<?php echo $this->request->webroot;?>css/imgareaselect.css">

<?php if($user_role == 'admin'){
?>
<div class="row panel-body">			
				<ul role="tablist" class="nav nav-tabs panel_tabs">
                    
                       <li class="">
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__(' Client List'),
array('controller'=>'Client','action' => 'index'),array('escape' => false));
						?>						  
					  </li>
                    
					  <li class="active">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__( ' Add Client'),array('controller'=>'Client','action' => 'addclient'),array('escape' => false));
						?>
  
					  </li>
				</ul>

<script>
$(function(){

	// jQuery('#date_of_birth').datepicker({
		// dateFormat: "yy-mm-dd",
		  // changeMonth: true,
	        // changeYear: true,
	        // yearRange:'-65:+0',
	        // onChangeMonthYear: function(year, month, inst) {
	            // jQuery(this).val(month + "-" + year);
	        // }
                    
                // });
});
</script>
    <style type="text/css">

.field_wrapper div{ margin-bottom:10px;}
.add_button{vertical-align: text-bottom;}
.remove_button{vertical-align: text-bottom;}
</style>

			
          <?php echo $this->Form->Create('form1',['id'=>'client_form','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'']]);?>

          <div class="header panel-body">
          		<h3><?php echo __('Personal Information'); ?></h3>
          </div>
		   <input type="hidden" value="client" name="role">
		  <div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Client Id'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'client_id','value'=>$client_id,'class'=>'form-control validate[required]','readonly','required'));?>
						</div>
						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('First Name'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'first_name','class'=>'form-control validate[required]','placeholder'=>__('Enter First Name'),'required'));?>
						</div>
				</div>


				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Middle Name'));?></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'middle_name','class'=>'form-control','placeholder'=>__('Enter Middle Name')));?>
							</div>
							
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Last Name:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'last_name','class'=>'form-control validate[required]','placeholder'=>__('Enter Last Name'),'required'));?>
							</div>
							
				</div>

			

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Gender'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								<?php 
							
							
							$gender_options = array('Male' => __(' Male '), 'Female' => __(' Female '));
							echo $this->Form->radio('gender',$gender_options,array('default'=>'Male'));
							?>
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Date Of Birth:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
							<input type="date" name="dob" class="form-control validate[required]" placeholder="Enter Date Of Birth" required="required" id="">
								</div>
				</div>


				
		
		 
	<div class="header panel-body">
          		<h3><?php echo __('Company Details'); ?></h3>
          </div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Main Person Name'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'main_person','class'=>'form-control validate[required]','placeholder'=>__('Main Person Name'),'required'));?>
						</div>
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Company Name'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'company_name','class'=>'form-control validate[required]','placeholder'=>__('Company Name'),'required'));?>
						</div>
						
						</div>	
						<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Account Number'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'account_number','class'=>'form-control validate[required]','placeholder'=>__('Account Number'),'required'=>'required'));?>
						</div>
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('IFS code'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'ifs_code','class'=>'form-control validate[required]','placeholder'=>__('IFS Code'),'required'=>'required'));?>
						</div>
						
						</div>	
						<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Branch Name'));?><span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'branch_name','class'=>'form-control validate[required]','placeholder'=>__('Branch Name'),'required'=>'required'));?>
						</div>
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('TIN No'));?> <span class="require-field">*</span>
						
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'tin_no','class'=>'form-control validate[required]','placeholder'=>__('TIN No'),'required'=>'required'));?>
						</div>
						
						</div>	
						<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('CST No'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'cst_no','class'=>'form-control validate[required]','placeholder'=>__('CST No'),'required'=>'required'));?>
						</div>
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('PAN No'));?> <span class="require-field">*</span>
						
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'pan_no','class'=>'form-control validate[required]','placeholder'=>__('PAN No'),'required'=>'required'));?>
						</div>
						
						</div>	
						<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Mobile Number'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'mobile_no','class'=>'form-control validate[required]','placeholder'=>__('Mobile Number'),'required'=>'required'));?>
						</div>
						</div>

				
			<div class="header panel-body">
          		<h3><?php echo __('Address'); ?></h3>
			</div>
    
    <div class="field_wrapper">
    
			<div class="form-group">
                
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Address'));?> <span class="require-field">*</span>
						</div>
						
						<div class="col-sm-9">
							<?php echo $this->Form->input('',array('name'=>'address[]','class'=>'form-control validate[required]','placeholder'=>__('Enter Address'),'required'));?>
						</div>
                
                     <div class="col-sm-1">
                         <a href="javascript:void(0);" class="add_button btn btn-info" title="Add field">
                            <span class="fa fa-plus"></span>
                         </a>
                    </div>
            
			</div>
        
        
</div>
    
  
    
    
    <script type="text/javascript">
$(document).ready(function(){
	var maxField = 10; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
/*	var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>';*/
   
    //New input field html 
	var x = 1; //Initial field counter is 1
	 var fieldHTML = '<div class="form-group addtext"><div class="col-sm-2 label_right"><label for="address-1">Address</label> <span class="require-field">*</span></div><div class="col-sm-9"><div class="input text"><label for=""></label><input name="address[]" class="form-control validate[required]" placeholder="Enter Address" id="" required="required" type="text"></div></div><div class="col-sm-1"><a href="javascript:void(0);" class="remove_button btn btn-danger" title="Remove field"><span class="fa fa-trash"></span></a></div></div>';
	$(addButton).click(function(){ //Once add button is clicked
		if(x < maxField){ //Check maximum number of input fields
			x++; //Increment field counter
			$(wrapper).append(fieldHTML); // Add field html
		}
	});
	$(wrapper).on('click', '.remove_button', function(e){ //Once remove button is clicked
		e.preventDefault();
		$(this).parent('div').parent("div.addtext").remove(); //Remove field html
		x--; //Decrement field counter
	});
});
</script>
			<div class="form-group">
						
						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('City'));?> 
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'city','class'=>'form-control validate[required]','placeholder'=>__('Enter City')));?>
						</div>
			
			
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('State'));?> 
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'state','class'=>'form-control validate[required]','placeholder'=>__('Enter State')));?>
						</div>
						
						
					
						
			</div>
			
				<div class="form-group">
				
					<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Pin code'));?> 
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'pincode','class'=>'form-control validate[required]','placeholder'=>__('Pincode'),'pattern'=>'^[0-9]+$'));?>
						</div>
				
				</div>
			
			
			
			<div class="header panel-body">
          		<h3><?php echo __('Contact'); ?></h3>
			</div>
			
						
			<div class="form-group">
			<div class="col-sm-2 label_right">
							
							<label for="alternate-mobile-number"><?php echo __('Alternate Mobile Number ');?></label>
							
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'alt_mobile','class'=>'form-control validate[required]','placeholder'=>__('Enter Alternate Mobile'),'pattern'=>'([0-9]{10,15})'));?>
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
							<?php echo $this->Form->email('',array('name'=>'email','id'=>'email','class'=>'form-control validate[required]','placeholder'=>__('Enter Email'),'required'=>'required'));?>
						</div>
						
						<script>
							$(document).ready(function(){
								$("#save").attr("disabled","disabled");
								$("body").on("keyup blur","#email",function(){
									
												var get_email_val=$("#email").val();
									
									jQuery.ajax({
                        type: 'POST',
                        url: '<?php echo Router::url(["controller" => "client","action" => "checkemail"]);?>',
                      data : {email_text:get_email_val},
                     success: function (response){	
                           if(response > 0){
							   $("#save").attr("disabled","disabled");
						   }else{
							   $("#save").removeAttr("disabled");
						   }
						},
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
       });
				
									
								})
								
								
							
								
							});
							
							
							
						
						</script>
						
						<div class="col-sm-2 label_right">
					    	<?php echo $this->Form->label(__('Password'));?> <span class="require-field">*</span>
						</div>
						
						<div class="col-sm-4">
							<?php echo $this->Form->password('',array('name'=>'user_password','class'=>'form-control validate[required]','placeholder'=>__('Enter Password'),'required'));?>
						</div>

			</div>
			
		<div class="form-group">
			
						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Upload Image '));?> <span class="require-field">*</span>
						</div>
						
						<div class="col-sm-4">
									 <?php echo $this->Form->file('',array('class'=>'file','id'=>'user_image','type'=>'','name'=>'image','PlaceHolder'=>'Select Image'));?>
						</div> 
						
						
		</div>
			
			
			 <div class="header">
          		<h3><?php echo __('Other Contact Details'); ?></h3>
          </div>
		  
		  <button type="button" id="add_newrow" class="btn btn-default" style="margin:5px 0px;">Add New </button>
		  
				 <table class="table table-bordered" id="tab_product_detail" align="center">
					<thead>
					<tr>
						<th><?php echo __('Contact person Name');?></th>
						<th><?php echo __('Mobile Number');?></th>
						<th><?php echo __('Designation');?></th>
						<th><?php echo __('Action');?></th>
						
					</tr>
				</thead>			
				<tbody>
				<?php $row_id = 0;?>
						<tr id="row_id_<?php echo $row_id;?>">
							
							<td>
								<input type="text" name="contact_person[name][]" placeholder="Enter Name.." class="quantity form-control" data-id ="<?php echo $row_id;?>"  id="quantity_<?php echo $row_id;?>">
							</td>
							
							<td>
								<input type="text" name="contact_person[mobile][]"  placeholder="Enter Mobile Number.." class="quantity form-control" data-id ="<?php echo $row_id;?>"  id="quantity_<?php echo $row_id;?>">
							</td>

							<td>
								<input type="text" name="contact_person[designation][]"  placeholder="Enter designation.." class="quantity form-control" data-id ="<?php echo $row_id;?>"  id="designation_<?php echo $row_id;?>">
							</td>
						
							<td>
								<span class="trash" data-id="<?php echo $row_id;?>"><i class="fa fa-trash"></i> Delete</span>
								
							</td>
						</tr>
				</tbody>
			</table>

			
			
			<div class="form-group">
							<div class="">
							<?php echo $this->Form->input(__('Save'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
							</div>
				</div>
			<?php $this->Form->end(); ?>
		
</div>	
<?php }else{ ?>
<div class="extra_information">
<span class="new_add_text">you are not authorized this page.</span>
</div>
<?php } ?>	

<script type="text/javascript">
jQuery(document).ready(function() {
	// jQuery('#pdate').datepicker({
		 // changeMonth: true,
      // changeYear: true,
	  // dateFormat: "yy-mm-dd"
	// });

	//jQuery('#inventory_form').validationEngine();

	/*----*/
	jQuery("#add_newrow").click(function(){
		
		var row_id = jQuery("#tab_product_detail > tbody > tr").length;
		var action = 'add_newrow';
		jQuery.ajax({
                       type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Ajax","action" => "addnewrowclient"]);?>',
                     data : {row_id:row_id},
                     success: function (response)
                        {	
                            jQuery("#tab_product_detail > tbody").append(response);
							return false;
						},
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                },
				beforeSend:function(){
					$("#add_newrow").attr("disabled","disabled");
				},
				complete:function(){
					$("#add_newrow").removeAttr("disabled");
				}
       });
	});
	/*---*/

/*-----*/

	jQuery('body').on('click','.trash',function(){
		var row_id = jQuery(this).attr('data-id');
		
		jQuery('table#tab_product_detail tr#row_id_'+row_id).remove();	
		return false;
	});
	


	function deleteParentElement(n){
   		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
   	}
	
   
jQuery(".fixed-dragger-cropper > img").cropper({
  aspectRatio: 640 / 320,
  autoCropArea: 0.6, // Center 60%
  multiple: false,
  dragCrop: false,
  dashed: false,
  movable: false,
  resizable: false,
  built: function () {
    jQuery(this).cropper("zoom", 0.5);
  }
});
   
 


});
        
           
 



</script>	