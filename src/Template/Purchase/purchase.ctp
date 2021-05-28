
<?php

use Cake\Routing\Router;
$action = $this->request->params['action'];
$supplider_no=isset($supplier_update)?$supplier_update['supplier_code']:$supplier_idf;
$product_code=(isset($get_row_update))?$get_row_update['product_code']:$productidf; 
$item_name=(isset($get_row_update))?$get_row_update['item_name']:'';
$brand=(isset($get_row_update))?$get_row_update['brand_id']:'';
$model_no=(isset($get_row_update))?$get_row_update['model_no']:'';
$category=(isset($get_row_update))?$get_row_update['category_id']:'';
$short_name=(isset($get_row_update))?$get_row_update['short_name']:'';
$price=(isset($get_row_update))?$get_row_update['price']:'';
$unit=(isset($get_row_update))?$get_row_update['unit_id']:'';
$image=(isset($get_row_update))?$get_row_update['image']:'';
$open_stock=(isset($get_row_update))?$get_row_update['open_stock']:'';
$min_stock=(isset($get_row_update))?$get_row_update['min_stock']:'';
$max_stock=(isset($get_row_update))?$get_row_update['max_stock']:'';
$specification=(isset($get_row_update))?$get_row_update['specification']:''; 
$warehouse=(isset($get_row_update))?$get_row_update['warehouse_id']:''; 
$product_qty=(isset($get_row_update))?$get_row_update['product_qty']:'';
$btn_name=(isset($get_row_update))?__('Update Product'):__('Add Product');
$user_role=$this->request->session()->read('user_role');
?>
<div class="row panel-body">
				<ul role="tablist" class="nav nav-tabs panel_tabs">

                       <li class="">

<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Purchase'),
array('controller'=>'Purchase','action' => 'viewpurchase'),array('escape' => false));
						?>
					  </li>

					  <li class="<?php echo $action=='purchase'?'active':''?>">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Purchase'),array('controller'=>'Purchase','action' => 'purchase'),array('escape' => false));
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
    
    
<script>
$(document).ready(function(){
	$('#statussave').click(function(){
	
		var status_type = $('#statustype').val();
		
				if(status_type == ""){
					alert('Please Fill Status type !');
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


<style>
#supplierbutton .modal-content
{
	float:left!important;
}
</style>

<!-- End status -->
<!--status Information Model-->
<div class="modal fade " id="supplierbutton" role="dialog">
    <div class="modal-dialog modal-md"  >

      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div id="result1"></div>
        <h4 align="center"><b><u><?php echo __('Supplier Data');?></u></b></h4>

        </div>
        <div class="modal-body" >

 <form method="post" accept-charset="utf-8" id="client_form" class="form_horizontal formsize client_form" enctype="multipart/form-data" action="<?php echo Router::url(["controller" => "Ajax","action" => "addsupplier"]);?>">


				<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Supplier No'));?> <span class="require-field">*</span>
						</div>

						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'supplier_no','value'=>$supplider_no,'class'=>'form-control','readonly','required'=>"required"));?>
						</div>


						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('First Name'));?> <span class="require-field">*</span>
						</div>
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'first_name','id'=>'','class'=>'form-control','placeholder'=>__('First Name'),'required'=>'required'));?>
						   </div>
				</div>


				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Last Name'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'last_name','id'=>'','class'=>'form-control','placeholder'=>__('Last Name'),'required'=>'required'));?>
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Email'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
							<?php echo $this->Form->email('',array('name'=>'email','value'=>'','id'=>'','class'=>'form-control','placeholder'=>__('Email'),'required'=>'required'));?>
							</div>
							

				</div>


				


				<div class="form-group">
							
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Address line 1:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'address_line','class'=>'form-control','placeholder'=>__('Address line 1:'),'required'=>'required'));?>
							</div>
							<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Mobile Number'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'mobile_no','value'=>'','class'=>'form-control validate[required]','placeholder'=>__('Mobile Number'),'required'=>'required'));?>
						</div>

				</div>
