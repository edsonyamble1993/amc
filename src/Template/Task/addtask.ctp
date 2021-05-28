<?php

    $client_data=(isset($get_row_update))?$get_row_update['client_id']:'';
    $assign_to_data=(isset($get_row_update))?$get_row_update['assign_to']:'';
    $subject_data=(isset($get_row_update))?$get_row_update['subject']:'';
    $assign_date_data=(isset($get_row_update))? date($this->Amc->getDateFormat(),strtotime($get_row_update['assign_date'])):date("Y-m-d");
    $close_date_data=(isset($get_row_update))?date($this->Amc->getDateFormat(),strtotime($get_row_update['close_date'])):date("Y-m-d");
    $remaks_data=(isset($get_row_update))?$get_row_update['remarks']:'';
    $description_data=(isset($get_row_update))?$get_row_update['description']:'';
	$title_tab=(isset($get_row_update))?'Edit Task':'Add Task';
	$icon_tab=(isset($get_row_update))?'fa fa-plus-pencil fa-lg':'fa fa-plus-circle fa-lg';
	$taskstatus=(isset($get_row_update))?$get_row_update['status']:1;
	
	
    



?>



<?php 

use Cake\Routing\Router;
$action = $this->request->params['action'];

?>
<div class="row panel-body">			
				<ul role="tablist" class="nav nav-tabs panel_tabs">
                    
                       <li class="">
							
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Task'),
array('controller'=>'Task','action' => 'viewtask'),array('escape' => false));
						?>						  
					  </li>
                    <li class="active">

  <?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__($title_tab),array(),array('escape' => false));
						?>
					  </li>
					  
				</ul>

