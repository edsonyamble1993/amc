<style>
footer {
  position: absolute;
  right: 0;
  bottom: -35px;
  left: 0;
  padding: 1rem;
  background-color: #F1F4F9;
  text-align: center;
}
</style>
<script>
$(document).ready(function(){
   $('#plist').dataTable();

});
</script>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">

          <li class="active">
					   <?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Expenses'),array('controller'=>'Expenses','action' => 'viewexpenses'),array('escape' => false));
					   	?>
					</li>

				<li class="">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Expenses'),array('controller'=>'Expenses','action' => 'addexpenses'),array('escape' => false));
						?>
        </li>
		<li class="">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Monthly Expenses'),array('controller'=>'Expenses','action' => 'monthlyexpenses'),array('escape' => false));
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
						<th><?php echo __('Label Of Expenses');?></th>
						<th><?php echo __('Status');?></th>
						<th><?php echo __('Date');?></th>
						
          
           
           
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('Label Of Expenses');?></th>
						<th><?php echo __('Status');?></th>
						<th><?php echo __('Date');?></th>
            
           
						<th><?php echo __('Action');?></th>
					</tr>
				</tfoot>
				<tbody>


          <?php
            if($expenseslist){
              foreach($expenseslist as $expenses_row){
                ?>

                <tr>
				
                               <td><?php echo $expenses_row['main_label']; ?></td>
                              <td>
							  <?php 
	     						  if( $expenses_row['status'] == 1){
									echo '<span class="label label-success">Paid</span>';
								  }else if($expenses_row['status'] == 2){
									echo '<span class="label label-info">Part Paid</span>';
								  }else if($expenses_row['status'] == 0){
							 	  echo '<span class="label label-warning">Unpaid</span>';
								  }
								  
								  ?></td>
                              <td><?php echo date($this->Amc->getDateFormat(),strtotime($expenses_row['date'])); ?></td>
                             
                              
                             

                  <td>
                  <?php echo $this->Html->link(__('Edit'),array('action' => 'updateexpenses',$expenses_row['expenses_id']),array('class'=>'btn btn-info'))."&nbsp;".$this->Html->link(__('Delete'),array('action' => 'delete',$expenses_row['expenses_id']),['confirm'=>__('Are you sure you wish to Delete this Record?'),'class'=>'btn btn-danger']); ?></td>
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
