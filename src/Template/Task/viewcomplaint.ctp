<script>
$(document).ready(function(){
   $('#plist').dataTable();

});
</script>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					 
                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Complaint'),array('controller'=>'complaint','action' => 'viewcomplaint'),array('escape' => false));
						?>

					  </li>

					   <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Complaint'),array('controller'=>'complaint','action' => 'addcomplaint'),array('escape' => false));
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
						<th><?php echo __('Ticket no');?></th>
						<th><?php echo __('Customer Name');?></th>
						<th><?php echo __('Complaint Date');?></th>
                        <th><?php echo __('Address');?></th>
                        <th><?php echo __('Company No');?></th>
                        <th><?php echo __('Status');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('Ticket no');?></th>
						<th><?php echo __('Customer Name');?></th>
						<th><?php echo __('Complaint Date');?></th>
                        <th><?php echo __('Address');?></th>
                        <th><?php echo __('Company No');?></th>
                        <th><?php echo __('Status');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</tfoot>
				<tbody>
                        
                  <?php
                    if($get_record_complaint){
                        foreach($get_record_complaint as $complaint_info){   
                  ?>
					<tr>
                        <td><?php echo $complaint_info['ticket_no'];?></td>
                        <td><?php echo $this->AMC->getuser_name($complaint_info['customer_id']);?></td>
                        <td><?php echo date($this->Amc->getDateFormat(),strtotime($complaint_info['complaint_date']));?></td>
                        <td><?php echo $complaint_info['address']; ?></td>
                         <td><?php echo $complaint_info['company_name']; ?></td>
                        <td><?php echo $complaint_info['status']; ?></td>
						<td>
						<?php echo $this->Html->link(__('Edit'),array('action' => 'updatecomplaint',$complaint_info['complaint_id']),array('class'=>'btn btn-info'))."&nbsp;".$this->Html->link(__('Delete'),array('action' => 'delete',$complaint_info['complaint_id']),['confirm'=>__('Are you sure you wish to Delete this Record?'),'class'=>'btn btn-danger']); ?></td>
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








