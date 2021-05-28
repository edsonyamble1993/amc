<script>
$(document).ready(function(){
   $('#plist').dataTable();

});
</script>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					 
                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Company'),array('controller'=>'company','action' => 'viewcompany'),array('escape' => false));
						?>

					  </li>

					   <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Company'),array('controller'=>'company','action' => 'addcompany'),array('escape' => false));
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
						<th><?php echo __('Image');?></th>
						<th><?php echo __('Company Id');?></th>
						<th><?php echo __('Company Name');?></th>
						<th><?php echo __('Address');?></th>
                       
                        <th><?php echo __('Email');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('Image');?></th>
						<th><?php echo __('Company Id');?></th>
						<th><?php echo __('Company Name');?></th>
						<th><?php echo __('Address');?></th>
                       
                        <th><?php echo __('Email');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</tfoot>
				<tbody>
                        
                 <?php 
                 		if($companylist){
                 			foreach($companylist as $company_row){
                 				?>
                 <tr>
         <Td><?php echo $this->Html->image('company/'.$company_row['photo'], ['class' => 'img-circle avatar','id'=>'profileimg','width'=>'40','height'=>'40']); ?></Td>
         <td><?php echo $company_row['company_idf']; ?></td>
         <td><?php echo $company_row['company_name']; ?></td>
         <td><?php echo $company_row['company_address']; ?></td>
         <td><?php echo $company_row['pincode']; ?></td>
         <Td><?php echo $company_row['email'];  ?></Td>
						<td>
						<?php echo $this->Html->link(__('Edit'),array('action' => 'updatecompany',$company_row['company_id']),array('class'=>'btn btn-info'))."&nbsp;".$this->Html->link(__('Delete'),array('action' => 'delete',$company_row['company_id']),['confirm'=>__('Are you sure you wish to Delete this Record?'),'class'=>'btn btn-danger']); ?></td>
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








