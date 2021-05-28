<?php

$complaint_number=(isset($update_row))?$update_row['complaint_no']:'';
$status=(isset($update_row))?$update_row['status']:'';
$mobile=(isset($update_row))?$update_row['mobile_no']:'';
$email=(isset($update_row))?$update_row['email']:'';
$close_date=(isset($update_row))?date($this->Amc->getDateFormat(),strtotime($update_row['close_date'])):'';
$complaint_description =(isset($update_row))?$update_row['complaint_description']:'';
$address=(isset($update_row))?$update_row['address']:'';
$complaint_charge=(isset($update_row))?$update_row['complaint_chargeble']:'';
$cityname=(isset($update_row))?$update_row['city_name']:'';
$description=(isset($update_row))?$update_row['description']:'';
$assign_date=(isset($update_row))?date($this->Amc->getDateFormat(),strtotime($update_row['assign_date'])):'';
$assign_to=(isset($update_row))?$update_row['assign_to']:'';



?>



<?php 

use Cake\Routing\Router;
$action = $this->request->params['action'];

?>
<div class="row panel-body">			
				<ul role="tablist" class="nav nav-tabs panel_tabs">
                    
                       <li class="">
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Complaint List'),
array('controller'=>'Complaint','action' => 'viewcomplaint'),array('escape' => false));
						?>						  
					  </li>
                    
					  <li class="<?php echo $action=='updatecomplaint'?'active':''?>">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-pencil fa-lg')) .__('Update Complaint'),array('controller'=>'Complaint','action' => 'addcomplaint'),array('escape' => false));
						?>
  
					  </li>
				</ul>

