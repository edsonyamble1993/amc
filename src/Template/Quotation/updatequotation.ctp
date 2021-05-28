<?php

$idf=(isset($update_row)) ? $update_row['quotation_no']: $quotation_id ;
$date=(isset($update_row)) ? date($this->Amc->getDateFormat(),strtotime($update_row['quotation_date'])):date('Y-m-d'); 
$contact_person=(isset($update_row))? $update_row['contact_person']:'';
$mobile=(isset($update_row))?$update_row['mobile']:'';
$email=(isset($update_row))? $update_row['email']:'';
$quotation_for=(isset($update_row))?$update_row['quotation_for']:'';
$status=(isset($update_row))?$update_row['status']:'';
$amount=(isset($update_row))?$update_row['amount']:'0';
$subject=(isset($update_row))?$update_row['subject']:'';
$address=(isset($update_row))?$update_row['address']:'';
$reference_no=(isset($update_row))?$update_row['reference_no']:'';
$message=(isset($update_row))? html_entity_decode($update_row['message']):'';
if(isset($update_row)){
	if($update_row['approve'] == 1){
		$ck='checked';
	}else{
		$ck='';
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
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Quotation List'),
array('controller'=>'Quotation','action' => 'index'),array('escape' => false));
						?>						  
					  </li>
                    
					  <li class="<?php echo $action=='updatequotation'?'active':''?>">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Edit Quotation'),array(),array('escape' => false));
						?>
  
					  </li>
				</ul>

<script>
$(function(){

	jQuery('#date').datepicker({
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
						<?php echo $this->Form->label(__('Quotation No'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'quotation_no','value'=>$idf,'class'=>'form-control validate[required]','readonly','required'=>'required'));?>
						</div>
                    
                    <div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Quotation Date'));?></div>
                    
							<div class="col-sm-4">
								<?php //echo $this->Form->input('',array('name'=>'quotation_date','value'=>$date,'id'=>'date','class'=>'form-control','placeholder'=>__('Date'),'required'=>'required'));?>
								<input type="date" name="quotation_date" class="form-control" placeholder="Date" value="<?php echo date("Y-m-d",strtotime($date)); ?>" id="">
							</div>
                    
						
				</div>


				<div class="form-group">
                    	<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Customer Name'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								
							<select class="form-control" id="customer" name="customer_id" required> 
								<option value="" selected="selected">--Select Customer--</option>
								<?php 
									if(isset($clinet_info)){
										foreach($clinet_info as $client_row){
										?>
		<option value="<?php echo $client_row['user_id'];?>" <?php 
							if(isset($update_row)){

								if($update_row['customer_id'] == $client_row['user_id']){
									echo 'selected="selected" ';
								}
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
							<input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter Mobile Number" value="<?php echo $mobile; ?>" readonly>
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
                 alert("Wrong Selection..");
                   
                }
						});


						});


				});
				</script>

				<div class="form-group">
							<!--<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Quotation For'));?></div>
                    
							<div class="col-sm-4">
							<select class="form-control" name="quotation_for">
									<option value=""><?php echo __('Select'); ?></option>
									<option value="5" selected="selected"><?php echo __('AMC Renewal'); ?></option>
									<option value="4"><?php echo __('AMC Service');?></option>
									<option value="2"><?php echo __('Complaint'); ?></option>
									<option value="1"><?php echo __('New AMC');?></option>
									<option value="3"><?php echo __('Sales');?></option>
							</select>	
							
							</div> -->

							<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Email'));?>
						</div>
						<div class="col-sm-4">
						<input type="text" name="email" id="email" class="form-control " placeholder="Enter Email" value="<?php echo $email; ?>" readonly>
							</div>
                    
            
			
				
                    	<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Status'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<!--<?php echo $this->Form->input('',array('name'=>'status','value'=>'','readonly','class'=>'form-control validate[required]','placeholder'=>__('')));?>-->
                            <?php  $status_quotation=array(0=>'Open',1=>'Pending',2=>'Closed'); ?>
                            <select class="form-control" name="status">
                                <?php 
							
									
                                    foreach($status_quotation as $status_key=>$status_val){
                                ?>
                                 <option value="<?php echo $status_key;?>" <?php 
									if(isset($update_row)){
										 if($update_row['status'] == $status_key){
											 echo 'selected="selected"';
										 }
									}
								 ?>><?php echo $status_val; ?></option>
                                <?php  } ?>
                            </select> 
						</div> 
                    
                    
                    
				</div>
			
<div class="form-group">
						
						
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Billing Address'));?> 
						</div>
						<div class="col-sm-4">
						<textarea name="address" id="address" class="form-control" rows="5" readonly><?php echo $address; ?></textarea>
							</div>
						
						
			</div>

			
			
			
			
			
    
			
			<div class="header panel-body">
          		<h3><?php echo __('Other Info'); ?></h3>
			</div>
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Message'));?>
						</div>
						<div class="col-sm-10">
							<?php echo $this->Form->textarea('',array('name'=>'message','value'=>$message,'id'=>'massage','class'=>'form-control validate[required]'));?>	
						</div>
					
						
			</div>

				 <div class="header">
          		<h3><?php echo __('Quotation Details'); ?></h3>
          </div>
		  
		  <button type="button" id="add_newrow" class="btn btn-default" style="margin:5px 0px;">Add New </button>
		  
				 <table class="table table-bordered" id="tab_product_detail" align="center">
					<thead>
					<tr>
						<th><?php echo __('Product');?></th>
						<th><?php echo __('Quantity');?></th>
						<th>Price (<?php echo $this->AMC->getCurrencyCode(); ?>)</th>
						<th>Amount (<?php echo $this->AMC->getCurrencyCode(); ?>)</th>
						<!--<th><?php echo __('Warehouse');?></th>-->
						<th><?php echo __('Action');?></th>
						
					</tr>
				</thead>			
				<tbody>
				<?php $row_id = 0;?>
						
						<?php
						if($qh_histroy){
							foreach($qh_histroy as $qh_row){
								?>
						
						<tr id="row_id_<?php echo $row_id;?>">
							<td>
								<select name="product[product_id][]" class="form-control select_product" id="product_id_<?php echo $row_id;?>" data-id="<?php echo $row_id;?>" required>
									<option value=""><?php echo __('--Select Product--');?></option>
									<?php  
											if($product_row){
												foreach($product_row as $product_info){
											?>

			<option value="<?php echo $product_info['product_id']?>" <?php 
								if($qh_row['item_name'] == $product_info['product_id']){
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
								<input type="text" name="product[quantity][]" class="quantity form-control" data-id ="<?php echo $row_id;?>" value="<?php echo $qh_row['qty']; ?>" id="quantity_<?php echo $row_id;?>">
							</td>
							<td>
								<input type="text" name="product[price][]" class="product form-control" data-id ="<?php echo $row_id;?>" value="<?php echo $qh_row['price']?>" id="price_<?php echo $row_id;?>" readonly='true'>
							</td>
							<td>
								<input type="text" name="product[amount][]" class="product form-control" data-id ="<?php echo $row_id;?>" value="<?php echo $qh_row['net_amount']; ?>" id="amount_<?php echo $row_id;?>" readonly='true'>
							</td>
						
							<td>
								<span class="trash" style="cursor:pointer" data-id="<?php echo $row_id;?>"><i class="fa fa-trash"></i> Delete</span>
								
							</td>
						</tr>
						<?php 
                              $row_id++;   
					     	}
						}
						?>
				</tbody>
			</table>

<style>
	.displaydatanone
	{
		display:none;
	}
</style>	
<div class="header">
          		<h3><?php echo __('Account Tax'); ?></h3>
          </div>
 <button type="button" id="add_new_tax" class="btn btn-default" style="margin:5px 0px;">Add New </button>
		  
<table class="table table-bordered addtaxtype" id="tab_taxes_detail" align="center">
					<thead>
					<tr>
						<th><?php echo __('Select Tax');?></th>
						<th><?php echo __('Tax');?></th>
						
						<th><?php echo __('Action');?></th>
						
					</tr>
				</thead>			
				<tbody>
				
				
				
				
			
			
				
				
				
				<?php if(!empty($tax_account)) { 
				$i = 1;
				foreach($tax_account as $tax_accounts){
				?>
				
						<tr class="row_id_<?php echo $i ?>">
							<td>
								<select name="account[tax_name][]" class="form-control tax_change" row_did="<?php echo $i ?>" required>
									<option value=""><?php echo __('--Select Tax--');?></option>
									<?php  
											if($accout_tax){
									foreach($accout_tax as $accout_taxs){
										?>

			<option value="<?php echo $accout_taxs['acount_tax_name']; ?>" <?php if($accout_taxs['acount_tax_name'] == $tax_accounts['tax_name']){ echo 'selected'; } ?> ><?php echo $accout_taxs['acount_tax_name']; ?></option>

										<?php
									}
								}
									?>						
								</select>
							</td>
							
							<td>
								<input type="text" name="account[tax][]" class="product form-control tax_name_<?php echo $i ?>"  value="<?php  echo  $tax_accounts['tax']; ?>"  readonly='true'>
							</td>
						
							<td>
								<span class="trash_account" data-id="<?php echo $i ?>"><i class="fa fa-trash"></i> Delete</span>
								
							</td>
						</tr>
						
				<?php $i++; } } ?>
                    </div>
						
						 
				</tbody>
			</table>
			
 		



			<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
							<?php echo $this->Form->input(__('Save'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success submitdata'));?>
							</div>
				</div>
			<?php $this->Form->end(); ?>
		
</div>			

<script>
$(document).ready(function(){
	$('.submitdata').click(function(){
		$('.displaynone').remove();
		$('.displaydatanone').remove();
	});
});
$(document).ready(function(){
	$('body').on('click','#add_new_tax',function(){
		var row_id = $(".addtaxtype > tbody > tr").length;
		$.ajax({
                       type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Ajax","action" => "getRowTax"]);?>',
                     data : {row_id:row_id},
                     success: function (response)
                        {	
							
                            $(".addtaxtype > tbody").append(response);
							return false;
						},
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
       });
		
	
});
$('body').on('click','.trash_account',function(){
	var trash = $(this).attr('data-id');
	$('.row_id_'+trash).addClass('displaydatanone');
});
});
</script>
<script>
$(document).ready(function(){
	$('body').on('change','.tax_change',function(){
		//var row_id = $(".addtaxtype > tbody > tr").length;
		var row_id = $(this).attr('row_did');
		
		var tax = $(this).val();
		$.ajax({
                       type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Ajax","action" => "getTax"]);?>',
                     data : {
						 tax:tax,
						 },
                     success: function (response)
                        {
						
                         $('.tax_name_'+row_id).attr('value',response); 
						},
                    error: function(e) {
                   alert("An error occurred: " + e.responseText);
                    console.log(e);
                },
				
	});
	
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
                      url: '<?php echo Router::url(["controller" => "Ajax","action" => "addnewrow"]);?>',
                     data : {row_id:row_id},
                     success: function (response)
                        {	
                            jQuery("#tab_product_detail > tbody").append(response);
							return false;
						},
                   
       });
	});
	/*---*/

     jQuery('body').on('keyup','.quantity',function(){
			jQuery("#add_newrow").attr("disabled", false);
            var qty= jQuery(this).val();
			var row_id =jQuery(this).attr('data-id');
			var product_id = jQuery('#product_id_'+row_id).val();
			var total_price = 0;

			//console.log(qty);

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

							//return false;
						},
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
       });


        });
		
		//$(".select_product").change(function(){
			//product chage event
			 jQuery('body').on('change','.select_product',function(){
		
			var row_id =jQuery(this).attr('data-id');
			 var qty= jQuery('#quantity_'+row_id).val();
			var product_id = jQuery('#product_id_'+row_id).val();
			var total_price = 0;
				
			
			
				
			jQuery.ajax({
                       type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Ajax","action" => "productdetail"]);?>',
                     data : {row_id:row_id,product_id:product_id},
                     success: function (response)
                        {

                             var json_obj = jQuery.parseJSON(response);
							console.log(json_obj);
							var price = json_obj['price'];

							total_price =  price * qty;
							
							jQuery('#price_'+row_id).val(price);
						jQuery('#amount_'+row_id).val(total_price);

							//return false;
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
	
   
 CKEDITOR.replace( 'message' );
 


});
        
           
 



</script>		