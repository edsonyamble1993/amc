<style>
						.quotation_details
						{
							border:1px solid #dedede;
						}
						.sles_detais
						{
							color:#000;
							font-size:18px;
						}
						.salesdetail
						{
							border:1px solid #dedede;
						}
						</style>
			<div class="panel-body">			
<div class="member_view_row1">
<div class="col-md-8 col-sm-12 membr_left">
<div class="col-md-6 col-sm-12 left_side">
       <img style="max-width:100%;" src="../../img/user/<?php echo $viewemployee['photo']; ?>">
       	</div>
<div class="col-md-6 col-sm-12 right_side">
<div class="table_row">
<div class="col-md-5 col-sm-12 table_td">
<i class="fa fa-user"></i> 
First Name	
</div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color">
<?php echo $viewemployee['first_name'].' '.$viewemployee['last_name']; ?>
</span>
</div>
</div>

<div class="table_row">
<div class="col-md-5 col-sm-12 table_td">
<i class="fa fa-envelope"></i> 
Email 
</div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color"><?php if($viewemployee['email'] != ''){ echo $viewemployee['email']; }else{ echo '-'; } ?></span>
</div>
</div>
<div class="table_row">
<div class="col-md-5 col-sm-12 table_td"><i class="fa fa-phone"></i> Mobile No </div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color">
<span class="txt_color"><?php if($viewemployee['mobile_no'] != ''){ echo $viewemployee['mobile_no']; }else{ echo '-'; } ?></span>
</span>
</div>
</div>
<div class="table_row">
<div class="col-md-5 col-sm-12 table_td">
<i class="fa fa-calendar"></i> Date Of Birth	
</div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color"><?php if($viewemployee['dob'] != ''){ echo date($this->Amc->getDateFormat(),strtotime($viewemployee['dob'])); }else{ echo '-'; } ?></span>
</div>
</div>
<div class="table_row">
<div class="col-md-5 col-sm-12 table_td">
<i class="fa fa-mars"></i> Gender 
</div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color"><?php if($viewemployee['gender'] != ''){ echo $viewemployee['gender']; }else{ echo '-'; } ?></span>
</div>
</div>

<div class="table_row">
<div class="col-md-5 col-sm-12 table_td">
<i class="fa fa-location-arrow"></i> City	</div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color"><?php if($viewemployee['city'] != ''){ echo $viewemployee['city']; }else{ echo '-'; } ?></span>
</div>
</div>
<div class="table_row">
<div class="col-md-5 col-sm-12 table_td">
<i class="fa fa-map-marker"></i> State	</div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color"><?php if($viewemployee['state'] != ''){ echo $viewemployee['state']; }else{ echo '-'; } ?></span>
</div>
</div>
</div>
</div>
<div class="col-md-4 col-sm-12 member_right">	
<span class="report_title">
<span class="fa-stack cutomcircle">
<i class="fa fa-align-left fa-stack-1x"></i>
</span> 
<span class="shiptitle">More Info</span>	
</span>
 <div class="table_row">
							<div class="col-md-6 col-sm-12 table_td">
								<b>	Designation</b>
							</div>
							<div class="col-md-6 col-sm-12 table_td">
								<span class="txt_color"><?php if($viewemployee['role'] != ''){ echo $viewemployee['role']; }else{ echo '-'; } ?></span>
							</div>
						</div>					
						 <div class="table_row">
							<div class="col-md-6 col-sm-12 table_td">
								<b>Address</b>
							</div>
							<div class="col-md-6 col-sm-12 table_td">
								<span class="txt_color"><?php if($viewemployee['address'] != ''){ echo $viewemployee['address']; }else{ echo '-'; } ?></span>
							</div>
						</div>
						<div class="table_row">
							<div class="col-md-6 col-sm-12 table_td">
								<b>Create Date</b>				
							</div>
							<div class="col-md-6 col-sm-12 table_td">
								<span class="txt_color"><?php if($viewemployee['create_date'] != ''){ echo date($this->Amc->getDateFormat(),strtotime($viewemployee['create_date'])); }else{ echo '-'; } ?></span>
							</div>
						</div>
						
</div>
</div>						
						
						
						

              
                    <div class="row panel-body">
                       
                  <?php    if($get_record_complaint){   ?>
               <div class="col-md-12 user-profile salesdetail">
						 <h4 id="myLargeModalLabel" class="sles_detais">Complaint Details</h4><br/><br/>
						 <table id="plist" class="table table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?php echo __('Complaint Number');?></th>
						<th><?php echo __('Customer Name');?></th>
						<th><?php echo __('Complaint Date');?></th>
                        <th><?php echo __('Complaint Type');?></th>
						<?php if($this->request->session()->read('user_role') == 'admin') { ?>
                        <th><?php echo __('Assign To');?></th>
						<?php } ?>
                       
						 <?php if($this->request->session()->read('user_role') == 'admin') { ?>
                        <th><?php echo __('Employee Status');?></th>
						<?php } ?>
						
					</tr>
				</thead>
				
				<tbody>
                        
                  <?php
                   
                        foreach($get_record_complaint as $complaint_info){   
                  ?>
					<tr>
                        <td><?php echo $complaint_info['complaint_no'];?></td>
                        <td><?php echo $this->AMC->getuser_name($complaint_info['customer_id']);?></td>
                        <td><?php echo date($this->Amc->getDateFormat(),strtotime($complaint_info['complaint_date']));?></td>
                        <td><?php echo $this->AMC->getCategoryName($complaint_info['complaint_type_id']); ?></td>
                         <?php if($this->request->session()->read('user_role') == 'admin') { ?>
						 <td>
								 <?php 
								 if($complaint_info['assign_to']>0)
								 { 
									echo $this->AMC->getEmployeerName($complaint_info['assign_to']); 
								 }else
								 { 
									?>
									
									
									
									
									
									<select class="form-control assign_to_employee" complain_id = "<?php echo $complaint_info['complaint_id']; ?>" name="assign_to" required="required">
							<option value="0"><?php echo __('Select Name'); ?></option>
							<?php
								if(isset($employee_info)){
									foreach($employee_info as $emp_data){
										?>
											<option value="<?php echo $emp_data['user_id'];?>"><?php echo $emp_data['first_name'].' '.$emp_data['last_name']; ?></option>

										<?php
										}
								}
								?>
							</select>
							<?php
								} ?>
						</td>
						 <?php } ?>
                        <td><?php 

                      
                            
                        if($complaint_info['status'] == 0){
                            echo '<span class="label label-danger">'.__('Closed').'</span>';
                        }else if($complaint_info['status'] == 1){
                            echo '<span class="label label-success">'.__('Open').'</span>';
                        }else if($complaint_info['status'] == 2){
                            echo '<span class="label label-info">'.__('Progress').'</span>';
                        }
                            
                           


                        ?></td>
						<style>
						.employee_status_no
						{
							width:100%;
							float:left;
							text-align:center;
						}
						.accpt_decline
						{
							width:100%;
							float:left;
							
						}
						.accept
						{
							width:50%;
							padding:6px 0px;
							background:#08A7C3;
							color:#fff;
							margin-top:5px;
							float:left;
							text-align:center;
							cursor:pointer;
						}
						.decline
						{
							width:50%;
							padding:6px 0px;
							background:#e14444;
							color:#fff;
							margin-top:5px;
							float:left;
							text-align:center;
							cursor:pointer;
						}
						</style>
						
						
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