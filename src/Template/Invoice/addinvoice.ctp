<?php 
use Cake\Routing\Router;
$action = $this->request->params['action'];
$user_role=$this->request->session()->read('user_role');
?>
<?php if($user_role == 'admin'){
?>
<div class="row panel-body">			
				<ul role="tablist" class="nav nav-tabs panel_tabs">
                    
                       <li class="">
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Invoice List'),
array('controller'=>'Invoice','action' => 'viewinvoice'),array('escape' => false));
						?>						  
					  </li>
                    
					  <li class="<?php echo $action=='addinvoice'?'active':''?>">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Invoice'),array('controller'=>'Invoice','action' => 'addinvoice'),array('escape' => false));
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

         
		
		 
	
				<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Invoice No'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'invoice_no','value'=>$invoice_no,'class'=>'form-control validate[required]','readonly'));?>
						</div>

						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Reference Number'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'reference_no','value'=>'','class'=>'form-control validate[required]','placeholder'=>__('')));?>
						</div>
						
				</div>


				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Invoice Date'));?></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'date','value'=>date('Y-m-d'),'id'=>'date','class'=>'form-control','placeholder'=>__('Date')));?>
							</div>
							
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Contact Person:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'contact_person','value'=>'','class'=>'form-control validate[required]','placeholder'=>__('Enter Name')));?>
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
								
							<select class="form-control" id="customer" name="customer_id"> 
								<option value="" selected="selected">--Select Customer--</option>
								<?php 
									if(isset($clinet_info)){
										foreach($clinet_info as $client_row){
										?>
		<option value="<?php echo $client_row['user_id'];?>" ><?php echo $client_row['first_name'].' '.$client_row['last_name']; ?></option>
										<?php
										}
									}
								?>
							</select>
							
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Mobile No:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'mobile','value'=>'','id'=>'mobile','class'=>'form-control validate[required]','placeholder'=>__('Enter Mobile Number')));?>
							</div>
				</div>

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Invoice For'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
							<select class="form-control" name="invoice_for">
									<option value=""><?php echo __('Select'); ?></option>
									<option value="0"><?php echo __('Sales');?></option>
							</select>	
							
							</div>

							<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Email'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'email','value'=>'','id'=>'email','class'=>'form-control validate[required]','placeholder'=>__('Enter Email')));?>
						</div>
				</div>
			
			


<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Subject'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->textarea('',array('name'=>'subject','value'=>'','class'=>'form-control validate[required]'));?>
						</div>
						
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Billing Address'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->textarea('',array('name'=>'address','value'=>'','id'=>'address','class'=>'form-control validate[required]'));?>
						</div>
						
						
			</div>

			

		



				 <div class="header">
          		<h3><?php echo __('Sales Details'); ?></h3>
          </div>
		  
		  <button type="button" id="add_newrow" class="btn btn-default" style="margin:5px 0px;">Add New </button>
		  
				 <table class="table table-bordered" id="tab_product_detail" align="center">
					<thead>
					<tr>
						<th><?php echo __('Product');?></th>
						<th><?php echo __('Quantity');?></th>
						<th><?php echo __('Price');?></th>
						<th><?php echo __('Amount');?></th>
						<!--<th><?php echo __('Warehouse');?></th>-->
						<th><?php echo __('Action');?></th>
						
					</tr>
				</thead>			
				<tbody>
				<?php $row_id = 0;?>
						<tr id="row_id_<?php echo $row_id;?>">
							<td>
								<select name="product[product_id][]" class="form-control select_product" id="product_id_<?php echo $row_id;?>" data-id="<?php echo $row_id;?>">
									<option value=""><?php echo __('--Select Product--');?></option>
									<?php  
											if($product_row){
									foreach($product_row as $product_info){
										?>

			<option value="<?php echo $product_info['product_id']?>"><?php echo $product_info['product_code'].' '.$product_info['item_name']; ?></option>

										<?php
									}
								}
									?>						
								</select>
							</td>
							<td>
								<input type="text" name="product[quantity][]" class="quantity form-control" data-id ="<?php echo $row_id;?>" value="0" id="quantity_<?php echo $row_id;?>">
							</td>
							<td>
								<input type="text" name="product[price][]" class="product form-control" data-id ="<?php echo $row_id;?>" value="" id="price_<?php echo $row_id;?>" readonly='true'>
							</td>
							<td>
								<input type="text" name="product[amount][]" class="product form-control" data-id ="<?php echo $row_id;?>" value="" id="amount_<?php echo $row_id;?>" readonly='true'>
							</td>
						<!--	<td>
								<select class="form-control" id="warehouse_<?php echo $row_id;?>"  data-id ="<?php echo $row_id;?>" name="product[warehouse_id][]">
								 <option value="0"><?php echo __('--Warehouse--'); ?></option>
														<?php
															if(isset($warehouselist)){
																foreach($warehouselist as $warehouse_info){
														?>
														<option value="<?php echo $warehouse_info['cat_id'];?>" <?php 
																	if(isset($product_data)){
																		if($warehouse == $warehouse_info['cat_id']){
																			echo 'selected="selected"';
																		}else{
																			echo '';
																		}
																	}
																
																?> ><?php echo $warehouse_info['category_title'];?></option>
														<?php
																}
															}
														?>
													</select>
							</td>-->
							<td>
								<span class="trash" data-id="<?php echo $row_id;?>"><i class="fa fa-trash"></i> Delete</span>
								
							</td>
						</tr>
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
	
   
 CKEDITOR.replace( 'message' );
 


});
        
           
 



</script>		