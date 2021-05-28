
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
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Sales'),
array('controller'=>'Sales','action' => 'viewsales'),array('escape' => false));
						?>						  
					  </li>
                    
					  <li class="<?php echo $action=='sales'?'active':''?>">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Sales'),array('controller'=>'Sales','action' => 'addsales'),array('escape' => false));
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
						<label>Quotation No</label>
						</div>
						<div class="col-sm-10">
							<?php echo $this->Form->input( 
												'',
												array(
														'name'=>'quotation_no',
														'value'=>"",
														'id'=>"quotation_no",
														'class'=>'form-control validate[required]',
														'placeholder'=>'Quotation no'
														)
														);
											?>
						</div>
	
				</div>	
				
				<script>
				$(function(){
                    
               
				function dateToYMD(date) {
                     var d = date.getDate();
                     var m = date.getMonth() + 1;
                      var y = date.getFullYear();
                    return '' + y + '-' + (m<=9 ? '0' + m : m) + '-' + (d <= 9 ? '0' + d : d);
}
					
                     var availableTags = <?php echo json_encode($quo_no);?>;
    $( "#quotation_no" ).autocomplete({
      source: availableTags
    });
                    
                    $(".ui-autocomplete").click(function(){
                      $("#quotation_no").trigger("blur");
                    });
                    
                    
                    
                     
					
					$('#quotation_no').on("blur", function(event) {
								
								//function callsales(){
								get_quotation_no=$(this).val();
                        // xhr of product details
                        
                        
                        	$.ajax({
                                    type: 'POST',
                                    url: '<?php echo Router::url(["controller" => "Ajax","action" => "getquotationproducts"]);?>',
                                    data : {quotation_id_forproduct:get_quotation_no},
                                    success: function (response) {
                                        
                                        if(response != 0){
                                            $("tbody").html(response);
                                        }else{
                                            $("tbody").html("");
                                          
                                           $("#add_newrow").trigger("click");
                                            
                                        }
                                       
						
						},
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                },
				beforeSend:function(){
				
					console.log('Loading Products...');
                    
				}
       });
                        
                        
                        
                        
                        
                        
                        //xhr end of product details
                        
                        
                        
                        
								
								$.ajax({
                                    type: 'POST',
                                    url: '<?php echo Router::url(["controller" => "Ajax","action" => "getquotationdata"]);?>',
                                    data : {quotation_id:get_quotation_no},
                                    success: function (response) {
                                        console.log(response);
                                        if(response != 0){
                                        console.log(response);
									 var json_obj = jQuery.parseJSON(response);					
							        var quotation_da   =json_obj.quotation.quotation_date;
										var d1 = new Date(quotation_da);
                                        
							
				                        var final_date=dateToYMD(d1);
							           $("#date").val(final_date);
								       $("#contact_person").val(json_obj.quotation.contact_person);
									   $('#email').val(json_obj.quotation.email);
									   $('#mobile').val(json_obj.quotation.mobile);
									   $('#remark').val(json_obj.quotation.subject);
									   $('#address').val(json_obj.quotation.address);
                                       //$('#customer').val(json_obj.quotation.customer_id);
                                         var num_customer_id = json_obj.quotation.customer_id;
                                       
         
                                   $('#customer').find('option').each(function() {
                                       if($(this).val() == num_customer_id){
                $("#customer").find("option[value="+num_customer_id+"]").attr("selected","selected"); 
                                    }
                             });
                                  
                             
                                        }else if(response == 0){
                                            
                                          $("#date").val("");
                                          $("#contact_person").val("");
									      $('#email').val("");
									      $('#mobile').val("");
									      $('#remark').val("");
									      $('#address').val("");
                                            
                                
                                        }
							
							
						
						
						},
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                },
				beforeSend:function(){
				/*
					 $("#date").val('Loading...');
					 $("#contact_person").val('Loading...');
					 $('#email').val('Loading...');
					 $('#mobile').val('Loading...');
				     $('#remark').val('Loading...');
					 $('#address').val('Loading...');*/
                    
				}
       });
								
					
                        
                        
                        
								
                            //    }
					});
                    
                    			
								
					              
                    
                     
				
				 });
				</script>
				
				
				
				
				
					
					
					
			
         
				<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Bill No'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'bill_number','value'=>$sales_idf,'class'=>'form-control validate[required]','readonly'=>'required'));?>
						</div>

						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Status'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<select name="status" class="form-control">
							<option value="unpaid">UnPaid</option>
							<option value="fullpaid">Full Paid</option>
							<option value="halfpaid">Half Paid</option>
							
							</select>
							
							
						</div>
						
				</div>


      <!--
				<div class="form-group">
                    
                  
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Quotation Date'));?></div>
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'date','value'=>isset($set_quotation)?date($this->Amc->getDateFormat(),strtotime($set_quotation['quotation_date'])):'','id'=>'date','class'=>'form-control','placeholder'=>__('Date'),'required'=>'required'));?>
							</div>
                 
							
                    
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Contact Person:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'contact_person','id'=>'contact_person','value'=>isset($set_quotation)?$set_quotation['contact_person']:'','class'=>'form-control validate[required]','placeholder'=>__('Enter Name'),'required'=>'required'));?>
							</div>
                        
							
				</div>
                           -->

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
								<option value="">--Select Customer--</option>
								<?php 
									if(isset($clinet_info)){
										foreach($clinet_info as $client_row){
										?>
		<option value="<?php echo $client_row['user_id'];?>" <?php 
					if(isset($set_quotation)){
					  if($client_row['user_id'] == $set_quotation['customer_id']){
						echo 'selected="selected"';
					  } 
					}
						
		
		?>><?php echo $client_row['first_name'].' '.$client_row['last_name']; ?></option>
										<?php
										}
									}
								?>
							</select>
							
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Mobile No:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'mobile','value'=>isset($set_quotation)?$set_quotation['mobile']:'','id'=>'mobile','class'=>'form-control validate[required]','placeholder'=>__('Enter Mobile Number')));?>
							</div>
				</div>

				<div class="form-group">
					<!--	
                    <div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Sale by'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
							<select class="form-control" name="sales_by">
									<option value=""><?php echo __('Select'); ?></option>
									<option value="5" selected="selected"><?php echo __('AMC Renewal'); ?></option>
									<option value="4"><?php echo __('AMC Service');?></option>
									<option value="2"><?php echo __('Complaint'); ?></option>
									<option value="1"><?php echo __('New AMC');?></option>
									<option value="3"><?php echo __('Sales');?></option>
							</select>	
							
							</div>
                    -->

							<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Email'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'email','value'=>isset($set_quotation)?$set_quotation['email']:'','id'=>'email','class'=>'form-control validate[required]','placeholder'=>__('Enter Email'),'required'=>'required'));?>
						</div>
                    
                    <div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Billing Address'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->textarea('',array('name'=>'address','value'=>isset($set_quotation)?$set_quotation['address']:'','id'=>'address','class'=>'form-control validate[required]'));?>
						</div>
				</div>
    
    
    
    
    <div class="form-group">
    
    
            	<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('AMC Code'));?> <span class="require-field">*</span>
						</div>
        
						<div class="col-sm-4">
