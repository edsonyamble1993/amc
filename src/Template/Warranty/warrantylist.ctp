


<script>
		$(document).ready(function() {
		$('#plist').DataTable();
		} );
	</script>

<div class="row schooltitle">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					
					     <li class="active">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Warranty List'),array('controller'=>'warranty','action' => 'warrantylist'),array('escape' => false));
						?>

					  </li>

					     <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Warranty'),array('controller'=>'warranty','action' => 'addwarranty'),array('escape' => false));
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
						<th><?php echo __('Years');?></th>
						<th><?php echo __('Months');?></th>
						<th><?php echo __('Days');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<th><?php echo __('Years');?></th>
						<th><?php echo __('Months');?></th>
						<th><?php echo __('Days');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</tfoot>
				<tbody>
                        <?php
                           if($warranty_data){
                               foreach ($warranty_data as $warranty_row) {
                                
                        ?>
                 
					<tr>
                        <Td><?php echo $warranty_row['years']; ?></td>
                        <td><?php echo $warranty_row['months']; ?></td>
                        <td><?php echo $warranty_row['days'];?></td>
						<td>
						<?php echo $this->Html->link(__('Edit'),array('action' => 'addwarranty',$warranty_row['warranty_id']),array('class'=>'btn btn-info'))."&nbsp;".$this->Html->link(__('Delete'),array('action' => 'delete',$warranty_row['warranty_id']),['confirm'=>__('Are you sure you wish to Delete this Record?'),'class'=>'btn btn-danger']); ?></td>
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




