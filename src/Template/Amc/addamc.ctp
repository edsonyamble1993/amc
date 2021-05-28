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
                    
					  <li class="<?php echo $action=='addamc'?'active':''?>">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Amc'),array('controller'=>'Amc','action' => 'addamc'),array('escape' => false));
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
								<?php //echo $this->Form->input('',array('name'=>'date','value'=>'','id'=>'date','class'=>'form-control','placeholder'=>__('Date'),'required'=>'required'));?>
								<input type="date" name="date" class="form-control" placeholder="Date" id="">
							</div>
						
				</div>
				<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Contact Person'));?> 
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'contact_person','class'=>'form-control validate[required]','placeholder'=>__('Add Contact Person')));?>
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
		<option value="<?php echo $client_row['user_id'];?>" ><?php echo $client_row['first_name'].' '.$client_row['last_name']; ?></option>
										<?php
										}
									}
								?>
							</select>
							
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Mobile No:'));?></div>
                    
							<div class="col-sm-4">
							<input type="text" name="mobile" id="mobile" class="form-control validate[required]" placeholder="Enter Mobile Number"  readonly>
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
		<option value="<?php echo $employee_infos['user_id'];?>" ><?php echo $employee_infos['first_name'].' '.$employee_infos['last_name']; ?></option>
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
						<input type="text" name="email" id="email" class="form-control" placeholder="Enter Email" required="required" value="<?php isset($set_quotation)?$set_quotation['email']:'' ?>" readonly>
							</div>
				</div>

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
   

				
			
<div class="form-group">
			

			
			<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Status:'));?>
						</div>
						<div class="col-sm-4">
						<select class="form-control" name="status" <?php 
							if($this->request->session()->read('user_role') == 'client'){echo 'disabled="disabled"';}
						?>>
						<option value="1">Open</option>
						<option value="2">Progress</option>
						<option value="0">Closed</option>
						</select>
						</div>
							<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Billing Address'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
						<textarea name="address" id="address" class="form-control validate[required]" rows="5" readonly></textarea>
							</div>


</div>

<div class="form-group">
			<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Add Amc detail'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
						<textarea name="subject" id="address" class="form-control validate[required]" rows="5"></textarea>
							</div>
							<div class="col-sm-2 label_right">
				<?php echo $this->Form->label(__('Attachment'));?> 
			</div>
			<div class="col-sm-4">
		<?php echo $this->Form->input('',array('name'=>'attachment','type'=>'file','value'=>'','id'=>'','class'=>'form-control file','placeholder'=>__('')));?>
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
									<select name="no_of_services" id="no_of_service" class="form-control no_of_service" url="{!! url('sales/add/getservices')!!}"> 
										<option value="0">No of service </option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
										<option value="6">6</option>
										<option value="7">7</option>
										<option value="8">8</option>
										<option value="9">9</option>
										<option value="10">10</option>
										<option value="11">11</option>
										<option value="12">12</option>
									</select>
								</div>
								
							</div>
							</div>
			

	<div id="load_service_data">




</div>	



				 <div class="header">
          		<h3><?php echo __('Amc Details'); ?></h3>
          </div>
		  
		  <button type="button" id="add_newrow" class="btn btn-default" style="margin:5px 0px;">Add New </button>
		  
				 <table class="table table-bordered" id="tab_product_detail" align="center">
					<thead>
					<tr>
						<th><?php echo __('Product');?></th>
						<!--<th><?php echo __('Warranty');?></th>-->
						<th><?php echo __('Note');?></th>
						
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
								<input type="text" name="product[note][]" class="form-control" data-id ="<?php echo $row_id;?>" value="" id="note_<?php echo $row_id;?>">
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