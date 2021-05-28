
<?php
//debug($action);die;
$supplider_no=isset($supplier_update)?$supplier_update['supplier_code']:$supplier_idf;
$first_name=isset($supplier_update)?$supplier_update['first_name']:'';
$middle_name=isset($supplier_update)?$supplier_update['middle_name']:'';
$last_name=isset($supplier_update)?$supplier_update['last_name']:'';
$email=isset($supplier_update)?$supplier_update['email']:'';
$address=isset($supplier_update)?$supplier_update['address']:'';
$btn_name=(isset($supplier_update))?'Edit Supplier':'Add Supplier';
$mobile_no=isset($supplier_update)?$supplier_update['mobile_no']:'';
$account_number=isset($supplier_update)?$supplier_update['account_number']:'';
$ifs_code=isset($supplier_update)?$supplier_update['ifs_code']:'';
$branch_name=isset($supplier_update)?$supplier_update['branch_name']:'';
$tin_no=isset($supplier_update)?$supplier_update['tin_no']:'';
$cst_no=isset($supplier_update)?$supplier_update['cst_no']:'';
$pan_no=isset($supplier_update)?$supplier_update['pan_no']:'';
$address_line = isset($supplier_update)?$supplier_update['address_line']:'';
$supplier_company=isset($supplier_update)?$supplier_update['supplier_company']:'';
$city=isset($supplier_update)?$supplier_update['city']:'';
$state=isset($supplier_update)?$supplier_update['state']:'';
$country=isset($supplier_update)?$supplier_update['country']:'';
$zip_code=isset($supplier_update)?$supplier_update['zip_code']:'';
$bank_name=isset($supplier_update)?$supplier_update['bank_name']:'';
$swift_code=isset($supplier_update)?$supplier_update['swift_code']:'';
$branch_code=isset($supplier_update)?$supplier_update['branch_code']:'';
$international_bank_code=isset($supplier_update)?$supplier_update['international_bank_code']:'';
$national_bank_code=isset($supplier_update)?$supplier_update['national_bank_code']:'';
use Cake\Routing\Router;
$action = $this->request->params['action'];

?>
<div class="row panel-body">
				<ul role="tablist" class="nav nav-tabs panel_tabs">

                       <li class="">

<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Suppliers'),
array('controller'=>'Supplier','action' => 'suppliers'),array('escape' => false));
						?>
					  </li>

					  <li class="<?php echo $action=='supplier'?'active':''?>">
<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__($btn_name),array(),array('escape' => false));
						?>

					</li>
				</ul>


    
<style type="text/css">
#client_form{
	margin-top:25px;
}
</style>

					 

          <?php echo $this->Form->Create('form1',['id'=>'client_form','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'']]);?>



				<div class="form-group">
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Supplier No'));?> <span class="require-field">*</span>
						</div>

						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'supplier_no','value'=>$supplider_no,'class'=>'form-control','readonly','required'=>"required"));?>
						</div>


						<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('First Name'));?> <span class="require-field">*</span>
						</div>
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'first_name','value'=>$first_name,'id'=>'','class'=>'form-control','placeholder'=>__('First Name'),'required'=>'required'));?>
						   </div>
				</div>


				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Last Name'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'last_name','value'=>$last_name,'id'=>'','class'=>'form-control','placeholder'=>__('Last Name'),'required'=>'required'));?>
							</div>

							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Middle Name:'));?></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'middle_name','value'=>$middle_name,'class'=>'form-control','placeholder'=>__('Middle Name')));?>
							</div>

				</div>


				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Email'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
<?php echo $this->Form->email('',array('name'=>'email','value'=>$email,'id'=>'','class'=>'form-control','placeholder'=>__('Email'),'required'=>'required'));?>
							</div>

							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Address:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'address','value'=>$address,'class'=>'form-control','placeholder'=>__('Address'),'required'=>'required'));?>
							</div>

				</div>


				<div class="form-group">
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Photo'));?></div>

							<div class="col-sm-4">

								<?php 
								if(isset($supplier_update)){
										echo '<br>';
									echo $this->Html->image('user/'.$supplier_update['photo'], ['class' => 'img-thumbnail avatar','id'=>'profileimg','width'=>'150','height'=>'150']); 
									echo '<br><br>';
			                       echo $this->Form->hidden('',array('name'=>'old_image','value'=>$supplier_update['photo']));
								}
								


								?>
<div class="cropme" style="width: 220px; height: 200px;"></div>
      <script>
        // Init Simple Cropper
        $('.cropme').simpleCropper();
		$('.ok').click(function(){
		var data = $('.cropme').find('img').attr('src');
		console.log(data);
		$('.imagedata').val(data);
		});	
		
      </script>
						 <input type="hidden" class="imagedata" name="client_image">
						 <input type="hidden" class="originaladdedimage" value="" name="originaladdedimage">
               			</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Address line 1:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'address_line','value'=>$address_line,'class'=>'form-control','placeholder'=>__('Address line 1:'),'required'=>'required'));?>
							</div>

				</div>
				
<div class="form-group">
							

               
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Company Name:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'supplier_company','value'=>$supplier_company,'class'=>'form-control','placeholder'=>__('Company Name'),'required'=>'required'));?>
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('City:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'city','value'=>$city,'class'=>'form-control','placeholder'=>__('City Name'),'required'=>'required'));?>
							</div>

				</div>
				<div class="form-group">
							

               
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('State:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'state','value'=>$state,'class'=>'form-control','placeholder'=>__('State'),'required'=>'required'));?>
							</div>
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Country:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'country','value'=>$country,'class'=>'form-control','placeholder'=>__('Country'),'required'=>'required'));?>
							</div>

				</div>
				<div class="form-group">
							

               
							<div class="col-sm-2 label_right"><?php echo $this->Form->label(__('Zip Code:'));?><span class="require-field">*</span></div>

							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'zip_code','value'=>$zip_code,'class'=>'form-control','placeholder'=>__('Zip Code'),'required'=>'required'));?>
							</div>
							

				</div>


