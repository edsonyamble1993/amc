<?php 
use Cake\Routing\Router;




foreach($client_data as $client_datas)
{
	$mainperson = $client_datas->main_person;
	$account_number = $client_datas->account_number;
	$ifs_code = $client_datas->ifs_code;
	$branch_name = $client_datas->branch_name;
	$tin_no = $client_datas->tin_no;
	$cst_no = $client_datas->cst_no;
	$pan_no = $client_datas->pan_no;
}


$client_id= (isset($client_update_row)) ? $client_update_row['client_id'] : $user_idf ;
$first_name=(isset($client_update_row))? $client_update_row['first_name']: '';
$middle_name=(isset($client_update_row))?$client_update_row['middle_name']: '';
$last_name=(isset($client_update_row))?$client_update_row['last_name']:'';
$dob=(isset($client_update_row))?date($this->Amc->getDateFormat(),strtotime($client_update_row['dob'])):'';
$gender=(isset($client_update_row))?$client_update_row['gender']:'Male';
$ms=(isset($client_update_row))?$client_update_row['marital_status']:'Unmarried';
$address=(isset($client_update_row))?$client_update_row['address']:'';
$contact_person=(isset($client_update_row))?$client_update_row['Contact_person']:'';
$city=(isset($client_update_row))?$client_update_row['city']:'';
$state=(isset($client_update_row))?$client_update_row['state']:'';
$pincode=(isset($client_update_row))?$client_update_row['pincode']:'';
$mobile_no=(isset($client_update_row))?$client_update_row['mobile_no']:'';
$alt_mobile_no=(isset($client_update_row))?$client_update_row['alt_mobile']:'';
$phone=(isset($client_update_row))?$client_update_row['phone']:'';
$email=(isset($client_update_row))?$client_update_row['email']:'';
$photo=(isset($client_update_row))?$client_update_row['photo']:'';
$username=(isset($client_update_row))?$client_update_row['username']:'';
$company_name=(isset($client_update_row))?$client_update_row['company_name']:'';

$user_role=$this->request->session()->read('user_role');

?>

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
					  <?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Update Client'),array(),array('escape' => false));
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
<style type="text/css">

#gender-male , #gender-female
{
	vertical-align: middle;
    margin-right: 5px;
    margin: 0;
    padding-right:0;
}
#gender-div label
{
	padding-right:15px;
}
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
							<?php echo $this->Form->input('',array('name'=>'first_name','value'=>$first_name,'class'=>'form-control validate[required]','placeholder'=>__('Enter First Name'),'required'));?>
						</div>
				</div>


				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Middle Name'));?></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'middle_name','value'=>$middle_name,'class'=>'form-control','placeholder'=>__('Enter Middle Name')));?>
							</div>
							
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Last Name:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'last_name','value'=>$last_name,'class'=>'form-control validate[required]','placeholder'=>__('Enter Last Name'),'required'));?>
							</div>
							
				</div>

			

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Gender'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4" id="gender-div" style="margin-top:8px">
								<?php 
							
							
							$gender_options = array('Male' => __(' Male '), 'Female' => __(' Female '));
							echo $this->Form->radio('gender',$gender_options,array('default'=>$gender));
							?>
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Date Of Birth:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
							<input type="date" name="dob" id="" class="form-control validate[required]" placeholder="Enter Date Of Birth" required="required" value="<?php echo date("Y-m-d",strtotime($dob)); ?>">
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
							<?php echo $this->Form->input('',array('name'=>'main_person','value'=>$mainperson,'class'=>'form-control validate[required]','placeholder'=>__('Main Person Name'),'required'));?>
						</div>
						
						
	<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Company Name'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'company_name','value'=>$company_name,'class'=>'form-control validate[required]','placeholder'=>__('Company Name'),'required'));?>
						</div>
						</div>	
						<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Account Number'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'account_number','value'=>$account_number,'class'=>'form-control validate[required]','placeholder'=>__('Account Number'),'required'=>'required'));?>
						</div>
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('IFS code'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'ifs_code','value'=>$ifs_code,'class'=>'form-control validate[required]','placeholder'=>__('IFS Code'),'required','required'=>'required'));?>
						</div>
						
						</div>
						
	
	
		
						<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Branch Name'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'branch_name','value'=>$branch_name,'class'=>'form-control validate[required]','placeholder'=>__('Branch Name'),'required'=>'required'));?>
						</div>
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('TIN No'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'tin_no','value'=>$tin_no,'class'=>'form-control validate[required]','placeholder'=>__('TIN No'),'required'=>'required'));?>
						</div>
						
						</div>	
						<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('CST No'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'cst_no','value'=>$cst_no,'class'=>'form-control validate[required]','placeholder'=>__('CST No'),'required'=>'required'));?>
						</div>
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('PAN No'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'pan_no','value'=>$pan_no,'class'=>'form-control validate[required]','placeholder'=>__('PAN No'),'required'=>'required'));?>
						</div>
						
						</div>	


					<div class="form-group">
