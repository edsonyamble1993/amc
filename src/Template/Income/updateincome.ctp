<?php

$supplier_name=(isset($update_row))?$update_row['supplier_name']:'';
$date=(isset($update_row))?date($this->Amc->getDateFormat(),strtotime($update_row['date'])):'';
$reference_no=(isset($update_row))?$update_row['reference_no']:'';
$main_label=(isset($update_row))?$update_row['main_label']:'';




 ?>

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
								<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) . __('View Income'),array('controller'=>'Income','action' => 'viewincome'),array('escape' => false));
								?>
					  </li>

					  <li class="active">
							<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Edit Income'),array(),array('escape' => false));
							?>
					  </li>
				</ul>
</div>

<div class="row">
		<div class="panel-body">
			<?php echo $this->Form->Create('form1',['id'=>'formID','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'addexpense']]);?>


				

				<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label(__('Status : '));?><span class="require-field">*</span></div>

							<div class="col-sm-10">
                <select name="status" class="form-control">
                  <option><?php echo __('-- Select Status --');?></option>
                    <?php
                      $option_status=array(
                                           0=>__('UnPaid'),
                                           1=>__('Paid'),
                                           2=>__('Partially Paid')
                                         );

                    ?>
                    <?php
                      if($option_status){
                      foreach($option_status as $key_status=>$value_status){
                    ?>
                    <option value="<?php echo $key_status; ?>" <?php
                        if($update_row['status'] == $key_status){
                          echo 'selected="selected"';
                        }
                    ?> ><?php echo $value_status; ?></option>
                    <?php
                   }
                  }
                  ?>
                </select>

						 </div>
				</div>



				<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label(__('Date : '));?><span class="require-field">*</span></div>
							<div class="col-sm-10">
								<?php //echo $this->Form->input('',array('name'=>'date','id'=>'date','value'=>$date,'type'=>'text','class'=>'form-control validate[required]','PlaceHolder'=>'Enter Date','required'=>'required'));?>
								<input type="date" name="date" class="form-control validate[required]" placeholder="Date" value="<?php echo date("Y-m-d",strtotime($date)); ?>" required="required" id="">
							</div>
				</div>

<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label(__('Main Label: '));?><span class="require-field">*</span></div>
							<div class="col-sm-10">
								<?php echo $this->Form->input('',array('name'=>'main_label','value'=>$main_label,'type'=>'text','class'=>'form-control validate[required]','PlaceHolder'=>'Main Label','required'=>'required'));?>
							</div>
				</div>
			

            <div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label(__('Customer Name : '));?><span class="require-field">*</span></div>
							<div class="col-sm-10">
									<select class="form-control" name="customer_id" required="required">
											<option value=""><?php echo __('--Select Customer--'); ?></option>
											<?php
												if(isset($clientlist)){
														foreach($clientlist as $client_row){
														?>
															<option value="<?php echo $client_row['user_id'];?>" <?php

                                if($client_row['user_id'] == $update_row['customer_id']){
                                  echo 'selected="selected"';
                                }

                              ?> ><?php echo $client_row['first_name'].' '.$client_row['last_name']; ?></option>
														<?php
														}
												}

											 ?>
									</select>
							</div>
				</div>




				<hr style="float:left;width:100%">

        <?php

        if(isset($expensesdata)){

         
            foreach($expensesdata as $total){
                //$amount[]=$total->amount;

        ?>
        <div id="custom_label" class="remove_id_<?php echo $total->id; ?>">
		
          <div class="form-group">
          <label class="col-sm-2 control-label" for="income_entry"><?php echo __('Income Entry');?></label>
          <div class="col-sm-3">
            <input id="income_amount" class="form-control text-input" type="text" value="<?php echo $total->income_amount; ?>" name="custom_label[]" placeholder="Expense Amount">
          </div>
          <div class="col-sm-5">
            <input id="income_entry" class="form-control text-input" type="text" value="<?php echo $total->label_income ; ?>" name="custom_value[]" placeholder="Expense Entry Label">
          </div>
          <div class="col-sm-2">
          <button type="button" class="btn btn-primary delete_product" deleteid="<?php echo $total->id ?>" onclick="deleteParentElement(this)" style="margin-top:0;">
          <i class="entypo-trash " ><?php echo __('Delete');?></i>
          </button>
          </div>
          </div>
	
        </div>
		
			<?php  
		}
		}
		?>


<div id="custom_label_update">
						<div class="form-group">
						<label class="col-sm-2 control-label" for="income_entry"><?php echo __('Income Entry');?></label>
						<div class="col-sm-3">
							<input id="income_amount_update" class="form-control text-input" type="text" value="" name="custom_label[]" placeholder="Expense Amount">
						</div>
						<div class="col-sm-5">
							<input id="income_entry_update" class="form-control text-input" type="text" value="" name="custom_value[]" placeholder="Expense Entry Label">
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

							<?php echo $this->Form->input(__('Update Income'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
							</div>
				</div>
			<?php $this->Form->end(); ?>

		</div>
</div>


<script>

   	// CREATING BLANK INVOICE ENTRY
   	var blank_income_entry ='';
   	$(document).ready(function() {
   		blank_income_entry = $('#invoice_entry_update').html();

   	});

	var blank_custom_label ='';
   	$(document).ready(function() {
   		blank_custom_label = $('#custom_label_update').html();

   	});

   	function add_entry()
   	{
   		$("#invoice_entry_update").append(blank_income_entry);

   	}

	function add_custom_label()
   	{
   		$("#custom_label_update").append(blank_custom_label);

   	}

   	// REMOVING INVOICE ENTRY
   	function deleteParentElement(n){
   		n.parentNode.parentNode.parentNode.removeChild(n.parentNode.parentNode);
   	}
</script>
