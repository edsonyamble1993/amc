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
					
					     <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Client List'),array('controller'=>'client','action' => 'clientlist'),array('escape' => false));
						?>

					  </li>
<?php if($user_role == 'admin'){
	?>
					     <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Client'),array('controller'=>'client','action' => 'addclient'),array('escape' => false));
						?>

					  </li>
					  <li class="active">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-archive')) .__('Archive Client'),array('controller'=>'client','action' => 'archiveclient'),array('escape' => false));
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
						<th><?php echo __('Client Name');?></th>
						<th><?php echo __('Address');?></th>
                        <th><?php echo __('Mobile Number');?></th>
                        <th><?php echo __('Email');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<th><?php echo __('Image');?></th>
						<th><?php echo __('Client Name');?></th>
						<th><?php echo __('Address');?></th>
                        <th><?php echo __('Mobile Number');?></th>
                        <th><?php echo __('Email');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</tfoot>
				<tbody>
                        <?php
                        if(isset($client_data)){
                        	foreach($client_data as $client_info){

                        ?>
                 
					<tr>
                        <Td><?php echo $this->Html->image('user/'.$client_info['photo'], ['class' => 'img-circle avatar','id'=>'profileimg','width'=>'40','height'=>'40']); ?></Td>
                        <td><?php echo $client_info['first_name'].' '.$client_info['lastname'];?></td>
                        <td><?php 
							 $array_conv=json_decode($client_info['address']);
							 if(is_array($array_conv)){
									foreach($array_conv as $arr_val){
										echo "{$arr_val}<br>";
									}
							 }else{
									echo $client_info['address'];
							 }
							 
							 
						
						?></td>
                         <td><?php echo $client_info['mobile_no'];?></td>
                        <td><?php echo $client_info['email'];  ?></td>
						<?php if($user_role == 'admin' || $user_role == 'employee'){
	?>
						<td>
						<?php  $data =  $this->AMC->getCountclient($client_info['user_id']); ?>
						
						<a url ="<?php echo $this->Url->build(array('controller'=>'Client','action'=>'delete',$client_info['user_id']))?>" class="btn btn-danger <?php if($data == 0){ echo 'sa-warning'; }else{ echo 'notdelete'; } ?>">Delete</a>
						
						</td>
						<?php }else{?>
						<td>
						<?php echo $this->Html->link(__('View'),array('action' => 'Viewclient',$client_info['user_id']),array('class'=>'btn btn-info')); ?>
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
			text: "You have added Purchase,Complaint,Quotation,Sales With this product..",			
            type: "warning",   
            
        });
    }); 
});
</script>



