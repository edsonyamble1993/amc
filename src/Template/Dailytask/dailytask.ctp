<script>
$(document).ready(function(){
   $('#plist').dataTable();

});
</script>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					 
                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Task'),array('controller'=>'task','action' => 'viewtask'),array('escape' => false));
						?>

					  </li>

					   <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Task'),array('controller'=>'task','action' => 'addtask'),array('escape' => false));
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
						<th><?php echo __('Client');?></th>
						<th><?php echo __('Assign To');?></th>
						<th><?php echo __('Assign Date');?></th>
                        <th><?php echo __('Close Date');?></th>
                        <th><?php echo __('Status');?></th>
						
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('Client');?></th>
						<th><?php echo __('Assign To');?></th>
						<th><?php echo __('Assign Date');?></th>
                        <th><?php echo __('Close Date');?></th>
                        <th><?php echo __('Status');?></th>

					</tr>
				</tfoot>
				<tbody>
                        
                  <?php
                    if($dailytask){
                        foreach($dailytask as $task_info){   
                  ?>
					<tr>

                        <td><?php echo $this->AMC->getuser_name($task_info['client_id']);?></td>
                        <td><?php echo $this->AMC->getuser_name($task_info['assign_to']);?></td>
                        <td><?php echo date($this->Amc->getDateFormat(),strtotime($task_info['assign_date']));?></td>
                        <td><?php echo date($this->Amc->getDateFormat(),strtotime($task_info['close_date']));?></td>
                        <td><?php echo $task_info['status']; ?></td>
						<td>

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