<?php 
use Cake\Routing\Router;
?>  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Task Status</h4>
        </div>
        <div class="modal-body">
       
			<div class="row">
					<input type="text" value="" id="task_manage_id" style="display:none;">
				<div class="col-md-12">
				
					<div class="col-md-2">
					<label style="margin-top:5px;"><b> Status :</b></label>
					</div>
					
					<div class="col-md-10">
					<select class="form-control" name="status" id="status_id">
                          
                                                                <option value="0">closed</option>
                                                                    <option value="1">open</option>
                                                                    <option value="2">progress</option>
                                                                </select>
					</div>
					
				</div>
				
			
				
			
			
			</div>
			
			
	   
	   
	   
	   
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		   <button type="button" id="save_status" class="btn btn-success">Save</button>
        </div>
      </div>
      
    </div>
  </div>




<script>
$(document).ready(function(){

		$(".edit_status").click(function(){
			
			$get_task_val=$(this).attr("data-id");
			
			 $("#task_manage_id").val($get_task_val);
		
			
		});
		
		
		$("#save_status").click(function(){
				
		task_update_id=$("#task_manage_id").val();
		task_status_id=$("#status_id").val();
		
		

		
		
			
			$.ajax({
                       type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Task","action" => "updatestatus"]);?>',
                     data : {
					 get_status_id:task_status_id,
					 get_record_id:task_update_id
					 },
                     success: function (response) {	
                            
						},
                    error: function(e) {
                       alert("An error occurred: " + e.responseText);
                       console.log(e);
                },
				beforeSend:function(){
					$("#save_status").text('Loading...');
					$("#save_status").attr('disabled','disabled');
				},
				complete:function(){
			     	$("#save_status").text('Save');
					$("#save_status").attr('disabled','disabled');
					 location.reload();
				}
       });
			
			
		
		
		
		
		});




   $('#plist').dataTable();

});
</script>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					 
                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Task'),array('controller'=>'task','action' => 'viewtask'),array('escape' => false));
						?>

					  </li>

					  
				<?php 
					if($this->request->session()->read('user_role') == 'admin'){
					
					  ?>
					   <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Task'),array('controller'=>'task','action' => 'addtask'),array('escape' => false));
						?>

					  </li>
					  <?php 
					  }
					  ?>

				</ul>
</div>



