<?php
$user_role=$this->request->session()->read('user_role');

?>
<script>
		$(document).ready(function() {
		$('#plist').DataTable();
		} );
	</script>

<div class="row schooltitle">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					
					     <li class="active">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Employee List'),array('controller'=>'Employee','action' => 'employeelist'),array('escape' => false));
						?>

					  </li>
<?php if($user_role == 'admin'){
	?>

					     <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Employee'),array('controller'=>'Employee','action' => 'addemployee'),array('escape' => false));
						?>

					  </li>
					  <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-archive')) .__('Archive Employee'),array('controller'=>'Employee','action' => 'archiveemployee'),array('escape' => false));
						?>

					  </li>
<?php } ?>					   
				</ul>
</div>


<div class="panel-body">	
	<div class="table-responsive">
		<div id="example_wrapper" class="dataTables_wrapper">
			<table id="plist" class="table table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?php echo __('Image');?></th>
						<th><?php echo __('Employee Name');?></th>
						<th><?php echo __('Address');?></th>
                        <th><?php echo __('Mobile Number');?></th>
                        <th><?php echo __('Email');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<th><?php echo __('Image');?></th>
						<th><?php echo __('Employee Name');?></th>
						<th><?php echo __('Address');?></th>
                        <th><?php echo __('Mobile Number');?></th>
                        <th><?php echo __('Email');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</tfoot>
				<tbody>
                        <?php
                        if(isset($employee_data)){
                        	foreach($employee_data as $emp_info){

                        ?>
                 
					<tr class="row_<?php echo $emp_info['user_id']; ?>">
                        <Td><?php echo $this->Html->image('user/'.$emp_info['photo'], ['class' => 'img-circle avatar','id'=>'profileimg','width'=>'40','height'=>'40']); ?></Td>
                        <td><?php echo $emp_info['first_name'].' '.$emp_info['lastname'];?></td>
                        <td><?php echo $emp_info['address'];?></td>
                         <td><?php echo $emp_info['mobile_no'];?></td>
                        <td><?php echo $emp_info['email'];  ?></td>
						<?php if($user_role == 'admin')
						{ ?>
							
						
						<td>
						<?php  $data =  $this->AMC->getCountemployee($emp_info['user_id']); ?>
						<a href="<?php echo $this->Url->build(array('controller'=>'Employee','action'=>'addemployee',$emp_info['user_id']))?>" class="btn btn-info">Edit</a>&nbsp;<a url ="<?php echo $this->Url->build(array('controller'=>'Employee','action'=>'delete',$emp_info['user_id']))?>" class="btn btn-danger <?php if($data == 0){ echo 'sa-warning'; }else{ echo 'notdelete'; } ?>">Delete</a>
						<?php echo $this->Html->link(__('View'),array('action' => 'Viewemployee',$emp_info['user_id']),array('class'=>'btn btn-info')); ?>
						<a url="<?php echo $this->Url->build(array('controller'=>'Ajax','action'=>'archiveemployee',$emp_info['user_id']))?>" class="btn btn-info archive_value" employeeid="<?php echo $emp_info['user_id']; ?>">Archive</a></td>
						
						</td>
						<?php }else{?>
						<td>
						<?php echo $this->Html->link(__('View'),array('action' => 'Viewemployee',$emp_info['user_id']),array('class'=>'btn btn-info')); ?>
						</td> 
						<?php } ?>
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
	$('body').on('click','.archive_value',function(){
		var employeeid = $(this).attr('employeeid');
		swal({   
            title: "Are you sure?", 
			text: "You Want To Move Product In Archive List?",			
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#297FCA",   
            confirmButtonText: "Yes, Move!",   
            closeOnConfirm: false 
        }, function(isConfirm){
			if (isConfirm) {
				
				
				
				$.ajax({
				   type:'POST',
				   url:'<?php echo $this->Url->build(['controller'=>'ajax','action'=>'archiveemployee']);?>',
				   data:{employeeid:employeeid},
				   success:function(data){
						$('.row_'+employeeid).fadeOut();	
						$('.cancel').trigger('click');
					}
					});
			}
             
        });
		});
	
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
	$('.notdelete').click(function(){
	 
	 
        swal({   
            title: "Delete Product", 
			text: "You have added Task with this employee.",			
            type: "warning",   
            
        });
    }); 
});
</script>


