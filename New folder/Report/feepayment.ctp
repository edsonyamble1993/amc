<script>

$(document).ready(function(){
  $('#examlist').DataTable();
$('#class_id').change(function(){
   var cl_id=$(this).val();
		 $.ajax({

				type:'POST',
			 url:'<?php echo $this->Url->build(["controller"=>"Feepayment","action"=>"showfeetype"])?>',
			 data:{id:cl_id},

			 success:function(getdata){
				 $("#resultclass").html(getdata);
			 },

			 error:function(){
				 alert('An Error Occured:'+e.responseText);
				 console.log();
			 }
		 });

 });
 $('.viewmodal').click(function(){
			payid=$(this).attr('id');
			$('#payid').attr('value',payid);
			vpid=$('#payid').val();
			//alert(payid);
			
				$.ajax({
		              type: 'POST',
		              url: '<?php echo $this->Url->build(["controller" => "Feepayment","action" => "paymentview"]);?>',
		              data : {
		              		vpaymentid:payid,

							},
						success: function (data)
		            {
								$('#modal-view').html(data);
		   				 },
						beforeSend:function(){
							$('#modal-view').html('<center><img src=../images/4.gif width=120px><div><h3>Loading...</h3></div></center>');
						},
		                     error: function(e) {
		                     console.log(e);
		                 }

		        });



		});
 });



</script>


 <div class="modal fade " id="myModalview" role="dialog">
    <div class="modal-dialog modal-md"  >

      <div class="modal-content">
        <div class="modal-header" >
          <button type="button" class="close" data-dismiss="modal">&times;</button>
		 <h4>School Management System</h4>
        </div>
        <div class="modal-body" id="modal-view">


        </div>
        <div class="modal-footer">

          <center><button type="button" class="btn btn-default" data-dismiss="modal">Close</button></center>
		</div>

        </div>
      </div>

    </div>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">

                       <li>

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart fa-lg')) . "Student Failed Report ",array('controller'=>'report','action' => 'failed'),array('escape' => false));
						?>


					  </li>

					  <li>
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart fa-lg')) . " Attendance Report",array('controller'=>'report','action' => 'attendance'),array('escape' => false));
						?>
					  </li>

					    <li>
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart fa-lg')) . " Teacher Performance Report",array('controller'=>'report','action' => 'teacher'),array('escape' => false));
						?>
					  </li>

					    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-bar-chart fa-lg')) . " Fee Payment Report",array('controller'=>'report','action' => 'feepayment'),array('escape' => false));
						?>
					  </li>


				</ul>
</div>