<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Mobile Number'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'mobile_no','value'=>$mobile_no,'class'=>'form-control validate[required]','placeholder'=>__('Mobile Number'),'required'));?>
						</div>
				</div>

				


				
			<div class="header panel-body">
          		<h3><?php echo __('Address'); ?></h3>
			</div>
        <div class="field_wrapper">
            <?php 
                $address_arr_count="";
                                
                if(isset($address)){
                  
                    
                    $address_arr=json_decode($address);
                    $address_arr_count=count($address_arr);
					if(!empty($address_arr)){
                   foreach($address_arr as $address_key=>$address_value){
                       
                    if($address_key == 0){
                     ?>
            	<div class="form-group">
        
                
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Address 1'));?> <span class="require-field">*</span>
						</div>
						
						<div class="col-sm-9">
							<?php echo $this->Form->input('',array('name'=>'address[]','class'=>'form-control validate[required]','value'=>$address_value,'placeholder'=>__('Enter Address'),'required'));?>
						</div>
                
                     <div class="col-sm-1">
                         <a href="javascript:void(0);" class="add_button btn btn-info" title="Add field">
                            <span class="fa fa-plus"></span>
                         </a>
                    </div>
            
   </div>
            
            
                        
                        
            <?php            
                    } else{
                      ?>
                        
                    <div class="form-group addtext">
                            <div class="col-sm-2 label_right">
                                <label for="address-1">Address</label> <span class="require-field">*</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input text">
                                    <label for=""></label><input name="address[]" class="form-control validate[required]" placeholder="Enter Address" id="" type="text" value="<?php echo $address_value; ?>" 'required'='required'>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <a href="javascript:void(0);" class="remove_button btn btn-danger" title="Remove field"><span class="fa fa-trash"></span></a>
                            </div>
                    </div>
             
                        
                    <?php    
                    }   
                 
                       
                       
                   }
				} 
                               
                }
                                
            
            ?>
                  
    </div>
    
        
    <script type="text/javascript">
