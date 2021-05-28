<?php

$supplier_name=(isset($update_row))?$update_row['supplier_name']:'';
$date=(isset($update_row))?date($this->Amc->getDateFormat(),strtotime($update_row['date'])):'';
$reference_no=(isset($update_row))?$update_row['reference_no']:'';




 ?>
<?php 

use Cake\Routing\Router;
$action = $this->request->params['action'];

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
								<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) . __('View Expenses'),array('controller'=>'Expenses','action' => 'viewexpenses'),array('escape' => false));
								?>
					  </li>

					  <li class="active">
							<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Edit Expenses'),array(),array('escape' => false));
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
								<?php echo $this->Form->input('',array('name'=>'main_label','value'=>'','type'=>'text','class'=>'form-control validate[required]','PlaceHolder'=>'Main Label','value'=>$update_row['main_label'],'required'=>'required'));?>
							</div>
				</div>
				<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label(__('Date : '));?><span class="require-field">*</span></div>
							<div class="col-sm-10">
								<?php //echo $this->Form->input('',array('name'=>'date','id'=>'date','value'=>$date,'type'=>'text','class'=>'form-control validate[required]','PlaceHolder'=>'Enter Date',"required"=>'required'));?>
								<input type="date" name="date" class="form-control validate[required]" placeholder="Date" value="<?php echo date("Y-m-d",strtotime($date)); ?>" required="required" id="">
							</div>
				</div>
				<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label(__('Status : '));?><span class="require-field">*</span></div>

							<div class="col-sm-10">
							
							
							<select name="status" class="form-control" required="required">
                  <option value="">-- Select Status --</option>
                                         <option value="0" <?php if($update_row['status']== 0){ echo 'selected'; } ?> >UnPaid</option>
                                        <option value="1" <?php if($update_row['status']== 1){ echo 'selected'; } ?>>Paid</option>
                                        <option value="2" <?php if($update_row['status']== 2){ echo 'selected'; } ?>>Partially Paid</option>
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
            <input id="income_amount" class="form-control text-input" type="text" value="<?php echo $total->expense_amount; ?>" name="custom_label[]" placeholder="Expense Amount">
          </div>
          <div class="col-sm-5">
            <input id="income_entry" class="form-control text-input" type="text" value="<?php echo $total->label_expense ; ?>" name="custom_value[]" placeholder="Expense Entry Label">
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
						<button type="button" class="btn btn-primary"  style="margin-top:0;">
						<i class="entypo-trash"  ><?php echo __('Delete');?></i>
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

							<?php echo $this->Form->input(__('Update Expense'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
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
// REMOVING INVOICE ENTRY
   	
	var blank_custom_label ='';
   	$(document).ready(function() {
   		blank_custom_label = $('#custom_label_update').html();

   	});
	$(document).ready(function() {
	$('body').on('click','.delete_product',function(){
		
		var row_id = $(this).attr('deleteid');
        $.ajax({
                 type: 'POST',
                      url: '<?php echo Router::url(["controller" => "Ajax","action" => "removeexpenseshistorydata"]);?>',
                     data : {product_history_id:row_id},
                     success: function (response){
                           
                       $(".remove_id_"+row_id).remove();    
                        
						},
                    error: function(e) {
                        alert("An error occurred: " + e.responseText);
                    console.log(e);
                }
            
            
            
        });
        
	});
	});

   	function add_entry()
   	{
   		$("#invoice_entry_update").append(blank_income_entry);

   	}

	function add_custom_label()
   	{
   		$("#custom_label_update").append(blank_custom_label);

   	}

   	
</script>