<div class="row">
		<div class="panel-body">
			<?php echo $this->Form->Create('form1',['id'=>'formID','class'=>'form_horizontal formsize','method'=>'post','enctype'=>'multipart/form-data'],['url'=>['action'=>'addexam']]);?>

					<div class="col-md-2">
						<div class="form-group">
							<label>Class Name<span class="require-field">*</span></label>
							<select class="form-control validate[required]" name="class_id" id="class_id">
								<option value="">---Select Class---</option>
								<?php
								foreach($class_data as $class_info):
									?>
										<option value="<?php echo $class_info['class_id'];?>"><?php echo $class_info['class_name']?></option>
									<?php
								endforeach;
								?>

							</select>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label>FeeType<span class="require-field">*</span></label>
							<div id="resultclass">
							<select class="form-control validate[required]" name="fees_id">
								<option>---Select Fee Type---</option>
							</select>
							</div>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label>Payment Status<span class="require-field">*</span></label>
							<select class="form-control validate[required]" name="payment_status">
								<option value="">---Select Status---</option>
								<option value="0">Not Paid</option>
								<option value="1">Partially Paid</option>
								<option value="2">Full Paid</option>
							</select>
						</div>
					</div>

					<div class="col-md-2">
						<div class="form-group">
							<label>Start Year<span class="require-field">*</span></label>
							<select class="form-control validate[required]" name="start_year">
								<option>---Start Year---</option>
							<?php
								for($i=2000;$i<=2030;$i++):
                   				 ?>
                <option value="<?php echo $i;?>"><?php echo $i;?></option>

                <?php
				endfor;
              ?>
							</select>
						</div>
						
					</div>
					
					
					<div class="col-md-2">
						<div class="form-group">
							<label>End Year<span class="require-field">*</span></label>
							<select class="form-control validate[required]" name="end_year">
								<option>---End Year---</option>
							<?php
								for($i=2000;$i<=2030;$i++):
                   				 ?>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>

                <?php
				endfor;
              ?>
							</select>
						</div>
						
					</div>

					<div class="col-md-2">
						
						<div class="form-group">
							<label><span class="require-field"></span></label>
								<?php	echo $this->Form->input('GO',array('type'=>'submit','class'=>'btn btn-info','name'=>'view_chart','style'=>''));?>

						</div>
					</div>

					<?php
						if(isset($fees_data)){
					?>
<input type="hidden" value="" name="" id="payid">

					<table id="examlist" class="table table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?php echo __('Fee Type');?></th>
						<th><?php echo __('Student Name');?></th>
						<th><?php echo __('Roll No');?></th>
						<th><?php echo __('Class');?></th>
						<th><?php echo __('Payment Status');?></th>
						<th><?php echo __('Amount');?></th>
						<th><?php echo __('Due Amount');?></th>
						<th><?php echo __('Description');?></th>
						<th><?php echo __('Year');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
                       <th><?php echo __('Fee Type');?></th>
						<th><?php echo __('Student Name');?></th>
						<th><?php echo __('Roll No');?></th>
						<th><?php echo __('Class');?></th>
						<th><?php echo __('Payment Status');?></th>
						<th><?php echo __('Amount');?></th>
						<th><?php echo __('Due Amount');?></th>
						<th><?php echo __('Description');?></th>
						<th><?php echo __('Year');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</tfoot>
				<tbody>

				<?php
					foreach ($fees_data as $fees_info) :
				
						$pay_status='';
						if($fees_info['payment_status'] == 0){
							$pay_status='Not Paid';
						}else if($fees_info['payment_status'] == 1){
							$pay_status='Partially Paid';
						}else if($fees_info['payment_status'] == 2){
							$pay_status='Full Paid';
						}

						$year=$fees_info['start_year'].' - '.$fees_info['end_year'];

					foreach($class_data as $class_info){

							if($class_info['class_id'] == $fees_info['class_id']){

					foreach($get_all_user as $user_info){

						if($fees_info['student_id'] == $user_info['user_id']){

						foreach($get_all_data_cat as $fee_type){

							if($fee_type['category_id'] == $fees_info['fees_id']){


					?>


					

					<tr>
					
					<td><?php echo $fee_type['category_type'];  ?></td>
						<td><?php echo $user_info['first_name'].' '.$user_info['last_name']; ?></td>
					<td><?php echo $user_info['roll_no']; ?></td>
						<td><?php echo $class_info['class_name']; ?></td>
						<td><label class="btn btn-success btn-xs"><?php echo $pay_status;?></label></td>
						<td><?php echo $fees_info['total_amount']; ?><input type="hidden" value="<?php echo $fees_info['total_amount']?>" id="amt<?php echo $fees_info['fees_pay_id'];?>"></td>
						<td><?php echo (int)$fees_info['total_amount']-(int)$fees_info['fees_paid_amount']; ?></td>
						<td><?php echo $fees_info['description']; ?></td>
						<td><?php echo $year; ?></td>
						<td>
							
		<button type="button" id="<?php echo $fees_info['fees_pay_id'];?>" data-toggle="modal" data-target="#myModalview" class="btn viewmodal" style="">View </button>
							
							</td>

					</tr>
					<script>
					
					$(function(){
						$('#'+<?php echo $fees_info["fees_pay_id"];?>).click(function(){
							am=$('#amt'+<?php echo $fees_info["fees_pay_id"]?>).val();
							$('#netamt').attr('value',am);
						});



					});
					
					</script>
					<?php
					
								}
							}
						}
					}
					}
				}
				
				endforeach;
				?>
				
					
				</tbody>
				</table>
				<?php
				}
				?>



			<?php $this->Form->end(); ?>

		</div>
</div>