$(document).ready(function(){
	var maxField = 10; //Input fields increment limitation
	var addButton = $('.add_button'); //Add button selector
	var wrapper = $('.field_wrapper'); //Input field wrapper
/*	var fieldHTML = '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="remove-icon.png"/></a></div>';*/
   
    //New input field html 
	var x = <?php echo $address_arr_count;?>; 
        
    
    //Initial field counter is 1
	 var fieldHTML = '<div class="form-group addtext"><div class="col-sm-2 label_right"><label for="address-1">Address</label> <span class="require-field">*</span></div><div class="col-sm-9"><div class="input text"><label for=""></label><input name="address[]" class="form-control validate[required]" placeholder="Enter Address" id="" required="required" type="text"></div></div><div class="col-sm-1"><a href="javascript:void(0);" class="remove_button btn btn-danger" title="Remove field"><span class="fa fa-trash"></span></a></div></div>';
    
	$(addButton).click(function(){ //Once add button is clicked
       console.log(fieldHTML);
        
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
							<?php echo $this->Form->input('',array('name'=>'city','value'=>$city,'class'=>'form-control validate[required]','placeholder'=>__('Enter City')));?>
						</div>
                
                
                <div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('State'));?>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'state','value'=>$state,'class'=>'form-control validate[required]','placeholder'=>__('Enter State')));?>
						</div>
                
			</div>
    
    
    
    
    
			<div class="form-group">
						
						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Pin code'));?>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'pincode','value'=>$pincode,'class'=>'form-control validate[required]','placeholder'=>__('Pincode')));?>
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
							<?php echo $this->Form->input('',array('name'=>'alt_mobile','value'=>$alt_mobile_no,'class'=>'form-control','placeholder'=>__('Enter Alternate Mobile')));?>
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
							<?php echo $this->Form->input('',array('name'=>'email','value'=>$email,'class'=>'form-control validate[required]','placeholder'=>__('Enter Email'),'required'));?>
						</div>
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Password'));?>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('type'=>'password','name'=>'user_password','class'=>'form-control validate[required]','placeholder'=>__('Enter Password')));?>
						</div>
                		
    </div>
    <br><br><bR>

		<div class="form-group">
			<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Upload Image'));?></div>
			<div class="col-sm-4">
			<?php 
				if(isset($client_update_row)){
						echo '<br>';
					echo $this->Html->image('user/'.$photo, ['class' => 'img-thumbnail avatar','id'=>'profileimg','width'=>'150','height'=>'150']); 
					echo '<br><br>';
				   echo $this->Form->hidden('',array('name'=>'old_image','value'=>$photo));
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
					<?php
						if($client_histroy){
							foreach($client_histroy as $client_histroys){
								
								
								
								?>
						<tr id="row_id_<?php echo $client_histroys['id'];?>">
							
							<td>
							<input type="hidden" name="contact_person[id][]" placeholder="Enter Name.." value="<?php echo $client_histroys['id'];?>" class="quantity form-control" data-id ="<?php echo $row_id;?>"  id="quantity_<?php echo $row_id;?>">
							
								<input type="text" name="contact_person[name][]" placeholder="Enter Name.." value="<?php echo $client_histroys['contact_name']; ?>" class="quantity form-control" data-id ="<?php echo $row_id;?>"  id="quantity_<?php echo $row_id;?>">
							</td>
							
							<td>
								<input type="text" name="contact_person[mobile][]" value="<?php echo $client_histroys['mobile']; ?>" placeholder="Enter Mobile Number.." class="quantity form-control" data-id ="<?php echo $row_id;?>"  id="quantity_<?php echo $row_id;?>">
							</td>
                            
                            <td>
								<input type="text" name="contact_person[designation][]" value="<?php echo  $client_histroys['designation'];?>"  placeholder="Enter designation.." class="quantity form-control" data-id ="<?php echo $row_id;?>"  id="designation_<?php echo $row_id;?>">
							</td>
						
							<td>
								<span class="trash delete_client" client-id="<?php echo $client_histroys['id']; ?>" data-id="<?php echo $client_histroys['id']; ?>"><i class="fa fa-trash"></i> Delete</span>
								
							</td>
						</tr>
						<?php 
						}
						}?>
				</tbody>
			</table>

			
			
			<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
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
	jQuery('#pdate').datepicker({
		 changeMonth: true,
      changeYear: true,
	  dateFormat: "yy-mm-dd"
	});

	jQuery('#inventory_form').validationEngine();

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
	jQuery('body').on('click','.delete_client',function(){
		var client_id = jQuery(this).attr('client-id');
		jQuery.ajax({
                       type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Ajax","action" => "deleteclient"]);?>',
                     data : {client_id:client_id},
                     success: function ()
                        {	
                            
						},
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
       });
		
	});


	function deleteParentElement(n){
   		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
   	}
	
   

 


});
        
           
 



</script>	