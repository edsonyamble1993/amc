



<?php

use Cake\Routing\Router;
$action = $this->request->params['action'];

?>
<div class="row panel-body">
				<ul role="tablist" class="nav nav-tabs panel_tabs">

                       <li class="">

<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Amc List'),
array('controller'=>'Amc','action' => 'amclist'),array('escape' => false));
						?>
					  </li>

					  <li class="<?php echo $action=='addamc'?'active':''?>">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Amc Service'),array('controller'=>'Amc','action' => 'addamc'),array('escape' => false));
						?>

					  </li>
						
				</ul>

<script>
$(function(){

	jQuery('#date,#start_date,#close_date').datepicker({
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



          <?php echo $this->Form->Create('form1',['id'=>'client_form','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'']]);?>





				<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Customer Name'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'','value'=>'','class'=>'form-control','readonly'));?>
						</div>

						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Amc Code'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'reference_no','value'=>'','class'=>'form-control','placeholder'=>__('')));?>
						</div>

				</div>


				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Service Date'));?></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'date','value'=>'','id'=>'date','class'=>'form-control','placeholder'=>__('Date')));?>
							</div>

							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Assign_to:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'contact_person','value'=>'','class'=>'form-control validate[required]','placeholder'=>__('')));?>
							</div>

				</div>


				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Chargeable'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">

							<select class="form-control" id="customer" name="customer_id">
								<option value="0"><?php echo __('No');?></option>
								<option value="1"><?php echo __('Yes');?></option>

							</select>

							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Assign Date:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'mobile','value'=>'','id'=>'mobile','class'=>'form-control validate[required]','placeholder'=>__('Enter Mobile Number')));?>
							</div>
				</div>

				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Close Date'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'email','value'=>'','id'=>'close_date','class'=>'form-control validate[required]','placeholder'=>__('Enter Email')));?>

							</div>

							<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('Status'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php
								$status_array=array(
									0 => __('Open'),
									1 => __('Close'),
									2 => __('In-Progress')
									);
							?>
							<select name="status">
									<?php foreach($status_array as $status_key => $status_val){ ?>
									<option value="<?php echo $status_key;?>"><?php echo $status_val;?><option>
										<?php } ?>
							</select>


						</div>
				</div>


<div class="form-group">
			<div class="col-sm-2 label_right">
				<?php echo $this->Form->label(__('Amc Warranty'));?> <span class="require-field">*</span>
			</div>
			<div class="col-sm-4">
				<select class="form-control" name="amc_warranty">
					<option><?php echo __('--AMC Warranty--'); ?></option>

						<?php if(isset($warranty_data)){
								foreach($warranty_data as $warranty_info){
							?>
							<option value="<?php echo $warranty_info['warranty_id']; ?>"><?php echo $warranty_info['years']; ?><?php echo __(' Years')?></option>
							<?php
							 }
							}
							?>
				</select>

			</div>

			<div class="col-sm-2 label_right">
				<?php echo $this->Form->label(__('Status'));?> <span class="require-field">*</span>
			</div>
			<div class="col-sm-4">
				<?php echo $this->Form->input('',array('name'=>'status','value'=>$status,'id'=>'status','class'=>'form-control validate[required]','placeholder'=>__(''),'readonly'));?>
			</div>


</div>


<div class="form-group">
			<div class="col-sm-2 label_right">
				<?php echo $this->Form->label(__('Max Free Service'));?> <span class="require-field">*</span>
			</div>
			<div class="col-sm-4">

<?php echo $this->Form->input('',array('name'=>'service','value'=>$service,'id'=>'','class'=>'form-control validate[required]','placeholder'=>__('')));?>
			</div>

			<div class="col-sm-2 label_right">
				<?php echo $this->Form->label(__('Product Details'));?> <span class="require-field">*</span>
			</div>
			<div class="col-sm-4">
				<?php echo $this->Form->input('',array('name'=>'product_details','value'=>$product_details,'id'=>'status','class'=>'form-control validate[required]','placeholder'=>__('')));?>
			</div>
</div>


<div class="form-group">

			<div class="col-sm-2 label_right">
				<?php echo $this->Form->label(__('Is Decline'));?> <span class="require-field">*</span>
			</div>
			<div class="col-sm-4">
				<?php echo $this->Form->checkbox('',array('value'=>'1','name'=>'is_decline','checked'=>$chk)); ?>
			</div>
	<div class="col-sm-2 label_right">
				<?php echo $this->Form->label(__('Attachment'));?> <span class="require-field">*</span>
			</div>
			<div class="col-sm-4">
			<?php echo $this->Form->input('',array('name'=>'attachment','type'=>'file','id'=>'file-0a','class'=>'form-control file'));?>
			<?php echo $this->Form->input('',array('type'=>'hidden','value'=>$img_name,'name'=>'attach2'));?>
			</div>

</div>



<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Subject'));?> <span class="require-field">*</span>
						</div>

						<div class="col-sm-4">
							<?php echo $this->Form->textarea('',array('name'=>'subject','value'=>$subject,'class'=>'form-control validate[required]'));?>
						</div>


						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Billing Address'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->textarea('',array('name'=>'address','value'=>$address,'id'=>'address','class'=>'form-control validate[required]'));?>
						</div>

			</div>

				 <div class="header">
          		<h3><?php echo __('Amc Details'); ?></h3>
          </div>

		  <button type="button" id="add_newrow" class="btn btn-default" style="margin:5px 0px;">Add New </button>






			<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
							<?php echo $this->Form->input(__('Save'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
							</div>
				</div>
			<?php $this->Form->end(); ?>

</div>


<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#pdate').datepicker({
		 changeMonth: true,
      changeYear: true,
	  dateFormat: "yy-mm-dd"
	});

	jQuery('#inventory_form').validationEngine();

	/*----*/


});






</script>
