<?php 
use Cake\Routing\Router;
?>

  <!-- Modal -->
  <div class="modal fade" id="tasksmodel" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Task Status</h4>
        </div>
        <div class="modal-body">
       
			<div class="row">
					<input type="text" value="" id="comp_manage_id" style="display:none;">
				<div class="col-md-12">
				
					<div class="col-md-2">
					<label style="margin-top:5px;"><b> Status :</b></label>
					</div>
					
					<div class="col-md-10">
					<select class="form-control" name="status" id="status_id">
                                <option>--Status--</option>
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
			
			$get_comp_val=$(this).attr("data-id");
			
			
			
			 $("#comp_manage_id").val($get_comp_val);
		
			
		});
		
		
		$("#save_status").click(function(){
				
		comp_update_id=$("#comp_manage_id").val();
		comp_status_id=$("#status_id").val();
		
		

		
		
			
			$.ajax({
                       type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Complaint","action" => "updatestatus"]);?>',
                     data : {
					 get_status_id:comp_status_id,
					 get_record_id:comp_update_id
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




 
   

});
</script>





<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					 
                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Complaint'),array('controller'=>'complaint','action' => 'viewcomplaint'),array('escape' => false));
						?>

					  </li>
					  
					  <?php 
						if($this->request->session()->read('user_role') != 'employee'){
					  ?>

					   <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Complaint'),array('controller'=>'complaint','action' => 'addcomplaint'),array('escape' => false));
						?>

					  </li>
					  
					  <?php } ?>

				</ul>
</div>

<div id="complaintdetail" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
	  <div class="modal-header"> 
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 id="myLargeModalLabel" class="modal-title"><?php echo __('Complaint'); ?></h4>
		</div>
	  
      <div class="modal-body">
		
      </div>
      
	  
    </div>

  </div>
</div>

<div class="panel-body">	
	<div class="table-responsive">
		<div id="example_wrapper" class="dataTables_wrapper">
			<table id="plist" class="table table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?php echo __('Complaint Number');?></th>
						<th><?php echo __('Customer Name');?></th>
						<th><?php echo __('Complaint Date');?></th>
                        <th><?php echo __('Complaint Type');?></th>
						<?php if($this->request->session()->read('user_role') == 'admin') { ?>
                        <th><?php echo __('Assign To');?></th>
						<?php } ?>
                        <th><?php echo __('Status');?></th>
						
                        <th><?php echo __('Employee Status');?></th>
						
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('Complaint Number');?></th>
						<th><?php echo __('Customer Name');?></th>
						<th><?php echo __('Complaint Date');?></th>
                        <th><?php echo __('Complaint Type');?></th>
                       <?php if($this->request->session()->read('user_role') == 'admin') { ?>
                        <th><?php echo __('Assign To');?></th>
						<?php } ?>
                        <th><?php echo __('Status');?></th>
						
						<th><?php echo __('Employee Status');?></th>
							
						<th><?php echo __('Action');?></th>
					</tr>
				</tfoot>
				<tbody>
                        
                  <?php
                    if($get_record_complaint){
                        foreach($get_record_complaint as $complaint_info){   
                  ?>
					<tr>
                        <td><?php echo $complaint_info['complaint_no'];?></td>
                        <td><?php echo $this->AMC->getuser_name($complaint_info['customer_id']);?></td>
                        <td><?php echo date($this->Amc->getDateFormat(),strtotime($complaint_info['complaint_date']));?></td>
                        <td><?php echo $this->AMC->getCategoryName($complaint_info['complaint_type_id']); ?></td>
                         <?php if($this->request->session()->read('user_role') == 'admin') { ?>
						 <td>
								 <?php 
								 if($complaint_info['assign_to']>0)
								 { 
									echo $this->AMC->getEmployeerName($complaint_info['assign_to']); 
								 }else
								 { 
									?>
									
									
									
									
									
									<select class="form-control assign_to_employee" complain_id = "<?php echo $complaint_info['complaint_id']; ?>" name="assign_to" required="required">
							<option value="0"><?php echo __('Select Name'); ?></option>
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
							<?php
								 
								 
								 
								 
								 
								 } ?>
						</td>
						 <?php } ?>
                        <td><?php 

                      
                            
                        if($complaint_info['status'] == 0){
                            echo '<span class="label label-danger">'.__('Closed').'</span>';
                        }else if($complaint_info['status'] == 1){
                            echo '<span class="label label-success">'.__('Open').'</span>';
                        }else if($complaint_info['status'] == 2){
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

                      
                           
                        if($complaint_info['employee_status'] == 0){
                            echo '<span class="label  label-danger">'.__('Closed').'</span>';
                        }else if($complaint_info['employee_status'] == 1){
                            echo '<span class="label  label-success">'.__('Open').'</span>';
                        }else if($complaint_info['employee_status'] == 2){
                            echo '<span class="label  label-info">'.__('Progress').'</span>';
                        }
                            
                           


                        ?></div>
						<?php if($this->request->session()->read('user_role') == 'admin'){ ?>
						<?php if($complaint_info['is_appove'] == 1)
						{?>
						<div class="accpt_decline data_decline_<?php echo $complaint_info['complaint_id']; ?>">
						<div class="accept" apporveid="<?php echo $complaint_info['complaint_id']; ?>" >Approve</div>
						<div class="decline" declineid="<?php echo $complaint_info['complaint_id']; ?>">Decline</div>
						</div>
						<?php } ?></td>
						<?php } ?>
						<td>
						<?php 
						
						if($this->request->session()->read('user_role') == 'admin' || $this->request->session()->read('user_role') == 'client'){?>
						<button action="complaintdetail" data-toggle="modal" data-target="#complaintdetail" print="<?php echo $complaint_info['complaint_id']; ?>" class="btn btn-info save" type="submit">View</button>
						<a href="<?php echo $this->Url->build(array('controller'=>'Complaint','action'=>'updatecomplaint',$complaint_info['complaint_id']))?>" class="btn btn-info">Edit</a>&nbsp;<a url ="<?php echo $this->Url->build(array('controller'=>'Complaint','action'=>'delete',$complaint_info['complaint_id']))?>" class="btn btn-danger sa-warning">Delete</a>
						<?php }else if($this->request->session()->read('user_role') == 'employee'){
						echo $this->Form->button($this->Html->tag('i',"&nbsp;", array('class' => '')). __('View'),['action'=>'complaintdetail','data-toggle'=>'modal','data-target'=>'#complaintdetail','print'=>$complaint_info['complaint_id'],'class'=>'btn btn-info save'],['escape' => false]).' '.
						$this->Html->link(__('EditStatus'),array('action' => 'updatestatuscomplaint',$complaint_info['complaint_id']),array('class'=>'btn btn-info'));
						
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


<script type="text/javascript">
$(document).ready(function(){
					$('.assign_to_employee').change(function(){
						var employee_id =$(this).val();
						var compain_id =$(this).attr('complain_id');
						
						$.ajax({
										type: 'POST',
                      					url: '<?php echo $this->Url->build(["controller" => "Complaint","action" => "changestatus"]);?>',
                     					data : {compain_id:compain_id,employee_id:employee_id},
										success: function (response)
										{	
											
										},
						});
						
				});
				});
				</script>
				<script>
				$(document).ready(function(){
				$('.accept').click(function(){
					var  apporveid = $(this).attr('apporveid');
					$('.data_decline_'+apporveid).fadeOut();
					$.ajax({
										type: 'POST',
                      					url: '<?php echo $this->Url->build(["controller" => "Complaint","action" => "approvestatus"]);?>',
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
				});
				</script>
				<script>
				$(document).ready(function(){
				$('.decline').click(function(){
					var  declineid = $(this).attr('declineid');
					$('.data_decline_'+declineid).fadeOut();
					$.ajax({
										type: 'POST',
                      					url: '<?php echo $this->Url->build(["controller" => "Complaint","action" => "declineidstatus"]);?>',
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
				<script>
$( document ).ready(function(){

    $(".save").click(function(){ 
	   
	   $('.modal-body').html("");
	   
       var str = $(this).attr("print");
	 
       $.ajax({
       type: 'POST',
       url: '<?php echo $this->Url->build(["controller" => "Complaint","action" => "complaintdetail"]);?>',
	
       data : {id:str},
       success: function (data)
       {            

			  $('.modal-body').html(data);
				
   },
   beforeSend:function(){
						$(".modal-body").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
					},
error: function(e) {
       alert("An error occurred: " + e.responseText);
       console.log(e);	
}

       });

       });
	      

   });

</script>
    <script>
$(document).ready(function(){
   $('#plist').dataTable();

});
</script>
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
});
</script>