<script>
$(function(){

	jQuery('#date,#close_date').datepicker({
		dateFormat: "yy-mm-dd",
		  changeMonth: true,
	        changeYear: true,
	        yearRange:'-65:+0',
	        onChangeMonthYear: function(year, month, inst) {
	            jQuery(this).val(month + "-" + year);
	        }
                    
                });
    
    
    	$('#ttsave').click(function(){
		var task_type = $('#txt_tasktype').val();
		
		if(task_type == ""){
			alert('Please Enter TaskType !');
		}else{
			
			      $.ajax({
                       type: 'POST',
                      url: '<?php echo $this->Url->build(["controller" => "ajax","action" => "addtasktype"]);?>',
                     data : {task_type_data:task_type},
                     success: function (data){
                        
                        
                          if(data > 0){
							  $('#txt_tasktype').val('');
                            $('#tab_tt').append('<tr class="del-'+data+'"><td class="text-center">'+task_type+'</td><td class="text-center"><a href="#" class="del" id="'+data+'" class="btn btn-success"><button class="btn btn-danger btn-xs">X</button></a></td><tr>');
                           $('#tasktype_type').append('<option value='+data+'>'+task_type+'</option>');
                            }else{
								$('#txt_tasktype').val('');
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
<div class="modal fade " id="tt" role="dialog">
    <div class="modal-dialog modal-md"  >

      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div id="result1"></div>
        <h4 align="center"><b><u><?php echo __('Task Type');?></u></b></h4>

        </div>
        <div class="modal-body" >


<table class="table" id="tab_tt" align="center" style="width:40em">
		<tr>
            <th class="text-center"><b><?php echo __('Task Type');?></b></th>
            <th class="text-center"><b><?php echo __('Action'); ?></b></th>
                </tr>
            
            <?php
            if(isset($tasktypelist)){
                foreach($tasktypelist as $task_row){      
            ?>
            <tr class="del-<?php echo $task_row['cat_id'];?>">
                		<td class="text-center"><?php echo $task_row['title']; ?></td>
                		<td class="text-center">
                        <a href="#" class="del" id="<?php echo $task_row['cat_id']; ?>" class="btn btn-success">
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
               		 <?php echo __('Task Type:');?><span class="require-field">*</span></label>
             </div>
            <div class="col-sm-3">
			<?php echo $this->Form->input('',array('class'=>'form-control validate[required]','id'=>'txt_tasktype'));?>
            </div>

            <div class="col-sm-4">
                <a href="#" id="ttsave" class="btn btn-success"><?php echo __('Add TaskType');?> </a>
            </div>
            </div>
	</center>
		
	  </div>

        </div>
      </div>

    </div>


<!--End Complaint Type-->

    
    
    

			
          <?php echo $this->Form->Create('form1',['id'=>'client_form','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'']]);?>

 <div class="header">
          		<h3><?php echo __('Task Information'); ?></h3>
          </div>
		 				
					<div class="form-group">

	
							<div class="col-sm-2 label_right">
								<?php echo $this->Form->label(__('Client'));?> 
                            </div>
                                
								<div class="col-sm-4">

									<select class="form-control" name="client_id">
                                        <option value=""><?php echo __('--Client--'); ?></option>
                                        <?php
                                        if(isset($client_info)){
                                            foreach($client_info as $client_row){
                                        ?>
         <option value="<?php echo $client_row['user_id']; ?>" <?php 
                                
                                                if(isset($get_row_update)){
                                                    if($client_data == $client_row['user_id']){
                                                        echo 'selected="selected"';
                                                    }
                                                }
                                                
                 
                 ?> ><?php echo $client_row['first_name'].' '.$client_row['last_name']; ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                        
                                        
									</select>
						          </div>


						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Assign To'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
                            <select class="form-control" name="assign_to" required="required">
                                <option value="">--assign to--</option>
                                <?php
                                    if(isset($employee_info)){
                                        foreach($employee_info as $emp_row){
                                            ?>
                                            <option value="<?php echo $emp_row['user_id']; ?>" <?php 
                                                        if(isset($get_row_update)){
                                                            if($assign_to_data == $emp_row['user_id']){
                                                                echo 'selected="selected"';
                                                            }
                                                        }
                                                        
                                                    ?> ><?php echo $emp_row['first_name'].' '.$emp_row['last_name']; ?></option>
                                    <?php
                                        }
                                    }
                                ?>
                                
                            </select>
						</div>
						
				</div>


				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Subject'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4" name="subject">
								<?php echo $this->Form->input('',array('name'=>'subject','value'=>$subject_data,'id'=>'','class'=>'form-control','placeholder'=>__('Subject'),'required'=>'required'));?>
							</div>
							

                    
                    	<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Assign Date'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-4">
                                                    
                                <?php //echo $this->Form->input('',array('name'=>'assign_date','value'=>$assign_date_data,'id'=>'date','class'=>'form-control validate[required]','placeholder'=>__('Assign Date'),'required'=>'required'));?>
								<input type="date" name="assign_date" class="form-control validate[required]" placeholder="Date" value="<?php echo date("Y-m-d",strtotime($assign_date_data)); ?>" required="required" id="">
							</div>
							
							
				</div>

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Task Type'));?><span class="require-field">*</span></div>
                    
							<div class="col-sm-2">
								
							<select class="form-control" id="tasktype_type" name="tasktype_id" required="required"> 
                                <option value="" selected="selected">--Task Type--</option>
				                           
            <?php
            if(isset($tasktypelist)){
                foreach($tasktypelist as $task_row){      
            ?>
                                <option value="<?php echo $task_row['cat_id'];?>" <?php 
									if(isset($get_row_update)){
										if($task_row['cat_id'] == $get_row_update['tasktype_id']){
											echo 'selected="selected"';
										}
										
										
									}
								
								?>><?php echo $task_row['title'];?></option>
                                <?php
                }
            }
                                ?>
							</select>
							
							</div>
                    
                        
                    	<div class="col-sm-2">
						 		<button type="button" id="period_add" name="" data-toggle="modal" data-target="#tt" class="btn"><?php echo __('Add Or Remove'); ?></button>
						 </div>

							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Remarks:'));?></div>
                    
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'remarks','value'=>$remaks_data,'id'=>'remark','class'=>'form-control ','placeholder'=>__('Enter Remark')));?>
							</div>
				</div>

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Description'));?><span class="require-field">*</span></div>
							<div class="col-sm-4">
							
<?php echo $this->Form->input('',array('name'=>'description','value'=>$description_data,'id'=>'','class'=>'form-control validate[required]','placeholder'=>__('Enter Description'),'required'=>'required'));?>


							</div>

							<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Close Date'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php //echo $this->Form->input('',array('name'=>'close_date','value'=>$close_date_data,'id'=>'close_date','class'=>'form-control validate[required]','placeholder'=>__('Enter Close Date'),'required'=>'required'));?>
							<input type="date" name="close_date" class="form-control validate[required]" placeholder="Enter Close Date" value="<?php echo date("Y-m-d",strtotime($close_date_data)); ?>" required="required" id="">
						</div>
				</div>
			
			


<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Attachment'));?> 
						</div>
						
					
						<div class="col-sm-4">
						<?php
						if(isset($get_row_update)){
							
					echo $this->Html->image('attachment/'.$get_row_update['attachment'],array('height'=>'100px','width'=>'100px','class'=>'img-thumbnail'));
					echo '<br>';
					echo $get_row_update['attachment'];
							?>
							
							
							<input type="hidden" value="<?php echo $get_row_update['attachment'];?>" name="old_image">
							<?php
						}
						?>
						
						
						
							<?php echo $this->Form->input('',array('name'=>'attachment','type'=>'file','class'=>'form-control file')); ?>
						</div>
						
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Status'));?> 
						</div>
						<div class="col-sm-4">
							
                              <select class="form-control" name="status">
						<option value="1" <?php if($taskstatus == 1){ echo 'selected'; } ?>>Open</option>
						<option value="2" <?php if($taskstatus == 2){ echo 'selected'; } ?>>Progress</option>
						<option value="0" <?php if($taskstatus == 0){ echo 'selected'; } ?>>Closed</option>
						</select>
                                 
                            
						</div>
						
						
			</div>

			

		



				 <div class="header">
          		<h3><?php echo __(''); ?></h3>
          </div>



			<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
							<?php echo $this->Form->input(__('Save'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
							</div>
				</div>
			<?php $this->Form->end(); ?>

</div>			

