<script>
$(document).ready(function(){
   $('#plist').dataTable();

});
</script>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					 
                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Daily Service'),array('controller'=>'service','action' => 'todayservice'),array('escape' => false));
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
						<th><?php echo __('AMC No.');?></th>
						<th><?php echo __('Date');?></th>
						<th><?php echo __('Title');?></th>
                        <th><?php echo __('Customer');?></th>
                        <th><?php echo __('Email');?></th>
                        <th><?php echo __('Address');?></th>
						
                        
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('AMC No.');?></th>
						<th><?php echo __('Date');?></th>
						<th><?php echo __('Title');?></th>
                        <th><?php echo __('Customer');?></th>
                        <th><?php echo __('Email');?></th>
                         <th><?php echo __('Address');?></th>
						
					</tr>
				</tfoot>
				<tbody>
                        
                  <?php
                   
                    
                    if(isset($service_data)){
                        foreach($service_data as $service_info){   
                  ?>
					<tr>
                        <td><?php echo $service_info['amc_no']; ?></td>
                        <td><?php echo date($this->Amc->getDateFormat(),strtotime($service_info['service_date']));?></td>
                         <td><?php echo $service_info['title']; ?></td>                        
                        <td><?php echo $this->AMC->getuser_name($service_info['customer_id']);?></td>
                        <td><?php echo $service_info['email']; ?></td>
                        <td><?php echo $service_info['address']; ?></td>
                        
						
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