<div class="header panel-body">
          		<h3><?php echo __('Account Details'); ?></h3>
          </div>
			<div class="form-group">
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Mobile Number'));?> <span class="require-field">*</span>
						</div>
					
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'mobile_no','value'=>$mobile_no,'class'=>'form-control validate[required]','placeholder'=>__('Mobile Number'),'required'=>'required'));?>
						</div>
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Account Number'));?> <span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'account_number','value'=>$account_number,'class'=>'form-control validate[required]','placeholder'=>__('Account Number'),'required'=>'required'));?>
						</div>
						
						
						</div>	
						<div class="form-group">
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Bank Name'));?><span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'bank_name','value'=>$bank_name,'class'=>'form-control validate[required]','placeholder'=>__('Bank Name'),'required'=>'required'));?>
						</div>
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Branch Name'));?><span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'branch_name','value'=>$branch_name,'class'=>'form-control validate[required]','placeholder'=>__('Branch Name'),'required'=>'required'));?>
						</div>
						
						</div>	
						
						<div class="form-group">
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Swift Code'));?><span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'swift_code','value'=>$swift_code,'class'=>'form-control validate[required]','placeholder'=>__('Swift Code'),'required'=>'required'));?>
						</div>
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('Branch Code'));?><span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'branch_code','value'=>$branch_code,'class'=>'form-control validate[required]','placeholder'=>__('Branch Code'),'required'=>'required'));?>
						</div>
						
						</div>
						
						<div class="form-group">
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('International Bank Code'));?><span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'international_bank_code','value'=>$international_bank_code,'class'=>'form-control validate[required]','placeholder'=>__('International Bank Code'),'required'=>'required'));?>
						</div>
						
						<div class="col-sm-2 label_right">
						<?php echo $this->Form->label(__('National Bank Code'));?><span class="require-field">*</span>
						</div>
						<div class="col-sm-4">
							<?php echo $this->Form->input('',array('name'=>'national_bank_code','value'=>$national_bank_code,'class'=>'form-control validate[required]','placeholder'=>__('National Bank Code'),'required'=>'required'));?>
						</div>
						
						</div>
						
						<!--<div class="form-group">
							<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('PAN No'));?> <span class="require-field">*</span>
							
							</div>
						
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'pan_no','value'=>$pan_no,'class'=>'form-control validate[required]','placeholder'=>__('PAN No'),'required'=>'required'));?>
							</div>
							<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('IFS code'));?> <span class="require-field">*</span>
							</div>
						
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'ifs_code','value'=>$ifs_code,'class'=>'form-control validate[required]','placeholder'=>__('IFS Code'),'required'=>'required'));?>
							</div>
						
						</div>
						<div class="form-group">
						
							<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('TIN No'));?> <span class="require-field">*</span>
							
							</div>
						
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'tin_no','value'=>$tin_no,'class'=>'form-control validate[required]','placeholder'=>__('TIN No'),'required'=>'required'));?>
							</div>
							
							<div class="col-sm-2 label_right">
							<?php echo $this->Form->label(__('CST No'));?> <span class="require-field">*</span>
							</div>
							<div class="col-sm-4">
								<?php echo $this->Form->input('',array('name'=>'cst_no','value'=>$cst_no,'class'=>'form-control validate[required]','placeholder'=>__('CST No'),'required'=>'required'));?>
							</div>
						</div>	-->
							
						<?php 
						if($action_a == 'add')
						{
							if(isset($code_data) && !empty($code_data))
							{
								foreach($code_data as $code)
								{
						?>
							<div class="form-group">
								<div class="col-sm-2 label_right">
								<?php echo $this->Form->label($code['code_title']);?><span class="require-field">*</span>
								<input type="hidden" value="<?php echo $code['code_id'] ?>" name="code[code_id][]">
								</div>
								<div class="col-sm-4">
									<?php echo $this->Form->input('',array('name'=>'code[detail][]','value'=>'','class'=>'form-control validate[required]','placeholder'=>__($code['code_title']),'required'=>'required'));?>
								</div>
							</div>
						<?php
								}
							}
						}
						else 
						{
							if(isset($code_data) && !empty($code_data))
							{
								foreach($code_data as $code)
								{
						?>
							<div class="form-group">
								<div class="col-sm-2 label_right">
								<?php echo $this->Form->label($code['code_title']);?><span class="require-field">*</span>
								<input type="hidden" value="<?php echo $code['code_id'] ?>" name="code[code_id][]">
								</div>
								<div class="col-sm-4">
									<?php echo $this->Form->input('',array('name'=>'code[detail][]','value'=>$this->Amc->get_supplier_international_detail($supplier_id,$code['code_id']),'class'=>'form-control validate[required]','placeholder'=>__($code['code_title']),'required'=>'required'));?>
								</div>
							</div>
						<?php
								}
							}
						}
						?>
						
			<div class="form-group">
							<div class="col-sm-2"><?php echo $this->Form->label('');?></div>
							<div class="col-sm-offset-2 col-sm-10">
							<?php echo $this->Form->input(__('Save'),array('type'=>'submit','name'=>'add','class'=>'btn btn-success'));?>
							</div>
			</div>

			<?php $this->Form->end(); ?>

</div>