<?php echo $this->Form->input('',array('name'=>'','value'=>'email','id'=>'email','class'=>'form-control validate[required]','placeholder'=>__('Amc Code'),'required'=>'required'));?>
						</div>
        
        
        
        
        
        
        
        
        
        
        
    </div>
    
    
    
    
    
    
			
			


<div class="form-group">
						<!--<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Remark'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->textarea('',array('name'=>'remark','id'=>'remark','value'=>isset($set_quotation)?$set_quotation['subject']:'','class'=>'form-control validate[required]'));?>
						</div>
                            -->
						
						
						
						
						
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
				
				<?php
				if(isset($qh_histroy) && !empty($qh_histroy)){
					
					
				?>
				
				
				<?php $row_id = 0;?>
					<?php 
						foreach($qh_histroy as $qh_row){
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
								<span class="trash" data-id="<?php echo $row_id;?>"><i class="fa fa-trash"></i> Delete</span>
								
							</td>
						</tr>
				
				
				
				
				<?php
				   $row_id++;
					}
				
				
				}else{
				
				
			
				?>
				
				
				
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
						
							<td>
								<span class="trash" data-id="<?php echo $row_id;?>"><i class="fa fa-trash"></i> Delete</span>
								
							</td>
						</tr>
                    </div>
						<?php
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
		//jQuery(this).attr("disabled", "disabled");
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
	
   

 


});
        
           
 



</script>		