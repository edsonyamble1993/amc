<?php 
use Cake\Routing\Router;
?>
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
                      url: '<?php echo Router::url(["controller" => "Service","action" => "updatestatus"]);?>',
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
   $('#plist').dataTable();

});
</script>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					 
                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Service List'),array('controller'=>'service','action' => 'viewservice'),array('escape' => false));
						?>

					  </li>
                    
                    <?php 
                        if($this->request->session()->read('user_role') != 'client'){
                            ?>
                    
					   <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Service'),array('controller'=>'service','action' => 'addservice'),array('escape' => false));
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
						<th><?php echo __('Service Code');?></th>
						<th><?php echo __('Service Date');?></th>
						<th><?php echo __('Assign To');?></th>
						<th><?php echo __('Service Detail');?></th>
						<th><?php echo __('Customer Name');?></th>
                        <th><?php echo __('status');?></th>
						<th><?php echo __('Employee Status');?></th>
						 <?php 
                        if($this->request->session()->read('user_role') != 'client'){
                            ?>
						<th><?php echo __('Action');?></th>
						<?php } ?>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('Service Code');?></th>
						<th><?php echo __('Service Date');?></th>
						<th><?php echo __('Assign To');?></th>
						<th><?php echo __('Service Detail');?></th>
						<th><?php echo __('Customer Name');?></th>
                        <th><?php echo __('status');?></th>
						<th><?php echo __('Employee Status');?></th>
						 <?php 
                        if($this->request->session()->read('user_role') != 'client'){
                            ?>
						<th><?php echo __('Action');?></th>
						<?php } ?>
					</tr>
				</tfoot>
				<tbody>
                        
                  <?php
                    if($servicelist){
                        foreach($servicelist as $service_info){   
                  ?>
					<tr>
                        <td><?php echo $service_info['service_code']; ?></td>
                        <td><?php echo date($this->Amc->getDateFormat(),strtotime($service_info['date']));?></td>
                        <td><?php echo $this->AMC->getEmployeerName($service_info['assign_to']); ?></td>
                        <td><?php echo $service_info['service_details']; ?></td>
                         <td><?php echo $this->AMC->getuser_name($service_info['customer_id']);?></td>
                        <td><?php
                            
                           if($service_info['status'] == 1){
                               echo '<span class="label label-success">Open</span>';
                           }else if($service_info['status'] == 0){
                               echo '<span class="label label-danger">Closed</span>';
                           }else if($service_info['status'] == 2){
                               echo '<span class="label label-info">In-Progress</span>';                           
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

                      
                           
                        if($service_info['employee_status'] == 0){
                            echo '<span class="label  label-danger">'.__('Closed').'</span>';
                        }else if($service_info['employee_status'] == 1){
                            echo '<span class="label  label-success">'.__('Open').'</span>';
                        }else if($service_info['employee_status'] == 2){
                            echo '<span class="label  label-info">'.__('Progress').'</span>';
                        }
                            
                           


                        ?></div>
						<?php if($this->request->session()->read('user_role') == 'admin'){ ?>
						<?php if($service_info['is_appove'] == 1)
						{?>
						<div class="accpt_decline data_decline_<?php echo $service_info['service_id']; ?>">
						<div class="accept" apporveid="<?php echo $service_info['service_id']; ?>" >Approve</div>
						<div class="decline" declineid="<?php echo $service_info['service_id']; ?>">Decline</div>
						</div>
						<?php } ?></td>
						<?php } ?>
						
							
                        
						<td>
						
                             <?php 
                            if($this->request->session()->read('user_role') == 'admin'){
							
                                echo $this->Html->link(__('Edit'),array('action' => 'updateservice',$service_info['service_id']),array('class'=>'btn btn-info'))."&nbsp;".$this->Html->link(__('Delete'),array('action' => 'delete',$service_info['service_id']),['confirm'=>__('Are you sure you wish to Delete this Record?'),'class'=>'btn btn-danger']);
					 
						  }else if($this->request->session()->read('user_role') == 'employee'){
						
						 
						  echo '<button type="button" class="btn btn-info edit_status" data-id='.$service_info['service_id'].' data-toggle="modal" data-target="#myModal">Edit Status</button>';
						
						}
						  ?>

					 </td>
						 
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
	
	$('.accept').click(function(){
					var  apporveid = $(this).attr('apporveid');
					$('.data_decline_'+apporveid).fadeOut();
					$.ajax({
										type: 'POST',
                      					url: '<?php echo $this->Url->build(["controller" => "Service","action" => "approvestatus"]);?>',
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
                      					url: '<?php echo $this->Url->build(["controller" => "Service","action" => "declineidstatus"]);?>',
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





