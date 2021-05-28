<?php 

use Cake\Routing\Router;
$action = $this->request->params['action'];

?>
<div class="row panel-body">			
				<ul role="tablist" class="nav nav-tabs panel_tabs">
                    
                       <li class="">
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Service List'),
array('controller'=>'Service','action' => 'viewservice'),array('escape' => false));
						?>						  
					  </li>
                    
					  <li class="<?php echo $action=='addservice'?'active':''?>">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Service'),array('controller'=>'Service','action' => 'addservice'),array('escape' => false));
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
						<?php echo $this->Form->label(__('Service Code'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'service_code','value'=>$service_idf,'class'=>'form-control validate[required]','readonly'));?>
						</div>

						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Assigned To'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
                            
							<select name="assign_to" class="form-control" required="required">
								<option value=""><?php echo __('-- Select Name--'); ?></option>
								<?php 
                                    
                               
                            
                                
                                if($employee_info){ foreach($employee_info as $employee_name){ ?>
								<option value="<?php echo $employee_name['user_id']; ?>"><?php echo $employee_name['first_name'].' '.$employee_name['last_name']; ?></option>
								<?php } } ?>
							</select>
						</div>
						
				</div>


				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Service Date'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
								<?php //echo $this->Form->input('',array('name'=>'date','value'=>'','id'=>'date','class'=>'form-control','placeholder'=>__('Date'),'required'=>'required'));?>
								<input type="date" name="date" class="form-control" placeholder="Date" value="<?php echo date("Y-m-d"); ?>" required="required" id="">
							</div>
							
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Status:'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
							<select name="status" class="form-control">
								<option value="1"><?php echo __('Open');?></option>
								<option value="2"><?php echo __('In-Progress'); ?></option>
								<option value="0"><?php echo __('Close');?></option>
								
							</select>
							</div>
							
				</div>

				<script type="text/javascript">
				/*
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

												beforeSend:function`(){
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
				*/
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
                    
                    <div class="col-sm-2 label_right">Service Charge (<?php echo $this->AMC->getCurrencyCode(); ?>)</div>
                    
							<div class="col-sm-2" >
                                <select class="form-control" name="charge" id="service_charge">
                                    <option value="nocharge">No Charge</option>
                                    <option value="charge">Charge</option>
                                </select>
							</div>
                    
                    <div class="col-sm-2">
                               <input type="text" placeholder="charge" class="form-control" name="charge_amount" id="charge_box" style="display:none">
							</div>
                    
                    
							
                    
                    
				</div>

<script>
$(document).ready(function(){
    
      $("select[name=charge]").change(function(){
        get_charge_val=$(this).val();   
        if(get_charge_val == 'charge'){
            $("#charge_box").show(200);
        }else{
             $("#charge_box").css("display","none");
            
        }
   
      });

}); 
</script>				
			


<div class="form-group">
    <div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Service Details'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->textarea('',array('name'=>'service_details','value'=>'','class'=>'form-control validate[required]','required'=>'required'));?>
						</div>
    
    <div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Remark:'));?></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->textarea('',array('name'=>'remark','value'=>'','class'=>'form-control validate[required]'));?>
							</div>
    
    
						
						
						
						
									
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