<div class="form-group">
							

               
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Company Name:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'supplier_company','class'=>'form-control','placeholder'=>__('Company Name'),'required'=>'required'));?>
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('City:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'city','class'=>'form-control','placeholder'=>__('City Name'),'required'=>'required'));?>
							</div>

				</div>
				<div class="form-group">
							

               
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('State:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'state','class'=>'form-control','placeholder'=>__('State'),'required'=>'required'));?>
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Country:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'country','class'=>'form-control','placeholder'=>__('Country'),'required'=>'required'));?>
							</div>

				</div>
				<div class="form-group">
							

               
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Zip Code:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'zip_code','class'=>'form-control','placeholder'=>__('Zip Code'),'required'=>'required'));?>
							</div>
							

				</div>



			
						
						
						
						
						
						<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
							<?php echo $this->Form->input(__('Save'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
							</div>
			</div>

			</form>


        </div>
          

        </div>
      </div>

    </div>

<script>

$(document).ready(function(){
	
	$(".client_form").on('submit',(function(event) {
	
		event.preventDefault();
		
		//alert($(this).attr('action'));
					$('.modal').modal('hide');
//var id = $('.waves-button-input').attr('id_da');

					$.ajax({
								type: 'POST',
								url: $(this).attr('action'),
								data: new FormData(this),
								processData: false, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
								contentType: false,       // The content type used when sending data to the server.
								cache: false,             // To unable request pages to be cached
								success: function (response)
									{	
										console.log(response);
										var returnedData = JSON.parse(response);
										$('#supplier_id').append('<option value='+returnedData.id+'>'+returnedData.first_name+' '+returnedData.last_name+'-'+returnedData.supplier_code+'</option>');
										
									},

								error: function(e) {
								alert("An error occurred: " + e.responseText);
								console.log(e);
									},
							});
	
		
	}));
});
</script>


<!-- End status -->
    
    <!--Add product Information Model-->
<div class="modal fade " id="addproduct" role="dialog">
    <div class="modal-dialog modal-md"  >

      <div class="modal-content add_product_model_content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div id="result1"></div>
        <h4 align="center"><b><u><?php echo __('Add Product');?></u></b></h4>

        </div>
        <div class="modal-body" >

<form method="post" accept-charset="utf-8" id="client_form" class="form_horizontal formsize product_add_form" enctype="multipart/form-data" action="<?php echo $this->Url->build(array('controller'=>'Ajax','action'=>'addproduct'))?>">
				         
				<div class="form-group">
                    
                    <div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Item Code'));?><span class="require-field">*</span></div>
							<div class="col-sm-4">
								
                                <?php echo $this->Form->input('',array('name'=>'product_code','id'=>'product_code','type'=>'text','class'=>'form-control validate[required]','value'=>$productidf,'PlaceHolder'=>'Enter Item Code ','required'=>'required','title'=>'Enter ItemCode','readonly'=>'readonly'));?>
							</div>
                    
                     
                    
							<div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Item Name'));?><span class="require-field">*</span></div>
							<div class="col-sm-4">
								
                                <?php echo $this->Form->input('',array('name'=>'item_name','id'=>'item_name','type'=>'text','class'=>'form-control validate[required]','value'=>$item_name,'PlaceHolder'=>'Enter Item Name ','required'=>'required','title'=>'Enter ItemName'));?>
							</div>
                    
                  
							
				</div>
				
				<div class="form-group">
                        <div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Model Number '));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
                       <?php echo $this->Form->input('',array('name'=>'model_no','id'=>'model_no','type'=>'text','class'=>'form-control validate[required]','value'=>$model_no,'PlaceHolder'=>'Enter Model Number','required'=>'required'));?>
							</div>
                    
                      <div class="col-sm-2 label_float"><?php echo $this->Form->label(__(' Brand '));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
							
							<select class="form-control validate[required]" data-live-search="true" id="brand_id" name="brand_id" required="required">
                                
                                <option value=""><?php echo __('--Brand--'); ?></option>   
                            <?php
							
                                if(isset($brandlist)){
								
                                foreach($brandlist as $brand_info){
								
                                ?>
                                <option value="<?php echo $brand_info['cat_id']; ?>" <?php 
                                            if(isset($get_row_update)){
                                                if($brand == $brand_info['cat_id']){
                                                    echo 'selected="selected"';
                                                }else{
                                                    echo '';
                                                }
                                            }
                                        
                                        ?> ><?php echo $brand_info['title'];  ?></option>  
                                <?php
                                        }
                                    }
                                ?>
							</select>
						 </div>
                    
                    
                    
                    
                   
         
				</div>
				<div class="form-group">
                    
                    <div class="col-sm-2 label_float"><?php echo $this->Form->label(__(' Product Category '));?><span class="require-field">*</span>
                    </div>

							<div class="col-sm-4">
							<select class="form-control validate[required]" id="category_id" name="category_id" required="required">
							<option value=""><?php echo __('--Category--'); ?></option>
                                <?php
                                    if($categorylist){
                                        foreach($categorylist as $category_info){
                                    
                                ?>
                                <option value="<?php echo $category_info['cat_id']; ?>" <?php 
                                            if(isset($get_row_update)){
                                                if($category == $category_info['cat_id']){
                                                    echo 'selected="selected"';
                                                }else{
                                                    echo '';
                                                }
                                            }
                                        
                                        ?> ><?php echo $category_info['title']; ?></option>
                                <?php
                                    }
                                }
                                ?>
							</select>
				        </div>
                    
                    
                  
                    <!--
							<div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Short Name '));?></div>
							<div class="col-sm-4">
                                <?php echo $this->Form->input('',array('name'=>'short_name','id'=>'short_name','type'=>'text','class'=>'form-control','value'=>$short_name,'PlaceHolder'=>'Enter Short Name '));?>

							</div>-->
                      <div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Price '));?><span class="require-field">*</span></div>
                    <div class="col-sm-4">
                                <?php echo $this->Form->input('',array('name'=>'price','id'=>'price','type'=>'text','class'=>'form-control validate[required]','value'=>$price,'PlaceHolder'=>'Enter Price ','required'=>'required'));?>
							</div>
                    
                    		
				</div>
				 <div class="form-group">
                
              
							
                
							<div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Unit '));?><span class="require-field">*</span></div>
							<div class="col-sm-4">
                               <select class="form-control validate[required]" id="unit_id" name="unit_id" required="required">
							<option value=""><?php echo __('--Unit--'); ?></option>
                                <?php
                                    if(isset($unitlist)){
                                        foreach($unitlist as $unit_info){
                                        ?>
                                   <option value="<?php echo $unit_info['cat_id'];?>" <?php 
                                            if(isset($get_row_update)){
                                                if($unit == $unit_info['cat_id']){
                                                    echo 'selected="selected"';
                                                }else{
                                                    echo '';
                                                }
                                            }
                                        
                                        ?> ><?php echo $unit_info['title'];?></option>
                                            <?php             
                                        }
                                    }
                                   ?>
							</select>
							</div>
                </div>
				<div class="form-group">
				
				 <div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Product Image '));?></div>
							<div class="col-sm-4">
                                
                                 <?php
                if(isset($get_row_update)){

           
                     
                       if (isset($get_row_update)) {
echo $this->Html->image('product/'.$get_row_update['image'],array('height'=>'100px','width'=>'100px','class'=>'img-thumbnail'));
									} 
echo '<br>';
echo '<br>';               
echo $this->Form->input('',array('type'=>'hidden','value'=>$image,'name'=>'image2'));
    
                }
            ?>
                                
                                
                                	<?php echo $this->Form->input('',array('class'=>'file','id'=>'file-0a','type'=>'file','name'=>'image'));?>

							</div>
							</div>
							 <div class="form-group">
							 <div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Product Specification'));?></div>
							<div class="col-sm-10">
                                <?php echo $this->Form->textarea('',array('name'=>'specification','id'=>'specification','type'=>'textarea','class'=>'form-control validate[required]','value'=>$specification,'PlaceHolder'=>''));?>

							</div>
							<div class="col-sm-2"></div>
				</div>
				<div class="form-group" style="margin-top:-20px">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
<?php echo $this->Form->input($btn_name,array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
							</div>
				</div>
				</form>
            
        </div>
           

        </div>
      </div>

    </div>




<!-- End Add Product  -->


<!-- Start AMC Supplier -->
 <script>
 $('.product_add_form').on('submit',function(event){
	  event.preventDefault();
	  
	  $.ajax({
								type: 'POST',
								url: $(this).attr('action'),
								data: new FormData(this),
								processData: false, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
								contentType: false,       // The content type used when sending data to the server.
								cache: false,             // To unable request pages to be cached
								success: function (response)
									{	
										$('.close').trigger('click');
										alert(response);
										
									},

								error: function(e) {
								alert("An error occurred: " + e.responseText);
								console.log(e);
									},
							});
	
 });
 </script>
     
<script>
$(document).ready(function(){
	$('#suppliersave').click(function(){
		var supplier_type = $('#suppliertype').val();
		
				if(supplier_type == ""){
					alert('Please Fill Supplier Type !');
				}else{
					
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
					
				}
        
           

       
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
    
    
    
    
    
    
    
    


          <form action="" id="client_form" class="form_horizontal formsize" method="post" enctype="multipart/form-data"> 
				<div class="form-group">
						<div class="col-sm-2 label_right">
						<label>Purchase No</label><span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<input type="text" name="purchase_no" value="<?php echo $purchase_idf; ?>" class="form-control" readonly required>
						</div>

						<div class="col-sm-2 label_right">
						<label>Status</label><span class="require-field">*</span>
						</div>
							<div class="col-sm-2">
						
							<select class="form-control validate[required]" data-live-search="true" id="status_id" name="status" required="required">
                                
                                <option value="">--Status--</option>   

 								<?php  
          						  if(isset($purchase_status)){
										 foreach($purchase_status as $purchase_val){      
            					?>
                               <option value="<?php echo $purchase_val['cat_id'];?>"><?php echo $purchase_val['title']; ?></option>   
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
								<input type="date" name="purchase_date" class="form-control" value="<?php echo date('Y-m-d'); ?>" placeholder="Date">
							</div>

							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Contact Person:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'contact_person','value'=>'','class'=>'form-control validate[required]','placeholder'=>__('Enter Name'),'required'=>'required'));?>
							</div>

				</div>

				



				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Supplier Name'));?><span class="require-field">*</span></div>

							<div class="col-sm-2">
                                
							<select class="form-control validate[required]" data-live-search="true" id="supplier_id" name="supplier_id" required="required">
                               <option value="">--Supplier--</option>
                                <?php 
                                    if(isset($supplier_name)){
                                        foreach($supplier_name as $supplier_val){
                                            ?>
                                
                                <option value="<?php echo $supplier_val['id'];?>"><?php echo $supplier_val['first_name'].' '.$supplier_val['last_name'].'-'.$supplier_val['supplier_code'];?></option>
                                <?php
                                      }
                                }
                                ?>
							</select>
                                
						 </div>
                    <div class="col-sm-2">
						 		<button type="button" id="period_add" name="" data-toggle="modal" data-target="#supplierbutton" class="btn"><?php echo __('Add Or Remove'); ?></button>
						 </div>
                     
                    
                    



                    
							
				</div>

				<div class="form-group">
							

							<div class="col-sm-2 label_right">
							<label>Email</label>
						</div>
						<div class="col-sm-4">
						<input type="email" name="email" id="email" class="form-control validate[required]" placeholder="Enter Email" value="" readonly>
							</div>
							<div class="col-sm-2 label_right">
						<label>Billing Address</label>
						</div>
						<div class="col-sm-4">
						<textarea name="billing_address" id="address" class="form-control validate[required]"  rows="5" readonly></textarea>
							</div>
						
				</div>


				 <div class="header">
          		<h3>Purchase Details</h3>
          </div>

		  <button type="button" id="add_newrow" class="btn btn-default" style="margin:5px 0px;">Add New </button>
				 <table class="table table-bordered" id="tab_product_detail" align="center">
					<thead>
					<tr>
						<th>Product</th>
						<th>Quantity</th>
						<th>Price (<?php echo $this->AMC->getCurrencyCode(); ?>)</th>
						<th>Amount (<?php echo $this->AMC->getCurrencyCode(); ?>)</th>
						<th>Action </th>

					</tr>
				</thead>
				<tbody>
				<?php $row_id = 0;?>
						<tr id="row_id_<?php echo $row_id;?>">
							<td>
								<select name="product[product_id][]" class="form-control select_product" id="product_id_<?php echo $row_id;?>" required="required" data-id="<?php echo $row_id;?>">
									<option value="">--Select Product--</option>
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
				</tbody>
			</table>






			<div class="form-group">
							
							<div class="">
							<input type="submit" name="add" class="btn btn-success" id="save" value="Save">
							</div>
				</div>
			</form>

</div>


<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#supplier_id').change(function(){
		

							var supplier_id=$('#supplier_id').val();

							jQuery.ajax({
                       				type: 'POST',
                      					url: '<?php echo Router::url(["controller" => "Ajax","action" => "getsupplierdata"]);?>',
                     					data : {supplier_id:supplier_id},
                     						success: function (response)
                        						{	
													
													
                           							var res_sullier=$.parseJSON(response);
													jQuery('#address').text(res_sullier.address);
                           							jQuery('#email').attr('value',res_sullier.email);
												},

												beforeSend:function(){
													
                           							jQuery('#address').text('Loading...');
                           							jQuery('#email').attr('value','Loading...');
												},

                    
						});


						});

	


				
				
				
				
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


