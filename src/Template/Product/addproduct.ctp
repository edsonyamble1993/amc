<?php

$product_code=(isset($get_row_update))?$get_row_update['product_code']:$purchase_idf; 
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
<script>
    jQuery(document).ready(function () {
       jQuery('#sample_input').awesomeCropper(
        { width: 150, height: 150, debug: true }
        );
    });
    </script> 
<script>

$(function(){
    
 
    
    /*Add Brand*/
	$('#brandsave').click(function(){
	
		var brand_type = $('#brandtype').val();
        
        if(brand_type == ""){
            alert('Please Enter Brand Type!');
        }else{
            
               $.ajax({
                       type: 'POST',
                      url: '<?php echo $this->Url->build(["controller" => "ajax","action" => "addbrand"]);?>',
                     data : {brand_name:brand_type},
                     success: function (data)
                        {	
						 $('.lodding').css('display','none');
                            if(data > 0){
								$('#brandtype').val('');
                            $('#tab_brand').append('<tr class="del-'+data+'"><td class="text-center">'+brand_type+'</td><td class="text-center"><a href="#" class="del" id="'+data+'" class="btn btn-success"><button class="btn btn-danger btn-xs">X</button></a></td><tr>');
                           $('#brand_id').append('<option value='+data+'>'+brand_type+'</option>');
                            }else{
                                alert('This Record is Duplicate');
                            }
						},
						beforeSend: function() {
        // setting a timeout
        $('.lodding').css('display','block');
    },
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
       });
            
        }

		
                
	   
       
	});
  
/*add Category*/ 
    
$('#categorysave').click(function(){
		var category_type = $('#categorytype').val();
		if(category_type == '')
		{
			alert('Please Insert atlest one values');
			return false;s
		}
                   $.ajax({
                       type: 'POST',
                      url: '<?php echo $this->Url->build(["controller" => "ajax","action" => "addcategory"]);?>',
                     data : {category_name:category_type},
                     success: function (data)
                        {	
                            if(data > 0){
						$('#categorytype').val('');
                         $('#tab_category').append('<tr class="del-'+data+'"><td class="text-center">'+category_type+'</td><td class="text-center"><a href="#" class="del" id="'+data+'" class="btn btn-success"><button class="btn btn-danger btn-xs">X</button></a></td><tr>');
                           $('#category_id').append('<option value='+data+'>'+category_type+'</option>');
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
    
    
      
/*add Unit*/ 
    
$('#unitsave').click(function(){
		var unit_type = $('#unittype').val();
		if(unit_type == '')
		{
			alert('Please Insert atlest one values');
			return false;s
		}
                   $.ajax({
                       type: 'POST',
                      url: '<?php echo $this->Url->build(["controller" => "ajax","action" => "addunit"]);?>',
                     data : {unit_name:unit_type},
                     success: function (data)
                        {	
                            if(data > 0){
						 $('#unittype').val('');
                         $('#tab_unit').append('<tr class="del-'+data+'"><td class="text-center">'+unit_type+'</td><td class="text-center"><a href="#" class="del" id="'+data+'" class="btn btn-success"><button class="btn btn-danger btn-xs">X</button></a></td><tr>');
                           $('#unit_id').append('<option value='+data+'>'+unit_type+'</option>');
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
    
          
/*add Warehouse*/ 
    
$('#warehousesave').click(function(){
		var warehouse_type = $('#warehousetype').val();
 
                   $.ajax({
                       type: 'POST',
                      url: '<?php echo $this->Url->build(["controller" => "ajax","action" => "addwarehouse"]);?>',
                     data : {warehouse_name:warehouse_type},
                     success: function (data)
                        {	
                            if(data > 0){
                        $('#tab_warehouse').append('<tr class="del-'+data+'"><td class="text-center">'+warehouse_type+'</td><td class="text-center"><a href="#" class="del" id="'+data+'" class="btn btn-success"><button class="btn btn-danger btn-xs">X</button></a></td><tr>');
                        $('#warehouse_id').append('<option value='+data+'>'+warehouse_type+'</option>');
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
    
    
    
    
    
/* Delete Brand*/
$("body").on('click','.del',function(){


   var id=$(this).attr('id');
    r=confirm('Are you sure you wish to Delete this Record?');
		if(r == true){
   $.ajax({
   type:'POST',
   url:'<?php echo $this->Url->build(['controller'=>'ajax','action'=>'deletebrand']);?>',
   data:{brand_id:id},
   success:function(data){
        $('body .del-'+id).fadeOut(300);
		$("#brand_id option[value='"+id+"']").remove();
   }

   }) ;
   }
    
});
     
});
</script>

<?php if($user_role == 'admin'){
?>

<style>
.lodding
{
	    z-index: 99999999999999;
    width: 100%;
    float: left;
    display: block;
   
    width: 100%;
    text-align: center;
    position: fixed;
    right: 0;
   
    top: 45%;
    bottom: 0;
}
</style>
<div class="lodding" style="display:none;">
<?php echo $this->Html->image('Gear.gif', ['class' => 'img-circle avatar','id'=>'profileimg','width'=>'40','height'=>'40']); ?>
</div>
<!--brand Information Model-->
<div class="modal fade " id="brand" role="dialog">
    <div class="modal-dialog modal-md"  >

      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div id="result1"></div>
        <h4 align="center"><b><u><?php echo __('Brand');?></u></b></h4>

        </div>
        <div class="modal-body" >


<table class="table" id="tab_brand" align="center" style="width:40em">
		<tr>
            <th class="text-center"><b><?php echo __('Brand');?></b></th>
            <th class="text-center"><b><?php echo __('Action'); ?></b></th>
                </tR>
            
            <?php
			
               
            if(isset($brandlist)){
			 foreach($brandlist as $brand_info){      
            ?>
            <tr class="del-<?php echo $brand_info['cat_id'];?>">
                		<td class="text-center"><?php echo $brand_info['title']; ?></td>
                		<td class="text-center">
                        <a href="#" class="del" id="<?php echo $brand_info['cat_id']; ?>" class="btn btn-success">
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
               		 <?php echo __('Brand Name:');?><span class="require-field">*</span></label>
             </div>
            <div class="col-sm-3">
			<?php echo $this->Form->input('',array('class'=>'form-control validate[required]','id'=>'brandtype'));?>
            </div>

            <div class="col-sm-4">
                <a href="#" id="brandsave" class="btn btn-success"><?php echo __('Add Brand');?> </a>
            </div>
            </div>
	</center>
		
	  </div>

        </div>
      </div>

    </div>


<!--End Brand-->



<!--Category Information Model-->
<div class="modal fade " id="pcategory" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div id="result1"></div>
        <h4 align="center"><b><u><?php echo __('Product Category');?></u></b></h4>

        </div>
        <div class="modal-body" >


<table class="table" id="tab_category" align="center" style="width:40em">
		<tr>
            <th class="text-center"><b><?php echo __('Product Category');?></b></th>
            <th class="text-center"><b><?php echo __('Action'); ?></b></th>
                </tR>
            
           <?php if(isset($categorylist)){
                    foreach($categorylist as $category_info){
            ?>
            <tr class="del-<?php echo $category_info['cat_id'];?>">
                		<td class="text-center"><?php echo $category_info['title']; ?></td>
                		<td class="text-center">
                        <a href="#" class="del" id="<?php echo $category_info['cat_id']; ?>" class="btn btn-success">
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
                    <label class="col-sm-12 control-label" for="" id="post_name" value="catagory">
               		 <?php echo __('Category Name:');?><span class="require-field">*</span></label>
             </div>
            <div class="col-sm-3">
<?php echo $this->Form->input('',array('class'=>'form-control validate[required]','id'=>'categorytype'));?>
            </div>

            <div class="col-sm-4">
                <a href="#" id="categorysave" class="btn btn-success"><?php echo __('Add Category');?> </a>
            </div>
            </div>
	</center>
		
	  </div>

        </div>
      </div>

    </div>
<!-- End Category-->


<!--Unit Information Model-->
<div class="modal fade " id="unit" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div id="result1"></div>
        <h4 align="center"><b><u><?php echo __('Unit');?></u></b></h4>

        </div>
        <div class="modal-body" >


<table class="table" id="tab_unit" align="center" style="width:40em">
		<tr>
            <th class="text-center"><b><?php echo __('Unit');?></b></th>
            <th class="text-center"><b><?php echo __('Action'); ?></b></th>
                </tR>
            
           <?php if(isset($unitlist)){
                    foreach($unitlist as $unit_info){
            ?>
            <tr class="del-<?php echo $unit_info['cat_id'];?>">
                		<td class="text-center"><?php echo $unit_info['title']; ?></td>
                		<td class="text-center">
                        <a href="#" class="del" id="<?php echo $unit_info['cat_id']; ?>" class="btn btn-success">
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
                    <label class="col-sm-12 control-label" for="" id="post_name" value="catagory">
               		 <?php echo __('Unit:');?><span class="require-field">*</span></label>
             </div>
            <div class="col-sm-3">
<?php echo $this->Form->input('',array('class'=>'form-control validate[required]','id'=>'unittype'));?>
            </div>

            <div class="col-sm-4">
                <a href="#" id="unitsave" class="btn btn-success"><?php echo __('Add Unit');?> </a>
            </div>
            </div>
	</center>
		
	  </div>

        </div>
      </div>

    </div>


<!-- End Unit-->






<!--Warehouse Information Model-->
<div class="modal fade " id="warehouse" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div id="result1"></div>
        <h4 align="center"><b><u><?php echo __('Warehouse');?></u></b></h4>

        </div>
        <div class="modal-body" >


<table class="table" id="tab_warehouse" align="center" style="width:40em">
		<tr>
            <th class="text-center"><b><?php echo __('Warehouse');?></b></th>
            <th class="text-center"><b><?php echo __('Action'); ?></b></th>
                </tR>
            
             <?php if(isset($warehouselist)){
                    foreach($warehouselist as $warehouse_info){
            ?>
          
            <tr class="del-<?php echo $warehouse_info['cat_id']; ?>">
                		<td class="text-center"><?php echo $warehouse_info['title'];?></td>
                		<td class="text-center">
                        <a href="#" class="del" id="<?php echo $warehouse_info['cat_id']?>" class="btn btn-success">
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
                    <label class="col-sm-12 control-label" for="" id="post_name" value="catagory">
               		 <?php echo __('Warehouse Name:');?><span class="require-field">*</span></label>
             </div>
            <div class="col-sm-3">
<?php echo $this->Form->input('',array('class'=>'form-control validate[required]','id'=>'warehousetype'));?>
            </div>

            <div class="col-sm-4">
                <a href="#" id="warehousesave" class="btn btn-success"><?php echo __('Add Warehouse');?> </a>
            </div>
            </div>
	</center>
		
	  </div>

        </div>
      </div>

    </div>


<!-- End Warehouse-->



<div class="row schooltitle">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					 
                    <li class="">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) . " Product List",array('controller'=>'Product','action' => 'productlist'),array('escape' => false));
						?>

						<!--	 <i class="fa fa-align-justify"></i>Add Student</a> -->

					  </li>

					    <li class="active">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__($btn_name),array(),array('escape' => false));
						?>
  
					  </li>

						<!--	 <i class="fa fa-align-justify"></i>Add Student</a> -->

					  </li>

				</ul>
</div>



<div class="row">			
		<div class="panel-body">
			<?php echo $this->Form->Create('form1',['id'=>'formID','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'addproduct']]);?>
            
            <div class="header">
          		<h3><?php echo __('Product Information'); ?></h3>
          </div>
            
				<div class="form-group">
                    
                    <div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Item Code'));?><span class="require-field">*</span></div>
							<div class="col-sm-4">
								
                                <?php echo $this->Form->input('',array('name'=>'product_code','id'=>'product_code','type'=>'text','class'=>'form-control validate[required]','value'=>$product_code,'PlaceHolder'=>'Enter Item Code ','required'=>'required','title'=>'Enter ItemCode','readonly'=>'readonly'));?>
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

							<div class="col-sm-2">
							
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
                    
                    <div class="col-sm-2">
						 		<button type="button" id="period_add" name="" data-toggle="modal" data-target="#brand" class="btn"><?php echo __('Add Or Remove'); ?></button>
						 </div>
                    
                    
                   
         
				</div>



				<div class="form-group">
                    
                    <div class="col-sm-2 label_float"><?php echo $this->Form->label(__(' Product Category '));?><span class="require-field">*</span>
                    </div>

							<div class="col-sm-2">
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
                    
                    
                  <div class="col-sm-2">
						 		<button type="button" id="period_add" name="" data-toggle="modal" data-target="#pcategory" class="btn"><?php echo __('Add Or Remove'); ?></button>
						 </div>
                    <!--
							<div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Short Name '));?></div>
							<div class="col-sm-4">
                                <?php echo $this->Form->input('',array('name'=>'short_name','id'=>'short_name','type'=>'text','class'=>'form-control','value'=>$short_name,'PlaceHolder'=>'Enter Short Name '));?>

							</div>-->
                      <div class="col-sm-2 label_float">Price (<?php echo $this->AMC->getCurrencyCode(); ?>)<span class="require-field">*</span></div>
                    <div class="col-sm-4">
                                <?php echo $this->Form->input('',array('name'=>'price','id'=>'price','type'=>'text','class'=>'form-control validate[required]','value'=>$price,'PlaceHolder'=>'Enter Price ','required'=>'required'));?>
							</div>
                    
                    		
				</div>
            
            
                 
            <div class="form-group">
                
              
							
                
							<div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Unit '));?><span class="require-field">*</span></div>
							<div class="col-sm-2">
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
                  <div class="col-sm-2">
						 		<button type="button" id="period_add" name="" data-toggle="modal" data-target="#unit" class="btn"><?php echo __('Add Or Remove'); ?></button>
						 </div>
                
                  
            
                
                
                
                 <div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Product Image '));?></div>
							<div class="col-sm-4">
                                
                                 <?php
                if(isset($get_row_update))
				{
                    if (isset($get_row_update)) 
					{
						echo $this->Html->image('product/'.$get_row_update['image'],array('height'=>'100px','width'=>'100px','class'=>'img-thumbnail'));
					} 
					echo '<br>';
					echo '<br>';               
					echo $this->Form->input('',array('type'=>'hidden','value'=>$image,'name'=>'image2'));
    
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
            
         
            
          
            
        <div class="header" style="display:none">
          		<h3><?php echo __('Stock'); ?></h3>
          </div>
                    <div class="form-group" style="display:none">
							<div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Opening Stock '));?><span class="require-field">*</span></div>
							<div class="col-sm-4">
                                <?php echo $this->Form->input('',array('name'=>'open_stock','id'=>'issue_date','type'=>'text','class'=>'form-control validate[required]','value'=>$open_stock,'PlaceHolder'=>'Enter Opening Stock '));?>

							</div>
                        <div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Minimum Stock'));?><span class="require-field">*</span></div>
							<div class="col-sm-4">
                                <?php echo $this->Form->input('',array('name'=>'min_stock','id'=>'min_stock','type'=>'text','class'=>'form-control validate[required]','value'=>$min_stock,'PlaceHolder'=>'Enter Minimum Stock'));?>

							</div>
							
				</div>
            
              
        
				<div class="form-group" style="display:none;">
							<div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Maximum Stock '));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'max_stock','id'=>'max_stock','type'=>'text','class'=>'form-control validate[required]','value'=>$max_stock,'PlaceHolder'=>'Enter Maximum Stock '));?>
						 </div>
                    
                   

						
				</div>
            
              <div class="form-group">
							 <div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Product Specification'));?></div>
							<div class="col-sm-10">
                                <?php echo $this->Form->textarea('',array('name'=>'specification','id'=>'specification','type'=>'textarea','class'=>'form-control validate[required]','value'=>$specification,'PlaceHolder'=>''));?>

							</div>
							<div class="col-sm-2"></div>
				</div>
            <!--
              <div class="header">
          		<h3><?php echo __('Inventory'); ?></h3>
          </div>
            
            
             <div class="form-group">
							 <div class="col-sm-2 label_float"><?php echo $this->Form->label(__('Warehouse'));?><span class="require-field">*</span></div>
							
                               <div class="col-sm-2">
							<select class="form-control validate[required]" id="warehouse_id" name="warehouse_id">
         <option value=""><?php echo __('--Warehouse--'); ?></option>
                                <?php
                                    if(isset($warehouselist)){
                                        foreach($warehouselist as $warehouse_info){
                                ?>
                                <option value="<?php echo $warehouse_info['cat_id'];?>" <?php 
                                            if(isset($get_row_update)){
                                                if($warehouse == $warehouse_info['cat_id']){
                                                    echo 'selected="selected"';
                                                }else{
                                                    echo '';
                                                }
                                            }
                                        
                                        ?> ><?php echo $warehouse_info['title'];?></option>
                                <?php
                                        }
                                    }
                                ?>
							</select>
				        </div>
                     <div class="col-sm-2">
						 		<button type="button" id="period_add" name="" data-toggle="modal" data-target="#warehouse" class="btn"><?php echo __('Add Or Remove'); ?></button>
						 </div>			
				</div>-->
            
	
				<div class="form-group" style="margin-top:-20px">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
<?php echo $this->Form->input($btn_name,array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
							</div>
				</div>
			<?php $this->Form->end(); ?>
        
		</div>
</div>			
 <script>
     tinymce.init({ selector:'textarea' });

   
     
</script>

<?php }else{ ?>
<div class="extra_information">
<span class="new_add_text">you are not authorized this page.</span>
</div>
<?php } ?>	