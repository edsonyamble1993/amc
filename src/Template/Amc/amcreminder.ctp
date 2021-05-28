<script>
$(document).ready(function(){
   $('#plist').dataTable();

});
</script>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">

                    <li class="">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Amc'),array('controller'=>'Amc','action' => 'viewamc'),array('escape' => false));
						?>
					  </li>

					   <li class="">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Amc'),array('controller'=>'Amc','action' => 'addamc'),array('escape' => false));
						?>
					  </li>

            <li class="active">
         <?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Amc Reminder'),array('controller'=>'Amc','action' => 'amcreminder'),array('escape' => false));
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
						<th><?php echo __('Amc Code');?></th>
						<th><?php echo __('Client Name');?></th>
						<th><?php echo __('Contact Person');?></th>
            <th><?php echo __('Mobile Number');?></th>
            <th><?php echo __('Email');?></th>
						<th><?php echo __('Day Remaining');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
            <th><?php echo __('Amc Code');?></th>
            <th><?php echo __('Client Name');?></th>
            <th><?php echo __('Contact Person');?></th>
            <th><?php echo __('Mobile Number');?></th>
            <th><?php echo __('Email');?></th>
            <th><?php echo __('Day Remaining');?></th>
					</tr>
				</tfoot>
				<tbody>
          <?php
            if(isset($amclist)){
              foreach($amclist as $amc_row){

          ?>
          	<tr>

            <td><?php echo $amc_row['amc_no']; ?></td>
            <td><?php echo $this->AMC->getuser_name($amc_row['customer_id']);?></td>
            <td><?php echo $amc_row['contact_person'];?></td>
            <td><?php echo $amc_row['mobile'];?></td>
            <td><?php echo $amc_row['email'];?></td>
			<td><?php 
				$start_date=date($this->Amc->getDateFormat(),strtotime($amc_row['end_date']));
				$today_date=date($this->Amc->getDateFormat());
					

				$days = (strtotime($start_date) - strtotime($today_date)) / (60 * 60 * 24);

					echo $days.__(' days');

			 ?></td>
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
