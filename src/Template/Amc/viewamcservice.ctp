<script>
$(document).ready(function(){
   $('#plist').dataTable();

});
</script>

<style type="text/css">
.label.label-success.btn:hover {
  color: #ffffff;
}

.label.label-danger.btn:hover {
  color: #ffffff;
}

.label.label-info.btn:hover {
  color: #ffffff;
}
.dataTable .fa.fa-edit {
  font-size: 20px;
}
</style>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">

                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Amc'),array('controller'=>'Amc','action' => 'viewamc'),array('escape' => false));
						?>

					  </li>

					   <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Amc'),array('controller'=>'Amc','action' => 'addamc'),array('escape' => false));
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
			<th><?php echo __('Service Date');?></th>
			<th><?php echo __('Customer Name');?></th>
			<th><?php echo __('AMC Code');?></th>
            <th><?php echo __('Chargeable');?></th>
            <th><?php echo __('Assigned To');?></th>
            <th><?php echo __('Assigned Date');?></th>
            <th><?php echo __('Close Date'); ?></th>
             <th><?php echo __('Status');?></th>
            <th><?php echo __('Remarks');?></th>
            <th><?php echo __('Address');?></th>
            <th><?php echo __('Action');?></th>

					</tr>
				</thead>
				<tfoot>
					<tr>
            <th><?php echo __('Service Date');?></th>
            <th><?php echo __('Customer Name');?></th>
            <th><?php echo __('AMC Code');?></th>
            <th><?php echo __('Chargeable');?></th>
            <th><?php echo __('Assigned To');?></th>
            <th><?php echo __('Assigned Date');?></th>
            <th><?php echo __('Close Date'); ?></th>
 			<th><?php echo __('Status');?></th>
            <th><?php echo __('Remarks');?></th>
            <th><?php echo __('Address');?></th>
            <th><?php echo __('Action');?></th>

					</tr>
				</tfoot>
				<tbody>

		<?php
				if(isset($service_data)){
					foreach($service_data as $service_row){
				}
		?>
					<tr>
			<td><?php echo date($this->Amc->getDateFormat(),strtotime($service_row['service_date'])); ?></td>
            <td><?php echo $this->AMC->getuser_name($service_row['customer_id']); ?></td>
            <td><?php echo $service_row['amc_no']; ?></td>
            <td><?php 
            		if((int)$service_row['complaint_chargeble'] == 1){
            			echo __('Chargeable');
            		}else{
            			echo __('Non-Chargeable');
            		}
             	

             ?></td>
            <td><?php echo $this->AMC->getuser_name($service_row['assign_to']); ?></td>
            <td><?php echo date($this->Amc->getDateFormat(),strtotime($service_row['assign_date']));?></td>
            <td><?php echo $service_row['close_date']; ?></td>
             <td><?php 
            		if((int)$service_row['status'] == 0){
            			echo '<label class="label label-danger btn">';
            			echo __('Open');
            			echo '</label>';
            			
            		}else if((int)$service_row['status'] == 1){
            			echo '<label class="label label-success btn">';
            			echo __('Close');
            			echo '</label>';

            		}else if((int)$service_row['status'] == 2){
            			echo '<label class="label label-info btn">';
            			echo __('In-Progress');
            			echo '</label>';

            		}

            		?></td>
            <td><?php echo $service_row['service_remark'];?></td>
            <td><?php echo $service_row['address']; ?></td>
           
            		<td>
            		<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-edit')) .__(''),array('controller'=>'amc','action' => 'editviewamcservice'),array('escape' => false,'class'=>'btn btn-primary'));?> 
            		</td>
					</tr>
					<?php
				}
				?>


				</tbody>
				</table>
		</div>
	</div>
</div>
