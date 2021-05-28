
<script>
$(function(){

	jQuery('#date').datepicker({
		dateFormat: "yy-mm-dd",
		  changeMonth: true,
	        changeYear: true,
	        yearRange:'-65:+0',
	        onChangeMonthYear: function(year, month, inst) {
	            jQuery(this).val(month + "-" + year);
	        }

                });
});
	</script>





<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					  <li class="">
								<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) . __('View Expenses'),array('controller'=>'Expenses','action' => 'viewexpenses'),array('escape' => false));
								?>
					  </li>

					 
					  <li class="active">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Expenses'),array(),array('escape' => false));
						?>

					  </li>
					  <li class="">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Monthly Expenses'),array('controller'=>'Expenses','action' => 'monthlyexpenses'),array('escape' => false));
						?>
        </li>
				</ul>
</div>

<div class="row">
		<div class="panel-body">
			<?php echo $this->Form->Create('form1',['id'=>'formID','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'addexpense']]);?>


				


				


<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label(__('Main Label: '));?><span class="require-field">*</span></div>
							<div class="col-sm-10">
								<?php echo $this->Form->input('',array('name'=>'main_label','value'=>'','type'=>'text','class'=>'form-control validate[required]','PlaceHolder'=>'Main Label:','required'=>'required'));?>
							</div>
				</div>
				<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label(__('Date : '));?><span class="require-field">*</span></div>
							<div class="col-sm-10">
								<?php //echo $this->Form->input('',array('name'=>'date','id'=>'date','value'=>'','type'=>'text','class'=>'form-control validate[required]','PlaceHolder'=>'Enter Date','required'=>'required'));?>
								<input type="date" name="date" class="form-control validate[required]" placeholder="Date" value="<?php echo date("Y-m-d"); ?>" required="required" id="">
							</div>
				</div>

<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label(__('Status : '));?><span class="require-field">*</span></div>

							<div class="col-sm-10">
							
							
							<select name="status" class="form-control" required="required">
                  <option value="">-- Select Status --</option>
                                         <option value="0" >UnPaid</option>
                                        <option value="1" >Paid</option>
                                        <option value="2" >Partially Paid</option>
                                    </select>
							</div>
				</div>

				<hr style="float:left;width:100%">


				<div id="custom_label">
						<div class="form-group">
						<label class="col-sm-2 control-label" for="income_entry"><?php echo __('Expenses Entry');?></label>
						<div class="col-sm-3">
							<input id="income_amount" class="form-control text-input" type="text" value="" name="custom_label[]" placeholder="Expense Amount" required>
						</div>
						<div class="col-sm-5">
							<input id="income_entry" class="form-control text-input" type="text" value="" name="custom_value[]" placeholder="Expense Entry Label" required>
						</div>
						<div class="col-sm-2">
						<button type="button" class="btn btn-primary" onclick="deleteParentElement(this)" style="margin-top:0;">
						<i class="entypo-trash"><?php echo __('Delete');?></i>
						</button>
						</div>
						</div>
					</div>


					<div class="form-group">
			<label class="col-sm-2 control-label" for="income_entry"></label>
			<div class="col-sm-3">
				<button id="add_new_entry" class="btn btn-primary btn-sm btn-icon icon-left" type="button"   name="add_new_entry" onclick="add_custom_label()"><?php echo __('Add More Field'); ?>
				</button>
			</div>

		</div>


				<hr style="float:left;width:100%">

				<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">

							<?php echo $this->Form->input('Create Expense Entry',array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
							</div>
				</div>
			<?php $this->Form->end(); ?>

		</div>
</div>


<script>

   	// CREATING BLANK INVOICE ENTRY
   	var blank_income_entry ='';
   	$(document).ready(function() {
   		blank_income_entry = $('#invoice_entry').html();

   	});

	var blank_custom_label ='';
   	$(document).ready(function() {
   		blank_custom_label = $('#custom_label').html();

   	});

   	function add_entry()
   	{
   		$("#invoice_entry").append(blank_income_entry);

   	}

	function add_custom_label()
   	{
   		$("#custom_label").append(blank_custom_label);

   	}

   	// REMOVING INVOICE ENTRY
   	function deleteParentElement(n){
   		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
   	}
</script>
