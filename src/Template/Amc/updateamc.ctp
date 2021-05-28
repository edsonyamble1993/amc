<?php

$amc_idf=(isset($update_row))?$update_row['amc_no']:$amc_idf;
$reference_no=(isset($update_row))?$update_row['reference_no']:'';
$date=(isset($update_row))?date($this->Amc->getDateFormat(),strtotime($update_row['date'])):'';
$contact_person=(isset($update_row))?$update_row['contact_person']:'';
$mobile=(isset($update_row))?$update_row['mobile']:'';
$email=(isset($update_row))?$update_row['email']:'';
$status=(isset($update_row))?$update_row['status']:'';
$service=(isset($update_row))?$update_row['service']:'';
$product_details=(isset($update_row))?$update_row['product_details']:'';
$subject=(isset($update_row))?$update_row['subject']:'';
$address=(isset($update_row))?$update_row['address']:'';
$img_name=(isset($update_row))?$update_row['attachment']:'';
$chk='';
if(isset($update_row)){
	if($update_row['is_decline'] == 1){
		$chk='checked';
	}else{
		$chk='';
	}

}

?>



<?php 

use Cake\Routing\Router;
$action = $this->request->params['action'];

?>
<div class="row panel-body">			
				<ul role="tablist" class="nav nav-tabs panel_tabs">
                    
                       <li class="">
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Amc List'),
array('controller'=>'Amc','action' => 'viewamc'),array('escape' => false));
						?>						  
					  </li>
                    
					  <li class="<?php echo $action=='updateamc'?'active':''?>">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Edit Amc'),array(),array('escape' => false));
						?>
  
					  </li>
				</ul>

<script>
$(function(){

	jQuery('#date,#start_date').datepicker({
		dateFormat: "yy-mm-dd",
		  changeMonth: true,
	        changeYear: true,
	        yearRange:'-65:+0',
	        onChangeMonthYear: function(year, month, inst) {
	            jQuery(this).val(month + "-" + year);
	        }
                    
                });

		$('#amctypesave').click(function(){
		var amc_type = $('#txtamctype').val();
		
			if(amc_type == ""){
				alert('Please Enter AMC Type !');
			}else{
				
				
                   $.ajax({
                       type: 'POST',
                      url: '<?php echo $this->Url->build(["controller" => "ajax","action" => "addamctype"]);?>',
                     data : {amctype_name:amc_type},
                     success: function (data)
                        {	
                            if(data > 0){
                            $('#tab_amctype').append('<tr class="del-'+data+'"><td class="text-center">'+amc_type+'</td><td class="text-center"><a href="#" class="del" id="'+data+'" class="btn btn-success"><button class="btn btn-danger btn-xs">X</button></a></td><tr>');
                           $('#amctype_id').append('<option value='+data+'>'+amc_type+'</option>');
                            }else{
                                alert('This Record is Duplicate');
                            }
						},
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
       });
	   
				
			}


      
	});



$("body").on('click','.del',function(){


   var at_id=$(this).attr('id');
   
    r=confirm('Are you sure you wish to Delete this Record?');
		if(r == true){
   $.ajax({
   type:'POST',
   url:'<?php echo $this->Url->build(['controller'=>'ajax','action'=>'deleteamctype']);?>',
   data:{amctype_id:at_id},
   success:function(data){
        $('body .del-'+at_id).fadeOut(300);

   }

   }) ;
   }
    
});

});
</script>





<!--brand Information Model-->
<div class="modal fade " id="amctype" role="dialog">
    <div class="modal-dialog modal-md"  >

      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div id="result1"></div>
        <h4 align="center"><b><u><?php echo __('Amc Type');?></u></b></h4>

        </div>
        <div class="modal-body" >


<table class="table" id="tab_amctype" align="center" style="width:40em">
		<tr>
            <th class="text-center"><b><?php echo __('Amc Type');?></b></th>
            <th class="text-center"><b><?php echo __('Action'); ?></b></th>
                </tR>
            
            <?php
            if(isset($amctypelist)){
                foreach($amctypelist as $amctype_info){      
            ?>
            <tr class="del-<?php echo $amctype_info['cat_id'];?>">
                		<td class="text-center"><?php echo $amctype_info['title']; ?></td>
                		<td class="text-center">
                        <a href="#" class="del" id="<?php echo $amctype_info['cat_id']; ?>" class="btn btn-success">
                           <button class="btn btn-danger btn-xs">X</button>
                        </a>
                        </td>
                </tr>
            <?php
                }
            }
            ?>
	</table>

        </div>
           <div class="modal-footer">
           <center>
           <div class="row">
           	 <div class="col-sm-2"></div>
              <div class="col-sm-3">
                    <label class="col-sm-12 control-label" for="birth_date" id="post_name" value="catagory">
               		 <?php echo __('Amc type:');?><span class="require-field">*</span></label>
             </div>
            <div class="col-sm-3">
			<?php echo $this->Form->input('',array('class'=>'form-control validate[required]','id'=>'txtamctype'));?>
            </div>

            <div class="col-sm-4">
                <a href="#" id="amctypesave" class="btn btn-success"><?php echo __('Add AmcType');?> </a>
            </div>
            </div>
	</center>
		
	  </div>

        </div>
      </div>

    </div>


