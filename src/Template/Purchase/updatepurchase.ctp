<?php

$purchase_idf=(isset($update_row))?$update_row['purchase_no']:'';
$date=(isset($update_row))?date($this->Amc->getDateFormat(),strtotime($update_row['purchase_date'])):'';
$contact_person=(isset($update_row))?$update_row['contact_person']:'';
//$supplier_name=(isset($update_row))?$update_row['supplier_name']:'';
$mobile=(isset($update_row))?$update_row['mobile']:'';
$email=(isset($update_row))?$update_row['email']:'';
$address=(isset($update_row))?$update_row['billing_address']:'';

?>


<?php 

use Cake\Routing\Router;
$action = $this->request->params['action'];

?>
<div class="row panel-body">			
				<ul role="tablist" class="nav nav-tabs panel_tabs">
                    
                       <li class="">
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Purchase'),
array('controller'=>'Purchase','action' => 'viewpurchase'),array('escape' => false));
						?>						  
					  </li>
                    
					  <li class="<?php echo $action=='updatepurchase'?'active':''?>">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Edit Purchase'),array(),array('escape' => false));
						?>
  
					  </li>
				</ul>

<script>
$(function(){

	
});
</script>


<script>
$(document).ready(function(){
	$('#statussave').click(function(){
	
		var status_type = $('#statustype').val();
	
            if(status_type == ""){
              alert('Please Enter Status');  
            }else{
                
                
                   $.ajax({
                       type: 'POST',
                      url: '<?php echo $this->Url->build(["controller" => "ajax","action" => "addpurchasestatus"]);?>',
                     data : {status_name:status_type},
                     success: function (data)
                        {	
							
							
                            if(data > 0){
							$('#statustype').val('');
                            $('#tab_status').append('<tr class="del-'+data+'"><td class="text-center">'+status_type+'</td><td class="text-center"><a href="#" class="del" id="'+data+'" class="btn btn-success"><button class="btn btn-danger btn-xs">X</button></a></td><tr>');
                           $('#status_id').append('<option value='+data+'>'+status_type+'</option>');
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


	/* Delete Brand*/
$("body").on('click','.del',function(){


   var id=$(this).attr('id');
    r=confirm('Are you sure you wish to Delete this Record?');
		if(r == true){
   $.ajax({
   type:'POST',
   url:'<?php echo $this->Url->build(['controller'=>'ajax','action'=>'deletepurchasestatus']);?>',
   data:{status_id:id},
   success:function(data){
        $('body .del-'+id).fadeOut(300);
        $("#status_id option[value="+id+"]").remove();
       
        $("#supplier_id option[value="+id+"]").remove();
       
   }

   }) ;
   }
    
});



	
}); 
</script>

					 
<!--status Information Model-->
<div class="modal fade " id="brand" role="dialog">
    <div class="modal-dialog modal-md"  >

      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div id="result1"></div>
        <h4 align="center"><b><u><?php echo __('status');?></u></b></h4>

        </div>
        <div class="modal-body" >


<table class="table" id="tab_status" align="center" style="width:40em">
		<tr>
            <th class="text-center"><b><?php echo __('Status');?></b></th>
            <th class="text-center"><b><?php echo __('Action'); ?></b></th>
        </tr>

		 <?php  
            if(isset($purchase_status)){
			 foreach($purchase_status as $purchase_val){   
                
                 
            ?>
            <tr class="del-<?php echo $purchase_val['cat_id'];?>">
                		<td class="text-center"><?php echo $purchase_val['title']; ?></td>
                		<td class="text-center">
                        <a href="#" class="del" id="<?php echo $purchase_val['cat_id']; ?>" class="btn btn-success">
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
               		 <?php echo __('Status:');?><span class="require-field">*</span></label>
             </div>
            <div class="col-sm-3">
			<?php echo $this->Form->input('',array('class'=>'form-control validate[required]','id'=>'statustype'));?>
            </div>

            <div class="col-sm-4">
                <a href="#" id="statussave" class="btn btn-success"><?php echo __('Add Status');?> </a>
            </div>
            </div>
	</center>
		
	  </div>

        </div>
      </div>

    </div>




<!-- End status -->
    
    
<!-- Start AMC Supplier -->
    
     
<script>
$(document).ready(function(){
	$('#suppliersave').click(function(){
		var supplier_type = $('#suppliertype').val();
        
                   $.ajax({
                       type: 'POST',
                      url: '<?php echo $this->Url->build(["controller" => "ajax","action" => "addsuppliername"]);?>',
                     data : {supplier_name:supplier_type},
                     success: function (data)
                        {	
						
                            if(data > 0){

                            $('#tab_supplier').append('<tr class="del-'+data+'"><td class="text-center">'+supplier_type+'</td><td class="text-center"><a href="#" class="del" id="'+data+'" class="btn btn-success"><button class="btn btn-danger btn-xs">X</button></a></td><tr>');
                          
                          $('#supplier_id').append('<option value='+data+'>'+supplier_type+'</option>');
                          
                            }else{
                                alert('This Record is Duplicate');
                            }
                            
						},
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
       });

       
	});


	/* Delete Supplier*/
    /*
$("body").on('click','.del',function(){


   var id=$(this).attr('id');
    r=confirm('Are you sure you wish to Delete this Record?');
		if(r == true){
   $.ajax({
   type:'POST',
   url:'<?php echo $this->Url->build(['controller'=>'ajax','action'=>'deletepurchasestatus']);?>',
   data:{status_id:id},
   success:function(data){
        $('body .del-'+id).fadeOut(300);
        $("#status_id option[value="+id+"]").remove();
       
   }

   }) ;
   }
    
});
*/


	
}); 
</script>
    
    
    <div class="modal fade " id="supplier" role="dialog">
    <div class="modal-dialog modal-md"  >

      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div id="result1"></div>
        <h4 align="center"><b><u><?php echo __('Supplier Name');?></u></b></h4>

        </div>
        <div class="modal-body" >


<table class="table" id="tab_supplier" align="center" style="width:40em">
		<tr>
            <th class="text-center"><b><?php echo __('Supplier');?></b></th>
            <th class="text-center"><b><?php echo __('Action'); ?></b></th>
        </tr>

		
            <?php  
   
            if(isset($supplier_name)){
			 foreach($supplier_name as $supplier_val){      
            ?>
            <tr class="del-<?php echo $supplier_val['cat_id'];?>">
                		<td class="text-center"><?php echo $supplier_val['title']; ?></td>
                		<td class="text-center">
                        <a href="#" class="del" id="<?php echo $supplier_val['cat_id']; ?>" class="btn btn-success">
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
               		 <?php echo __('Supplier Name:');?><span class="require-field">*</span></label>
             </div>
            <div class="col-sm-3">
			<?php echo $this->Form->input('',array('class'=>'form-control validate[required]','id'=>'suppliertype'));?>
            </div>

            <div class="col-sm-4">
                <a href="#" id="suppliersave" class="btn btn-success"><?php echo __('Add Supplier');?> </a>
            </div>
            </div>
	</center>
		
	  </div>

        </div>
      </div>

    </div>

<!-- End AMC Supplier-->


			
          <?php echo $this->Form->Create('form1',['id'=>'client_form','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'']]);?>

         
		
		 
			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Purchase No'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'purchase_no','value'=>$purchase_idf,'class'=>'form-control validate[required]','readonly','required'=>"required"));?>
						</div>

						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Status'));?> <span class="require-field">*</span>
						</div>

						<div class="col-sm-2">
						
							<select class="form-control validate[required]" data-live-search="true" id="status_id" name="status" required="required">
                                
                                <option value=""><?php echo __('--Status--'); ?></option>   

 								<?php  
          						  if(isset($purchase_status)){
										 foreach($purchase_status as $purchase_val){      
            					?>
                               <option value="<?php echo $purchase_val['cat_id'];?>" <?php 
                                if($purchase_val['cat_id'] == $update_row['status']){
                                  echo 'selected="selected"';
                                }

                               ?>><?php echo $purchase_val['title']; ?></option>   
                               <?php
                }
            }
            ?>

                          
							</select>
							
						 </div>


	
                    
                    <div class="col-sm-2">
						 		<button type="button" id="period_add" name="" data-toggle="modal" data-target="#brand" class="btn"><?php echo __('Add Or Remove'); ?></button>
						 </div>


				</div>


				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Purchase Date'));?></div>

							<div class="col-sm-4">
								<?php //echo $this->Form->input('',array('type' => 'date','name'=>'purchase_date','value'=>$date,'id'=>'','class'=>'form-control','placeholder'=>__('Date')));?>
								<input type="date" name="purchase_date" class="form-control" value="<?php echo date("Y-m-d",strtotime($date)); ?>" placeholder="Date">
							</div>

							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Contact Person:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'contact_person','value'=>$contact_person,'class'=>'form-control validate[required]','required'=>'required','placeholder'=>__('Enter Name')));?>
							</div>

				</div>


			

			<div class="form-group">
							
							

							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Supplier Name'));?><span class="require-field">*</span></div>

								<div class="col-sm-4">
                                
							<select class="form-control validate[required]" data-live-search="true" id="supplier_id" name="supplier_id" required>
                               <option value="">--Supplier--</option>
                                <?php 
                                    if(isset($supplier_name)){
                                        foreach($supplier_name as $supplier_val){
                                            ?>
                                
                                <option value="<?php echo $supplier_val['id'];?>" <?php 
                                  if($supplier_val['id'] == $update_row['supplier_id']){
                                    echo 'selected="selected"';
                                  }


                                ?>><?php echo $supplier_val['first_name'].' '.$supplier_val['last_name'].'-'.$supplier_val['supplier_code'];?></option>
                                <?php
                                      }
                                }
                                ?>
							</select>
                                
						 </div>
                    
                    
						 
							
				</div>

					<div class="form-group">
							
							<div class="col-sm-2 label_right">
							<label>Email</label>
						</div>
						<div class="col-sm-4">
						<input type="email" name="email" id="email" class="form-control validate[required]" placeholder="Enter Email" value="<?php echo $email; ?>" readonly>
							</div>
							<div class="col-sm-2 label_right">
						<label>Billing Address</label>
						</div>
						<div class="col-sm-4">
						<textarea name="billing_address" id="address" class="form-control validate[required]"  rows="5" readonly><?php echo $address; ?></textarea>
							</div>
			
</div>


				 <div class="header">
          		<h3><?php echo __('Purchase Details'); ?></h3>
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
                <?php 
                    if(isset($ph_histroy)){
                        foreach($ph_histroy as $ph_row){

                
                ?>
						<tr id="row_id_<?php echo $row_id;?>">
							<td>
     <input type="hidden" name="product[ph_id][]" value="<?php echo $ph_row['purchase_h_id'];?>" class="" form-control" data-id ="<?php echo $row_id;?>"  id="<?php echo $row_id;?>">                           
                                
								<select name="product[product_id][]" class="form-control select_product" id="product_id_<?php echo $row_id;?>" data-id="<?php echo $row_id;?>" required>
									<option value=""><?php echo __('--Select Product--');?></option>
									<?php  
											if($product_row){
									foreach($product_row as $product_info){
										?>

			<option value="<?php echo $product_info['product_id']?>" <?php
                                if($product_info['product_id'] == $ph_row['item_name']){
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
								<input type="text" name="product[quantity][]" class="quantity form-control" data-id ="<?php echo $row_id;?>" value="<?php echo $ph_row['qty']; ?>" id="quantity_<?php echo $row_id;?>" required>
							</td>
							<td>
								<input type="text" name="product[price][]" class="product form-control" data-id ="<?php echo $row_id;?>" value="<?php echo $ph_row['price'];?>" id="price_<?php echo $row_id;?>" readonly='true'>
							</td>
							<td>
								<input type="text" name="product[amount][]" class="product form-control" data-id ="<?php echo $row_id;?>" value="<?php echo $ph_row['net_amount'];?>" id="amount_<?php echo $row_id;?>" readonly='true'>
							</td>
	
							<td>
								<span class="trash delete_product" product-id="<?php echo $ph_row['purchase_h_id']; ?>" data-id="<?php echo $row_id;?>"><i class="fa fa-trash"></i> Delete</span>
								
							</td>
						</tr>
                        <?php 
                            $row_id++;
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


<script type="text/javascript">
$(document).ready(function() {
var loading = $.loading({
    imgPath    : '<?php echo $this->request->webroot; ?>webroot/js/img/ajax-loading.gif',
     tip        : 'Loading...',
});
       

	$('#pdate').datepicker({
		 changeMonth: true,
      changeYear: true,
	  dateFormat: "yy-mm-dd"
	});
$('#supplier_id').change(function(){
		

							var supplier_id=$('#supplier_id').val();

							$.ajax({
                       				type: 'POST',
                      					url: '<?php echo Router::url(["controller" => "Ajax","action" => "getsupplierdata"]);?>',
                     					data : {supplier_id:supplier_id},
                     						success: function (response)
                        						{	
													
													
                           							var res_sullier=$.parseJSON(response);
													$('#address').text(res_sullier.address);
                           							$('#email').attr('value',res_sullier.email);
												},

												beforeSend:function(){
													
                           							$('#address').text('Loading...');
                           							$('#email').attr('value','Loading...');
												},

                    
						});


						});

	$('#inventory_form').validationEngine();

	/*----*/
	$("#add_newrow").click(function(){
		$(this).attr("disabled", "disabled");
		var row_id = $("#tab_product_detail > tbody > tr").length;
		var action = 'add_newrow';
		$.ajax({
                       type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Ajax","action" => "addnewrow"]);?>',
                     data : {row_id:row_id},
                     success: function (response)
                        {	
                            $("#tab_product_detail > tbody").append(response);
							return false;
						},
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
       });
	});
	/*---*/

    $('body').on('keyup','.quantity',function(){ 
			$("#add_newrow").attr("disabled", false);
            var qty= jQuery(this).val();
			var row_id =jQuery(this).attr('data-id');
			var product_id = $('#product_id_'+row_id).val();
			var total_price = 0;

			
			

			$.ajax({
                       type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Ajax","action" => "productdetail"]);?>',
                     data : {row_id:row_id,product_id:product_id},
                     success: function (response)
                        {	

                             var json_obj = $.parseJSON(response);					
							
							var price = json_obj['price'];
							
							total_price =  price * qty;
							$('#price_'+row_id).val(price);
						$('#amount_'+row_id).val(total_price);
						
							return false;
						},
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
       });
			
			
        });
		
		//product chage event
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
		
		//product chage event
		
		

/*-----*/

	$('body').on('click','.delete_product',function(){
		var row_id = $(this).attr('product-id');
        $.ajax({
                 type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Ajax","action" => "removehistorydata"]);?>',
                     data : {product_history_id:row_id},
                     success: function (response){
                           
                             $("tr#row_id_"+response).remove(); 
                        
						},
                    error: function(e) {
                        alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
            
            
            
        });
        
	});
	
    
    $('body').on('click','.trash',function(){
		var row_id_row = jQuery(this).attr('data-id');
		
		$('table#tab_product_detail tr#row_id_'+row_id_row).remove();	
		
	});


	function deleteParentElement(n){
   		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
   	}
	
   
 CKEDITOR.replace( 'message' );
 


});
        
           
 



</script>		