<div class="row panel-body">
<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">

          <li class="">
					   <?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Expenses'),array('controller'=>'Expenses','action' => 'viewexpenses'),array('escape' => false));
					   	?>
					</li>

				<li class="">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Expenses'),array('controller'=>'Expenses','action' => 'addexpenses'),array('escape' => false));
						?>
        </li>
		<li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Monthly Expenses'),array('controller'=>'Expenses','action' => 'monthlyexpenses'),array('escape' => false));
						?>
        </li>

				</ul>
</div>
<form method="post" accept-charset="utf-8" id="client_form" class="form_horizontal formsize" enctype="multipart/form-data" action="<?php echo $this->Url->build(array('controller'=>'Expenses','action'=>'monthlyexpenses'))?>">
					<div class="header">
						<h3><?php echo __('Monthly Expenses'); ?></h3>
					</div><br/><br/>
					<div class="form-group start_end_date">
					<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Start Date'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
						<input type="text" name="start_date" id="start_date" class="form-control validate[required]" required="required" value="<?php if(isset($start_date)){ echo $start_date; }else{  echo date('Y-m-d'); } ?>">
							</div>
						
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('End Date'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
						<input type="text" name="end_date" id="enddate_select" class="form-control validate[required]" required="required" value="<?php if(isset($end_date)){ echo $end_date; }else{ echo date('Y-m-d',strtotime('-1 month')); } ?>">
							</div>

			</div>
			<div class="form-group">
							
							<div class="col-sm-offset-2 col-sm-10">
							<div class="submit"><input type="submit" name="add" class="btn btn-success" id="save" value="Go"></div>							</div>
				</div>
</form>
<?php 
if(!empty($request_list))
{ 
?>
<hr>
<div id="print_tab">
<table width="100%" border="0">
			<tbody>
				<tr>
					<td width="75%">
						<img style="max-height:80px;" src="../img/setting/logo.png">
					</td>
					<td align="left" width="25%">
						<h5>Start Date <?php echo $start_date; ?></h5>
						<h5>End Date <?php echo $end_date; ?></h5>
						
					</td>
				</tr>
			</tbody>
		</table>
<hr>
	<div class=" col-sm-12">
<table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
		<thead>
				<tr>
					<th class="text-center">No</th>
					<th class="text-center">Expenses Label</th>
					<th class="text-center">date</th>
					<th class="text-center">Expenses</th>
				</tr>
			</thead>
			<tbody>
			<?php $i = 1; $grandtotal = 0; foreach($request_list as $request_lists){ ?>
								<tr>
					<td class="text-center"><?php echo $i; ?></td>
					<td class="text-center"><?php echo $request_lists['main_label']; ?></td>
					<td class="text-center"><?php echo $request_lists['date']; ?></td>
					<td class="text-center"><?php echo $this->AMC->gettotalexpenses($request_lists['expenses_id']);?></td>
					<?php $grandtotal +=  $this->AMC->gettotalexpenses($request_lists['expenses_id']); ?>
					</tr>
					
			<?php $i++; } ?>		
					
		  			</tbody>
			
		</table>
		<table class="table" style="border:1px solid #ddd" width="100%">
			<tbody><tr>
				
				<td colspan="2" class="text-right" align="right">Grand Total: &nbsp; &nbsp;<?php echo $grandtotal; ?></td>
			
			</tr>
	
		</tbody></table>
		</div>
</div>
<div class="col-sm-12">
<button type="button" class="btn btn-success" id="" onclick="printDiv()">Print </button>
</div>
<?php }
?>
</div>
<script>
function printDiv() 
{

  var divToPrint=document.getElementById('print_tab');

  var newWin=window.open('','Print-Window');

  newWin.document.open();

  newWin.document.write('<html><body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');

  newWin.document.close();

  setTimeout(function(){newWin.close();},10);

}

$(function(){

	jQuery('#date,#start_date,#enddate_select').datepicker({
		dateFormat: "yy-mm-dd",
		  changeMonth: true,
	        changeYear: true,
	        yearRange:'-65:+0',
	             
                });


		
	});
</script>