<!--End Brand-->


			
          <?php echo $this->Form->Create('form1',['id'=>'client_form','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'']]);?>

         
		
		 
	
				<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('AMC No'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'amc_no','value'=>$amc_idf,'class'=>'form-control validate[required]','readonly'));?>
						</div>
<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Date'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								<?php //echo $this->Form->input('',array('name'=>'date','value'=>$date,'id'=>'date','class'=>'form-control','placeholder'=>__('Date'),'required'=>'required'));?>
								<input type="date" name="date" class="form-control" required="required" placeholder="Date" value="<?php echo date("Y-m-d",strtotime($date)); ?>" id="">
							</div>
					
						
				</div>


				<div class="form-group">
							
							
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Contact Person:'));?></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'contact_person','value'=>$contact_person,'class'=>'form-control validate[required]','placeholder'=>__('Enter Name')));?>
							</div>
							
				</div>

				<script type="text/javascript">
				$(function(){

						$('#customer').change(function(){

							var cust_id=$('#customer').val();

							$.ajax({
                       				type: 'POST',
                      					url: '<?php echo Router::url(["controller" => "Ajax","action" => "getcust"]);?>',
                     					data : {row_id:cust_id},
                     						success: function (response)
                        						{	
                           							var res_cust=$.parseJSON(response);
                           							$('#mobile').attr('value',res_cust.mobile_no);
                           							$('#address').text(res_cust.address);
                           							$('#email').attr('value',res_cust.email);
												},

												beforeSend:function(){
													$('#mobile').attr('value','Loading...');
                           							$('#address').text('Loading...');
                           							$('#email').attr('value','Loading...');
												},

                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
						});


						});


				});
				</script>



				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Customer Name'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								
							<select class="form-control" id="customer" name="customer_id" required="required"> 
								<option value="" selected="selected">--Select Customer--</option>
								<?php 
									if(isset($client_info)){
										foreach($client_info as $client_row){
										?>
		<option value="<?php echo $client_row['user_id'];?>" <?php
								
											if($client_row['user_id'] == $update_row['customer_id']){
												echo 'selected="selected"';
											}
		
		
		?> ><?php echo $client_row['first_name'].' '.$client_row['last_name']; ?></option>
										<?php
										}
									}
								?>
							</select>
							
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Mobile No:'));?></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'mobile','value'=>$mobile,'id'=>'mobile','class'=>'form-control validate[required]','placeholder'=>__('Enter Mobile Number'),'required'=>'required','readonly'));?>
							</div>
				</div>

				<div class="form-group">
							<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Assign To'));?> 
						</div>
						<div class="col-sm-4">
						<select class="form-control" id="customer" name="assign_to_id" required="required"> 
								<option value="" selected="selected">--Select Employee--</option>
								<?php 
									if(isset($employee_info)){
										foreach($employee_info as $employee_infos){
										?>
		<option value="<?php echo $employee_infos['user_id'];?>" <?php
								
											if($employee_infos['user_id'] == $update_row['assign_to_id']){
												echo 'selected="selected"';
											}
		
		
		?> ><?php echo $employee_infos['first_name'].' '.$employee_infos['last_name']; ?></option>
										<?php
										}
									}
								?>
							</select>
							</div>



							<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Email'));?>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'email','value'=>$email,'id'=>'email','class'=>'form-control validate[required]','placeholder'=>__('Enter Email'),'required'=>'required','readonly'));?>
						</div>
				</div>


<div class="form-group">

			<div class="col-sm-2 label_right">
				<?php echo $this->Form->label(__('Status'));?> <span class="require-field">*</span>
			</div>
			<div class="col-sm-4">
				<?php 
				$status_data=array(
						0 => 'Close',
						1 => 'Open',
						2 => 'In-Progress'
						);
				?>
				
				<select class="form-control" name="status">
						<option value="" selected="selected"><?php echo __('--Select Status--'); ?></option>
						<?php
							foreach($status_data as $status_key => $status_value){
						?>
					<option value="<?php echo $status_key; ?>" <?php 
							if(isset($update_row)){
								if($update_row['status'] == $status_key){
									echo 'selected="selected"';
								}	
							}
						
					?>><?php echo $status_value;?></option>
					<?php } ?>
				</select>
			</div>


</div>





<div class="form-group">
		
			
	<div class="col-sm-2 label_right">
				<?php echo $this->Form->label(__('Attachment'));?> 
				
			</div>
			<div class="col-sm-4">
			<?php echo $this->Form->input('',array('name'=>'attachment','type'=>'file','id'=>'file-0a','class'=>'form-control file'));?>
			<?php echo $this->Form->input('',array('type'=>'hidden','value'=>$img_name,'name'=>'attach2'));?>
			</div>

</div>



<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Add Amc Detail'));?> 
						
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->textarea('',array('name'=>'subject','value'=>$subject,'class'=>'form-control validate[required]'));?>
						</div>
						
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Billing Address'));?> 
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->textarea('',array('name'=>'address','value'=>$address,'id'=>'address','class'=>'form-control validate[required]','required'=>'required','readonly'));?>
						</div>
								
			</div>
<div class="form-group" style="margin-top:20px;">
							<div class="">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">Interval <label class="text-danger">*</label></label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<select name="interval" id="interval" class="form-control"> 
										<option value="0">No of Interval</option>
										<option value="1">1 Month</option>
										<option value="2">2 Month</option>
										<option value="3">3 Month</option>
									</select>
								</div>
								
							</div>
							
							</div>
						
						
						<div class="form-group" style="margin-top:20px;">
							<div class="">
								<label class="control-label col-md-2 col-sm-2 col-xs-12" for="last-name">No Of Service <label class="text-danger">*</label></label>
								<div class="col-md-4 col-sm-4 col-xs-12">
									<select name="no_of_services" id="no_of_service" class="form-control no_of_service" url="{!! url('sales/add/getservices')!!}" disabled> 
										<option value="0" <?php if($totalservice == 0){ echo 'Selected'; } ?>>No of service </option>
										<option value="1" <?php if($totalservice == 1){ echo 'Selected'; } ?>>1</option>
										<option value="2" <?php if($totalservice == 2){ echo 'Selected'; } ?>>2</option>
										<option value="3" <?php if($totalservice == 3){ echo 'Selected'; } ?>>3</option>
										<option value="4" <?php if($totalservice == 4){ echo 'Selected'; } ?>>4</option>
										<option value="5" <?php if($totalservice == 5){ echo 'Selected'; } ?>>5</option>
										<option value="6" <?php if($totalservice == 6){ echo 'Selected'; } ?>>6</option>
										<option value="7" <?php if($totalservice == 7){ echo 'Selected'; } ?>>7</option>
										<option value="8" <?php if($totalservice == 8){ echo 'Selected'; } ?>>8</option>
										<option value="9" <?php if($totalservice == 9){ echo 'Selected'; } ?>>9</option>
										<option value="10" <?php if($totalservice == 10){ echo 'Selected'; } ?>>10</option>
										<option value="11" <?php if($totalservice == 11){ echo 'Selected'; } ?>>11</option>
										<option value="12" <?php if($totalservice == 12){ echo 'Selected'; } ?>>12</option>
									</select>
								</div>
								
							</div>
							</div>
		

	<div id="load_service_data">
<div class="form-group">
<table class="table table-borderd" style="width:60em" align="center">
<thead>
	<tr>
		<th>No.</th>
		<th>Service Date</th>
		<th>Note</th>
	</tr>
</thead><thead>

</thead><tbody>

	<?php
	$i = 1;
	foreach($sales_services as $sales_servicess)
	{?>	
		<tr>
		<td><?php echo $i; ?></td>
		<input type ="hidden" name="service[service_id][]" value="<?php echo $sales_servicess['id']; ?>">
		<td><input type="text" name="service[service_date][]" value="<?php echo $sales_servicess['service_date']; ?>" class="form-control service_date hasDatepicker" id="dp1499237971825"></td>
		<td><input type="text" name="service[service_text][]" value="<?php echo $sales_servicess['title']; ?>" class="form-control summary_text"></td>
	</tr>
	
	<?php $i++; } ?>
		
		
		
		
		
				
		
		
		
		
		
			
	</tbody>

</table>

</div>
<!-- <table class="table" align="center" style="width:80%;">

					<tr class="data_of_type">
						<td class="text-center"><?php echo $j; ?></td>
						<td class="text-center"><input type="text" class="form-control first_width" value="<?php echo $no_service_date; ?>" name="service[service_date][]"></td>
						<td class="text-center"><input type="text" class="form-control second_width" name="service[service_text][]" value="<?php echo $no_service_arry[$get_service_data];?>" ></td>
						</tr>
						
					</table> -->


</div>	
				 <div class="header">
          		<h3><?php echo __('Amc Details'); ?></h3>
          </div>
		  
		  <button type="button" id="add_newrow" class="btn btn-default" style="margin:5px 0px;">Add New </button>
		  
				 <table class="table table-bordered" id="tab_product_detail" align="center">
					<thead>
					<tr>
						<th><?php echo __('Product');?></th>
						
						<th><?php echo __('Note');?></th>
						
						<th><?php echo __('Action');?></th>
						
					</tr>
				</thead>			
				<tbody>
				<?php $row_id = 0;?>
				<?php if(isset($ah_histroy)) {
					foreach($ah_histroy as $ah_row){
					
					
				?>
						<tr id="row_id_<?php echo $row_id;?>">
							<td>
								<select name="product[product_id][]" class="form-control select_product" id="product_id_<?php echo $row_id;?>" data-id="<?php echo $row_id;?>">
									<option value=""><?php echo __('--Select Product--');?></option>
									<?php  
											if($product_row){
									foreach($product_row as $product_info){
										?>

			<option value="<?php echo $product_info['product_id']?>" <?php  
									if($product_info['product_id'] == $ah_row['item_name']){
										echo 'selected="selected"';
									}
									
			
			?> ><?php echo $product_info['product_code'].' '.$product_info['item_name']; ?></option>

										<?php
									}
								}
									?>						
								</select>
							</td>
							
							
							
							
							
							<td>
								<input type="text" name="product[note][]" class="quantity form-control" data-id ="<?php echo $row_id;?>" value="<?php echo $ah_row['note'];?>" id="note_<?php echo $row_id;?>">
							</td>
							
							
						
							<td>
								<span class="trash" data-id="<?php echo $row_id;?>"><i class="fa fa-trash"></i> Delete</span>
								
							</td>
						</tr>
						<?php
						}
					}
					?>
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
<script>
	$(document).ready(function(){
		
		
		$("#no_of_service").change(function(){
			
			var interval=$("#interval").val();
			
			
			var no_service=$("#no_of_service").val();
			var url = $(this).attr('url');
			
			if(interval!='' && no_service!='')
			{
				if($("#interval").val() == 0){
				  swal({   
							title: "Interval",
							text: "Please select Interval!"   

						});
				  $('#no_of_service').html('<option value="0">No of service </option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>');
				  return false;
				}
			 
			if(interval!='' && no_service!='') {
			 
					
					
					$("#interval").change(function(){
						$("#load_service_data").css("display", "none");
						 $('#no_of_service').html('<option value="0">No of service </option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option>');
				 
					});
					
					
					$("#no_of_service").change(function(){
						$("#load_service_data").css("display", "block");
					});
			 
			$.ajax({
                       type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Ajax","action" => "getservices"]);?>',
                     data : {interval:interval,no_service:no_service},
                     success: function (response)
                        {
							
                            $("#load_service_data").html(response);
						},
                    error: function(e) {
                   alert("An error occurred: " + e.responseText);
                    console.log(e);
                },
				beforeSend:function(){
					$("#load_service_data").html("<center><h3>Loading...</h3></center>");
				}
				
			}); 
			 
			 
			}
			}
			
			
		});
	});
</script>

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
		jQuery(this).attr("disabled", "disabled");
		var row_id = jQuery("#tab_product_detail > tbody > tr").length;
		var action = 'add_newrow';
		jQuery.ajax({
                       type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Ajax","action" => "addamcrow"]);?>',
                     data : {row_id:row_id},
                     success: function (response)
                        {	
                            jQuery("#tab_product_detail > tbody").append(response);
							return false;
						},
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
       });
	});
	/*---*/

    jQuery('body').on('blur','.quantity',function(){ 
			jQuery("#add_newrow").attr("disabled", false);
            var qty= jQuery(this).val();
			var row_id =jQuery(this).attr('data-id');
			var product_id = jQuery('#product_id_'+row_id).val();
			var total_price = 0;

			
			console.log(qty);

			jQuery.ajax({
                       type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Ajax","action" => "productdetail"]);?>',
                     data : {row_id:row_id,product_id:product_id},
                     success: function (response)
                        {	

                             var json_obj = jQuery.parseJSON(response);					
							
							var price = json_obj['price'];
							
							total_price =  price * qty;
							jQuery('#price_'+row_id).val(price);
						jQuery('#amount_'+row_id).val(total_price);
						
							return false;
						},
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
       });
			
			
        });

/*-----*/

	jQuery('body').on('click','.trash',function(){
		var row_id = jQuery(this).attr('data-id');
		
		jQuery('table#tab_product_detail tr#row_id_'+row_id).remove();	
		return false;
	});
	


	function deleteParentElement(n){
   		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
   	}
	
   
 

});
        
           
 



</script>		