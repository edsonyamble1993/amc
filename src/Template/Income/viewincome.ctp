<script>
$(document).ready(function(){
   $('#plist').dataTable();

});
</script>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">

          <li class="active">
					   <?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Income'),array('controller'=>'Income','action' => 'viewincome'),array('escape' => false));
					   	?>
					</li>

				<li class="">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Income'),array('controller'=>'Income','action' => 'addincome'),array('escape' => false));
						?>
        </li>
		<li class="">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Monthly Income'),array('controller'=>'Income','action' => 'monthincome'),array('escape' => false));
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
						<th><?php echo __('Customer Name');?></th>
						<th><?php echo __('Status');?></th>
						<th><?php echo __('Date');?></th>
            			<th><?php echo __('Main Label');?></th>
            			
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
            			<th><?php echo __('Customer Name');?></th>
						<th><?php echo __('Status');?></th>
						<th><?php echo __('Date');?></th>
            			<th><?php echo __('Main Label');?></th>
            			
						<th><?php echo __('Action');?></th>
					</tr>
				</tfoot>
				<tbody>


          <?php
            if($incomelist){
              foreach($incomelist as $income_row){
                ?>

                <tr>
                          <td><?php echo $this->AMC->getuser_name($income_row['customer_id']);?></td>     
                              <td><?php
                        if($income_row['status'] == 0){
                            echo '<span class="label label-info">UnPaid</span>';
                        }else if($income_row['status'] == 1){
                            echo '<span class="label label-success">Paid</span>';
                        }else if($income_row['status'] == 2){
                            echo '<span class="label label-warning">Partially Paid</span>';
                        }
                                  
                                  ?></td>
                              <td><?php echo date($this->Amc->getDateFormat(),strtotime($income_row['date'])); ?></td>
                              <td><?php echo $income_row['main_label']; ?></td>
                              
                             
                  <td>
                  <?php echo $this->Html->link(__('Edit'),array('action' => 'updateincome',$income_row['income_id']),array('class'=>'btn btn-info'))."&nbsp;".$this->Html->link(__('Delete'),array('action' => 'delete',$income_row['income_id']),['confirm'=>__('Are you sure you wish to Delete this Record?'),'class'=>'btn btn-danger']); ?></td>
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
