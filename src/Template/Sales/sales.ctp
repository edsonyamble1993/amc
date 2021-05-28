
<?php 

use Cake\Routing\Router;
$action = $this->request->params['action'];
$user_role=$this->request->session()->read('user_role');
?>


<style>
.displaynone
{
	display:none;
}
</style>
<div class="row panel-body">			
				<ul role="tablist" class="nav nav-tabs panel_tabs">
                    
                       <li class="">
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Sales'),
array('controller'=>'Sales','action' => 'viewsales'),array('escape' => false));
						?>						  
					  </li>
                    
					  <li class="<?php echo $action=='sales'?'active':''?>">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Sales'),array(),array('escape' => false));
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
						<?php echo $this->Form->label(__('Bill No'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
						<input type="text" name="bill_number" class="form-control validate[required]" id="" value="<?php echo $sales_idf; ?>" readonly>
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
							<?php echo $this->Form->label(__('Status'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<select name="status" class="form-control">
							<option value="unpaid">UnPaid</option>
							<option value="fullpaid">Full Paid</option>
							<option value="halfpaid">Half Paid</option>
							
							</select>
							
							
						</div>
						<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Sales Date'));?></div>
                    
							<div class="col-sm-4">
								<?php //echo $this->Form->input('',array('name'=>'date','value'=>isset($set_quotation)?date('Y-m-d',strtotime($set_quotation['quotation_date'])):'','id'=>'date','class'=>'form-control','placeholder'=>__('Date'),'required'=>'required'));?>
								<input type="date" name="date" value="<?php echo isset($set_quotation)?date('Y-m-d',strtotime($set_quotation['quotation_date'])):'' ?>" class="form-control" placeholder="Date" id="">
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
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Mobile No:'));?></div>
                    
							<div class="col-sm-4">
							<input type="text" name="mobile" id="mobile" class="form-control" placeholder="Enter Mobile Number" value="<?php echo isset($set_quotation)?$set_quotation['mobile']:'' ?>" readonly>
								</div>
				</div>

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Amc Type'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
							<select class="form-control" name="amc_typeid" id="amctype_id" required="required">
									 <option value="2">No AMC</option>
           							 <option value="1">AMC</option>
							</select>
							
							</div>

							


							<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Email'));?> 
						</div>
						<div class="col-sm-4">
						<input type="text" name="email" id="email" class="form-control" placeholder="Enter Email"  value="<?php echo isset($set_quotation)?$set_quotation['email']:'' ?>" readonly>
							</div>
				</div>
			
			


<div class="form-group">
						
						
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Billing Address'));?> 
						</div>
						<div class="col-sm-4">
						<textarea name="address" id="address" class="form-control " rows="5" readonly><?php echo isset($set_quotation)?$set_quotation['address']:'' ?></textarea>
							</div>
						
						
			</div>
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


	$("#end_date").datepicker({
         dateFormat: "yy-mm-dd",
         changeMonth: true,
	        changeYear: true
	});

		$('#amctypesave').click(function(){
		var amc_type = $('#txtamctype').val();
		
		if(amc_type == ""){
			alert('Please Enter AMC Type');
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


});
</script>



<script>
				$(function(){

					 $('#amc_warranty').change(function(){
       
    				var sel_text= parseInt($("#amc_warranty option:selected").text());
   					 var due_date=$('#start_date').val();


        			var date=new Date(due_date);
        			var newdate=new Date(date);
        			newdate.setDate(newdate.getDate());
        			var dd=newdate.getDate();
       				var mm=newdate.getMonth()+1;
        			var y=newdate.getFullYear()+sel_text;
        
            			fo='';
            		if(mm == 11 || mm == 12){
               		 fo='';
           			 }else{
              		  fo='0';
            		}
        
        			var someformat=y+'-' +fo+ mm + '-' +dd;
        			
           			//$('#end_date').attr('value',someformat);
       
    					});

				});
				</script>
			<div class="form-group start_end_date" style="display:none;">
					<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Start Date'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'start_date','value'=>date('Y-m-d'),'id'=>'start_date','class'=>'form-control validate[required]','required'=>'required'));?>
						</div>
						
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('End Date'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'end_date','value'=>date('Y-m-d', strtotime('+1 year')),'id'=>'end_date','class'=>'form-control validate[required]','required'=>'required'));?>
						</div>

			</div>
<div class="form-group no_of_service" style="display:none;">
			<div class="col-sm-2 label_right" >
				<?php echo $this->Form->label(__('No Of Service'));?> 
				
			</div>
			<div class="col-sm-4" >
			<select name="no_of_services" id="no_service" class="form-control no_of_service_amc_Type"> 
			<option value="">No of service </option>
					<?php 
						for($no=1;$no<=12;$no++){
							?>
							<option value="<?php echo $no; ?>"><?php echo $no;?></option>
							<?php
						}
					?>
				</select>
				
			</div>
			<?php if($this->request->session()->read('user_role') == 'admin'){ ?>
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Assign to'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<select class="form-control assign_required_feild" name="assign_to" >
							<option value=""><?php echo __('Select Name'); ?></option>
							<?php
								if(isset($employee_info)){
									foreach($employee_info as $emp_data){
										?>
											<option value="<?php echo $emp_data['user_id'];?>"><?php echo $emp_data['first_name'].' '.$emp_data['last_name']; ?></option>

										<?php
										}
								}
								?>
							</select>
						</div>
<?php } ?>

</div>


<div class="form-group">
							

							


							<div class="col-sm-2 label_right">
							Discount(%) :
						</div>
						<div class="col-sm-4">
						<input type="text" name="discount" value="0"  class="form-control" placeholder="Discount" required>
							</div>
				</div>



		<div id="load_service_data">




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
						<th>Price (<?php echo $this->AMC->getCurrencyCode(); ?>)</th>
						<th>Amount (<?php echo $this->AMC->getCurrencyCode(); ?>)</th>
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
								<select name="product[product_id][]" class="form-control select_product" id="product_id_<?php echo $row_id;?>" data-id="<?php echo $row_id;?>" required>
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
				
				
				
				
			<?php if(isset($account_history) && !empty($account_history)){
			$rowno = 1;
			foreach($account_history as $account_historys)
			{ ?>
				<tr class="row_id_<?php echo $rowno; ?>">
							<td>
								<select name="account[tax_name][]" class="form-control tax_change" row_did="<?php echo $rowno; ?>" required>
									<option value=""><?php echo __('--Select Tax--');?></option>
									<?php  
											if($accout_tax){
									foreach($accout_tax as $accout_taxs){
										$select = "";
										if($accout_taxs['acount_tax_name'] == $account_historys['tax_name'])
										{
											$select = "selected";
										}
										?>

			<option value="<?php echo $accout_taxs['acount_tax_name']; ?>" <?php echo $select; ?>><?php echo $accout_taxs['acount_tax_name']; ?></option>

										<?php
									}
								}
									?>						
								</select>
							</td>
							
							<td>
								<input type="text" name="account[tax][]" class="product form-control tax_name_<?php echo $rowno; ?>"  value="<?php echo $account_historys['tax']; ?>"  readonly='true'>
							</td>
						
							<td>
								<span class="trash_account" data-id="<?php echo $rowno; ?>"><i class="fa fa-trash"></i> Delete</span>
								
							</td>
						</tr> <?php
						$rowno++;
			}
			
			}else{ ?>
				
				<tr class="row_id_1">
							<td>
								<select name="account[tax_name][]" class="form-control tax_change" row_did="1" required>
									<option value=""><?php echo __('--Select Tax--');?></option>
									<?php  
											if($accout_tax){
									foreach($accout_tax as $accout_taxs){
										?>

			<option value="<?php echo $accout_taxs['acount_tax_name']; ?>"><?php echo $accout_taxs['acount_tax_name']; ?></option>

										<?php
									}
								}
									?>						
								</select>
							</td>
							
							<td>
								<input type="text" name="account[tax][]" class="product form-control tax_name_1"  value=""  readonly='true'>
							</td>
						
							<td>
								<span class="trash_account" data-id="1"><i class="fa fa-trash"></i> Delete</span>
								
							</td>
						</tr>
		<?php 	}
			
				?>
				
				
				
						
                    </div>
						
						 
				</tbody>
			</table>


			<div class="form-group">
							<div class="">
							<?php echo $this->Form->input(__('Save'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success submitdata'));?>
							</div>
				</div>
			<?php $this->Form->end(); ?>
		
</div>			


<script>
$(document).ready(function(){
	$('.submitdata').click(function(){
		$('.displaynone').remove();
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
	$('.row_id_'+trash).fadeOut();
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
<script>
$(document).ready(function(){
	
	var amc_type = $('#amctype_id').val();
	$('#amctype_id').change(function(){
		var amc_type_Val  = $(this).val();
		if(amc_type_Val == 1)
		{
			$(".assign_required_feild").attr("required", "true");
			$('.start_end_date').css('display','block');
			$('.amc_warranty_none').css('display','block');
			$('.no_of_service').css('display','block');
		}
		if(amc_type_Val == 2)
		{
			$(".assign_required_feild").removeAttr("required");
			//$(".assign_required_feild").attr("required", "false");
			$('.start_end_date').css('display','none');
			$('.amc_warranty_none').css('display','none');
			$('.no_of_service').css('display','none');
		}
	});
});
</script>	
<script>
	$(document).ready(function(){
		
		
		$("#no_service").change(function(){
			
			 start_date=$("#start_date").val();
			 end_date=$("#end_date").val();
			 warr=$("#amc_warranty").val();
			 no_service=$("#no_service").val();
			
			
			if($("#start_date").val() == ""){
			  alert("Please Select Starting Date!");
		 }else if($("#start_date").val() == ""){
			  alert("Please Select End Date!");
		 }else{
			 
			
			 
			 
				jQuery.ajax({
                       type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Ajax","action" => "addservicelist"]);?>',
                     data : {
						 get_start_date:start_date,
						 get_end_date:end_date,
						
						 get_no_service:no_service
						 },
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
	$('#amctypesave').click(function(){
			var amc_type = $('#txtamctype').val();
			
			if(amc_type == ""){
				alert('Please Enter AMC Type');
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
		
		jQuery('table#tab_product_detail tr#row_id_'+row_id).addClass('displaynone');	
		return false;
	});
	


	function deleteParentElement(n){
   		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
   	}
	
   

 


});
        
           
 



</script>		