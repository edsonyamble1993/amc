<script>
$(document).ready(function(){
   $('#plist').dataTable();

});
</script>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					 
                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Suppliers'),array('controller'=>'Supplier','action' => 'suppliers'),array('escape' => false));
						?>

					  </li>

					   <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Supplier'),array('controller'=>'Supplier','action' => 'supplier'),array('escape' => false));
						?>

					  </li>

				</ul>
</div>



<div class="panel-body">	
	<div class="table-responsive">
		<div id="example_wrapper" class="dataTables_wrapper">
			<table id="plist" class="table table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?php echo __('#');?></th>
						<th><?php echo __('Image');?></th>
						<th><?php echo __('Supplier No');?></th>
						<th><?php echo __('Name');?></th>
						<th><?php echo __('Mobile No');?></th>
						<th><?php echo __('Company Name');?></th>
						<th><?php echo __('Email');?></th>
						
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('#');?></th>
						<th><?php echo __('Image');?></th>
						<th><?php echo __('Supplier No');?></th>
						<th><?php echo __('Name');?></th>
						 <th><?php echo __('Mobile No');?></th>
						<th><?php echo __('Company Name');?></th>
						 <th><?php echo __('Email');?></th>
						
						<th><?php echo __('Action');?></th>
					</tr>
				</tfoot>
				<tbody>
                        
                 <?php 
                 		if(isset($supplier_list)){
							$i = 1;
                 			foreach($supplier_list as $supplier_row){
                 				?>
                 <tr>
                 	 <td><?php echo $i; ?></td>
                      <Td><?php echo $this->Html->image('user/'.$supplier_row['photo'], ['class' => 'img-circle avatar','id'=>'profileimg','width'=>'40','height'=>'40']); ?></Td>
                        <td><?php echo $supplier_row['supplier_code']; ?></td>
         <td><?php echo $supplier_row['first_name']." ".$supplier_row['last_name']; ?></td>
         <td><?php echo $supplier_row['mobile_no']; ?></td>
        	 <td><?php echo $supplier_row['supplier_company']; ?></td>
        	  <td><?php echo $supplier_row['email']; ?></td>
        	 
						<td>
<a href="<?php echo $this->Url->build(array('controller'=>'Supplier','action'=>'supplier',$supplier_row['id']))?>" class="btn btn-info">Edit</a>&nbsp;<a url ="<?php echo $this->Url->build(array('controller'=>'Supplier','action'=>'delete',$supplier_row['id']))?>" class="btn btn-danger sa-warning">Delete</a>
						
						</tr>
                 				<?php $i++;
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
});
</script>