<div class="panel-body">	
	<div class="table-responsive">
		<div id="example_wrapper" class="dataTables_wrapper">
			<table id="plist" class="table table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?php echo __('Client');?></th>
						<?php if($this->request->session()->read('user_role') == 'admin'){ ?>
						<th><?php echo __('Assign To');?></th>
						<?php } ?>
						<?php if($this->request->session()->read('user_role') == 'employee'){ ?>
						<th><?php echo __('Task Description');?></th>
						<?php } ?>
						<th><?php echo __('Assign Date');?></th>
                        <th><?php echo __('Close Date');?></th>
						 
                        <th><?php echo __('Status');?></th>
						
                        <th><?php echo __('Employee Status');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('Client');?></th>
						<?php if($this->request->session()->read('user_role') == 'admin'){ ?>
						<th><?php echo __('Assign To');?></th>
						<?php } ?>
						<?php if($this->request->session()->read('user_role') == 'employee'){ ?>
						<th><?php echo __('Task Description');?></th>
						<?php } ?>
						<th><?php echo __('Assign Date');?></th>
                        <th><?php echo __('Close Date');?></th>
						
                        <th><?php echo __('Status');?></th>
						 
						 <th><?php echo __('Employee Status');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</tfoot>
				<tbody>
                        
                  <?php
                    if($taskdatalist){
                        foreach($taskdatalist as $task_info){   
                  ?>
					<tr>
                        
                        <td><?php echo $this->AMC->getuser_name($task_info['client_id']);?></td>
						<?php if($this->request->session()->read('user_role') == 'admin'){ ?>
						<td><?php echo $this->AMC->getuser_name($task_info['assign_to']);?></td>
                        <?php } ?>
						<?php if($this->request->session()->read('user_role') == 'employee'){ ?>
						<td><?php echo $task_info['description']; ?> </td>
						<?php } ?>
						<td><?php echo date($this->Amc->getDateFormat(),strtotime($task_info['assign_date']));?></td>
                        <td><?php echo date($this->Amc->getDateFormat(),strtotime($task_info['close_date']));?></td>
                      
					   <td><?php 
                            
                        if($task_info['status'] == 0){
                            echo '<span class="label label-danger">'.__('Closed').'</span>';
                        }else if($task_info['status'] == 1){
                            echo '<span class="label label-success">'.__('Open').'</span>';
                        }else if($task_info['status'] == 2){
                            echo '<span class="label label-info">'.__('Progress').'</span>';
                        }
                            
                            ?></td>
					 
					   <style>
						.employee_status_no
						{
							width:100%;
							float:left;
							text-align:center;
						}
						.accpt_decline
						{
							width:100%;
							float:left;
							
						}
						.accept
						{
							width:50%;
							padding:6px 0px;
							background:#08A7C3;
							color:#fff;
							margin-top:5px;
							float:left;
							text-align:center;
							cursor:pointer;
						}
						.decline
						{
							width:50%;
							padding:6px 0px;
							background:#e14444;
							color:#fff;
							margin-top:5px;
							float:left;
							text-align:center;
							cursor:pointer;
						}
						</style>
						
						<td><div class="employee_status_no"> <?php 

                      
                           
                        if($task_info['employee_status'] == 0){
                            echo '<span class="label  label-danger">'.__('Closed').'</span>';
                        }else if($task_info['employee_status'] == 1){
                            echo '<span class="label  label-success">'.__('Open').'</span>';
                        }else if($task_info['employee_status'] == 2){
                            echo '<span class="label  label-info">'.__('Progress').'</span>';
                        }
                            
                           


                        ?></div>
						<?php if($this->request->session()->read('user_role') == 'admin'){ ?>
						<?php if($task_info['is_appove'] == 1)
						{?>
						<div class="accpt_decline data_decline_<?php echo $task_info['task_id']; ?>">
						<div class="accept" apporveid="<?php echo $task_info['task_id']; ?>" >Approve</div>
						<div class="decline" declineid="<?php echo $task_info['task_id']; ?>">Decline</div>
						</div>
						<?php } ?></td>
						<?php } ?>
						
						
							
						<td>
						<?php 
						
						if($this->request->session()->read('user_role') == 'admin'){ ?>
						<a href="<?php echo $this->Url->build(array('controller'=>'Task','action'=>'addtask',$task_info['task_id']))?>" class="btn btn-info">Edit</a>&nbsp;<a url ="<?php echo $this->Url->build(array('controller'=>'Task','action'=>'delete',$task_info['task_id']))?>" class="btn btn-danger sa-warning">Delete</a>
						
						<?php
						}else if($this->request->session()->read('user_role') == 'employee'){
						
						 
						  echo '<button type="button" class="btn btn-info edit_status" data-id='.$task_info['task_id'].' data-toggle="modal" data-target="#myModal">Edit Status</button>';
						
						}
						
						 ?></td>
					</tr>
           
           <?php
                        }
                    }
           ?>
                   
				</tbody>
				</table>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	$('.sa-warning').click(function(){
	  var url =$(this).attr('url');
	 
	 
        swal({   
            title: "Are you sure?", 
			text: "You will not be able to recover this data afterwards!",			
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#297FCA",   
            confirmButtonText: "Yes, delete!",   
            closeOnConfirm: false 
        }, function(){
			window.location.href = url;
             
        });
    }); 
	$('.accept').click(function(){
					var  apporveid = $(this).attr('apporveid');
					$('.data_decline_'+apporveid).fadeOut();
					$.ajax({
										type: 'POST',
                      					url: '<?php echo $this->Url->build(["controller" => "Task","action" => "approvestatus"]);?>',
                     					data : {apporveid:apporveid},
										success: function (response)
										{	
											
											
											
												
												
											
											
										},
										error:function(e)
										{
											console.log(e);
										}
						});
					
				});
				$('.decline').click(function(){
					var  declineid = $(this).attr('declineid');
					$('.data_decline_'+declineid).fadeOut();
					$.ajax({
										type: 'POST',
                      					url: '<?php echo $this->Url->build(["controller" => "Task","action" => "declineidstatus"]);?>',
                     					data : {declineid:declineid},
										success: function (response)
										{	
											
											
											
												
												
											
											
										},
										error:function(e)
										{
											console.log(e);
										}
						});
					
				});
});
</script>