<script>
$(function(){

	jQuery('#complaint_date,#close_date,#assign_date').datepicker({
		dateFormat: "yy-mm-dd",
		  changeMonth: true,
	        changeYear: true,
	        yearRange:'-65:+0',
	        onChangeMonthYear: function(year, month, inst) {
	            jQuery(this).val(month + "-" + year);
	        }
                    
                });


		$('#ctsave').click(function(){
		var complaint_type = $('#complainttype').val();
		
		if(complaint_type == ""){
				alert('Please Enter Complaint Type!');
		}else{
			
			        $.ajax({
                       type: 'POST',
                      url: '<?php echo $this->Url->build(["controller" => "ajax","action" => "addcomplainttype"]);?>',
                     data : {complaint_type_data:complaint_type},
                     success: function (data){
                           if(data > 0){
							 $('#complainttype').val('');
                            $('#tab_ct').append('<tr class="del-'+data+'"><td class="text-center">'+complaint_type+'</td><td class="text-center"><a href="#" class="del" id="'+data+'" class="btn btn-success"><button class="btn btn-danger btn-xs">X</button></a></td><tr>');
                           $('#complaint_type').append('<option value='+data+'>'+complaint_type+'</option>');
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



	
		$('#designationsave').click(function(){
		var desig = $('#txtdesignation').val();
		
		if(desig == ""){
			
			alert("Please Enter Designation !");
			
		}else{
			
			       $.ajax({
                       type: 'POST',
                      url: '<?php echo $this->Url->build(["controller" => "ajax","action" => "savedesignation"]);?>',
                     data : {designation_data:desig},
                     success: function (data){
						
                           if(data > 0){
                            $('#tab_designation').append('<tr class="del-'+data+'"><td class="text-center">'+desig+'</td><td class="text-center"><a href="#" class="del" id="'+data+'" class="btn btn-success"><button class="btn btn-danger btn-xs">X</button></a></td><tr>');
                           $('#designation').append('<option value='+data+'>'+desig+'</option>');
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


   var id=$(this).attr('id');
    r=confirm('Are you sure you wish to Delete this Record?');
		if(r == true){
   $.ajax({
   type:'POST',
   url:'<?php echo $this->Url->build(['controller'=>'ajax','action'=>'deletebrand']);?>',
   data:{brand_id:id},
   success:function(data){
        $('body .del-'+id).fadeOut(300);

   }

   }) ;
   }
    
});



});
</script>



<!--Complain Type Information Model-->
<div class="modal fade " id="ct" role="dialog">
    <div class="modal-dialog modal-md"  >

      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div id="result1"></div>
        <h4 align="center"><b><u><?php echo __('Complaint Type');?></u></b></h4>

        </div>
        <div class="modal-body" >


<table class="table" id="tab_ct" align="center" style="width:40em">
		<tr>
            <th class="text-center"><b><?php echo __('Complaint Type');?></b></th>
            <th class="text-center"><b><?php echo __('Action'); ?></b></th>
                </tR>
            
            <?php
            if(isset($complainttypelist)){
                foreach($complainttypelist as $ct_info){      
            ?>
            <tr class="del-<?php echo $ct_info['cat_id'];?>">
                		<td class="text-center"><?php echo $ct_info['title']; ?></td>
                		<td class="text-center">
                        <a href="#" class="del" id="<?php echo $ct_info['cat_id']; ?>" class="btn btn-success">
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
               		 <?php echo __('Complaint Type:');?><span class="require-field">*</span></label>
             </div>
            <div class="col-sm-3">
			<?php echo $this->Form->input('',array('class'=>'form-control validate[required]','id'=>'complainttype'));?>
            </div>

            <div class="col-sm-4">
                <a href="#" id="ctsave" class="btn btn-success"><?php echo __('Add ComplaintType');?> </a>
            </div>
            </div>
	</center>
		
	  </div>

        </div>
      </div>

    </div>


<!--End Complaint Type-->








			
          <?php echo $this->Form->Create('form1',['id'=>'client_form','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'']]);?>

          <div class="header panel-body">
          		<h3><?php echo __('Complaint Information'); ?></h3>
          </div>
		
		 <input type="hidden" value="employee" name="role">
	
				<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Complain Number:'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'ticket_no','value'=>$complaint_number,'class'=>'form-control validate[required]','readonly'));?>
						</div>


							<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Status:'));?>
						</div>
						<div class="col-sm-4">
						<select class="form-control" name="status" <?php 
							if($this->request->session()->read('user_role') == 'client'){echo 'disabled="disabled"';}
						?>>
					

						<option value="1" <?php if($update_row['status'] == 1){ echo 'selected="selected"'; }?> ><?php echo __('Open'); ?></option>
						<option value="2" <?php if($update_row['status'] == 2){ echo 'selected="selected"'; }?> ><?php echo __('Progress');?></option>
						<option value="0" <?php if($update_row['status'] == 0){ echo 'selected="selected"'; }?> ><?php echo __('Close');?></option>
						</select>
						</div>
						
				</div>


				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Complaint Date'));?></div>
                    
							<div class="col-sm-4">
								<?php //echo $this->Form->input('',array('name'=>'complaint_date','value'=>date('Y-m-d'),'id'=>'complaint_date','class'=>'form-control','placeholder'=>__('Date')));?>
								<input type="date" name="complaint_date" class="form-control" value="<?php echo date("Y-m-d"); ?>" id="complaint_date" placeholder="Date">
							</div>
							<?php if($this->request->session()->read('user_role') == 'admin'){ ?>
						<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Mobile No:'));?></div>
                    
							<div class="col-sm-4">
							<input type="text" name="mobile_no" id="mobile" class="form-control" placeholder="Enter Mobile Number"  value="<?php echo $mobile; ?>" readonly>
								</div>	
							<?php } ?>
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
				<?php if($this->request->session()->read('user_role') == 'admin'){?>
							
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Customer Name'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
							
							
							
								
							<select class="form-control" id="customer" name="customer_id"> 
								<option value="" selected="selected">--Select Customer--</option>
								<?php 
									if(isset($client_info)){
										foreach($client_info as $client_row){
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
							<?php } ?>
							<?php if($this->request->session()->read('user_role') == 'admin'){?>
							<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Email'));?> 
						</div>
						<div class="col-sm-4">
						<input type="text" name="email" id="email" class="form-control" placeholder="Enter Email"  value="<?php echo $email; ?>" readonly>
							</div>
							<?php } ?>
				</div>

				
			<div class="form-group">

					
				
<?php if($this->request->session()->read('user_role') == 'employee'){?>
						<div class="col-sm-2 label_right">
							
							<label for="alternate-mobile-number"><?php echo __('Closed Date ');?></label>
							
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'close_date','value'=>$close_date,'id'=>'close_date','class'=>'form-control validate[required]','placeholder'=>__('Close Date'),'required'=>'required'));?>
						</div>
<?php } ?>
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Complaint Type'));?> <span class="require-field">*</span>
						</div>
				
						<div class=" <?php if($this->request->session()->read('user_role') == 'admin'){ echo 'col-sm-2'; }else { echo 'col-sm-4'; }?>">
							<select class="form-control" name="complaint_type_id" id="complaint_type" required="required">
								<option value="">--Select--</option>
								<?php
									if(isset($complainttypelist)){
										foreach($complainttypelist as $complainttype_info){
								?>
								<option value="<?php echo $complainttype_info['cat_id'];?>" <?php 
                                            if(isset($update_row)){
                                                if($update_row['complaint_type_id'] == $complainttype_info['cat_id']){
                                                    echo 'selected="selected"';
                                                }
                                            }

                                ?> ><?php echo $complainttype_info['title'];?></option>
								<?php
								}
								}
								?>
							</select>
						</div>
<?php if($this->request->session()->read('user_role') == 'admin'){?>
						<div class="col-sm-2">
						 		<button type="button" id="period_add" name="" data-toggle="modal" data-target="#ct" class="btn"><?php echo __('Add Or Remove'); ?></button>
						 </div>
<?php } ?>
			</div>






			<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Complaint Description'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->textarea('',array('name'=>'complaint_description','required'=>'required','value'=>$complaint_description,'class'=>'form-control validate[required]'));?>
						</div>
						
						<?php if($this->request->session()->read('user_role') == 'admin'){?>
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__(' Address'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
						<textarea name="address" id="address" class="form-control" rows="5" readonly><?php echo $address; ?></textarea>
							</div>
						<?php } ?>
						
			</div>





<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Complaint Chargeble'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
						<select class="form-control" name="complaint_chargeble">
							<option value="0" <?php if($update_row['complaint_chargeble'] == 0){echo 'selected="selected"'; }?> ><?php echo __('No');?></option>
							<option value="1" <?php if($update_row['complaint_chargeble'] == 1){echo 'selected="selected"'; }?> ><?php echo __('Yes');?></option>
							
						</select>
						</div>
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Product'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<select class="form-control" name="product_id" id="product_id" required>
								<option value="">--Product--</option>
									<?php
									
										
										if(isset($productdatalist)){
											foreach($productdatalist as $product_info){
									?>
								
								<option value="<?php echo $product_info['product_id'];?>" <?php  

                                                if($update_row['product_id'] == $product_info['product_id']){
                                                    echo 'selected="selected"';
                                                }
                                
                                
                                ?> ><?php echo $product_info['item_name'];?></option>
								<?php
										}
										}
										?>
							</select>
						</div>
						
						
						
						
			</div>
<script>
	$(function(){
			$('#product_id').change(function(){
				product_id=$(this).val();
			

					$.ajax({
                       				type: 'POST',
                      					url: '<?php echo Router::url(["controller" => "Ajax","action" => "getserial"]);?>',
                     					data : {product_idf:product_id},
                     						success: function (response)
                        						{	
													console.log(response);
													
                           							var res_pro=$.parseJSON(response);
                           							$('#serial_code').attr('value',res_pro.model_no);
                           							
												},

												
                    error: function(e) {
                 alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
						});				


			});

	});
</script>

<?php if($this->request->session()->read('user_role') == 'admin'){?>
				

			
<div class="form-group">
						
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Assign Date'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
								<?php //echo $this->Form->input('',array('name'=>'assign_date','value'=>$assign_date,'id'=>'assign_date','class'=>'form-control validate[required]','required'=>'required'));?>
								<input type="date" name="assign_date" class="form-control" value="<?php echo date("Y-m-d",strtotime($assign_date)); ?>" placeholder="Date">
						</div>
						
						
			</div>




<?php } ?>

				<div class="form-group">
				<?php if($this->request->session()->read('user_role') == 'admin'){?>
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Assign to'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<select class="form-control" name="assign_to" required="required">
							<option value=""><?php echo __('Select Name'); ?></option>
							<?php
								if(isset($employee_info)){
									foreach($employee_info as $emp_data){
										?>
											<option value="<?php echo $emp_data['user_id'];?>" <?php 
                                                if($update_row['assign_to'] == $emp_data['user_id']){
                                                    echo 'selected="selected"';
                                                }

                                            
                                            ?> ><?php echo $emp_data['first_name'].' '.$emp_data['last_name']; ?></option>

										<?php
										}
								}
								?>
							</select>
						</div>
				<?php } ?>

<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Attachment'));?>
						</div>
						
						
						
					
						<div class="col-sm-4">
						<?php 
							if(isset($update_row)){
							echo $this->Html->image('attachment/'.$update_row['attachment'],array('height'=>'100px','width'=>'100px'));
							?>
							<input type="hidden" value="<?php echo $update_row['attachment'];?>" name="old_image">							
								<?php
							}
						?>
								<?php echo $this->Form->input('',array('name'=>'attachment','value'=>'','type'=>'file','id'=>'','class'=>'form-control file validate[required]'));?>
						</div>
		
			  </div>




			<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
							<?php echo $this->Form->input(__('Update'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
							</div>
				</div>
			<?php $this->Form->end(); ?>
		
</div>			


        
           
 



