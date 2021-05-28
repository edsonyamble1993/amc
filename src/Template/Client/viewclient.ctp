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
       <img style="max-width:100%;" src="../../img/user/<?php echo $viewclients['photo']; ?>">
       	</div>
<div class="col-md-6 col-sm-12 right_side">
<div class="table_row">
<div class="col-md-5 col-sm-12 table_td">
<i class="fa fa-user"></i> 
First Name	
</div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color">
<?php echo $viewclients['first_name'].' '.$viewclients['last_name']; ?>
</span>
</div>
</div>

<div class="table_row">
<div class="col-md-5 col-sm-12 table_td">
<i class="fa fa-envelope"></i> 
Email 
</div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color"><?php if($viewclients['email'] != ''){ echo $viewclients['email']; }else{ echo '-'; } ?></span>
</div>
</div>
<div class="table_row">
<div class="col-md-5 col-sm-12 table_td"><i class="fa fa-phone"></i> Mobile No </div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color">
<span class="txt_color"><?php if($viewclients['mobile_no'] != ''){ echo $viewclients['mobile_no']; }else{ echo '-'; } ?></span>
</span>
</div>
</div>
<div class="table_row">
<div class="col-md-5 col-sm-12 table_td">
<i class="fa fa-calendar"></i> Date Of Birth	
</div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color"><?php if($viewclients['dob'] != ''){ echo date($this->Amc->getDateFormat(),strtotime($viewclients['dob'])); }else{ echo '-'; } ?></span>
</div>
</div>
<div class="table_row">
<div class="col-md-5 col-sm-12 table_td">
<i class="fa fa-mars"></i> Gender 
</div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color"><?php if($viewclients['gender'] != ''){ echo $viewclients['gender']; }else{ echo '-'; } ?></span>
</div>
</div>
<div class="table_row">
<div class="col-md-5 col-sm-12 table_td">
<i class="fa fa-graduation-cap"></i>Company Name</div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color"><?php if($viewclients['company_name'] != ''){ echo $viewclients['company_name']; }else{ echo '-'; } ?></span>
</div>
</div>
<div class="table_row">
<div class="col-md-5 col-sm-12 table_td">
<i class="fa fa-location-arrow"></i> City	</div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color"><?php if($viewclients['city'] != ''){ echo $viewclients['city']; }else{ echo '-'; } ?></span>
</div>
</div>
<div class="table_row">
<div class="col-md-5 col-sm-12 table_td">
<i class="fa fa-map-marker"></i> State	</div>
<div class="col-md-7 col-sm-12 table_td">
<span class="txt_color"><?php if($viewclients['state'] != ''){ echo $viewclients['state']; }else{ echo '-'; } ?></span>
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
								Designation
							</div>
							<div class="col-md-6 col-sm-12 table_td">
								<span class="txt_color"><?php if($viewclients['role'] != ''){ echo $viewclients['role']; }else{ echo '-'; } ?></span>
							</div>
						</div>					
						 <div class="table_row">
							<div class="col-md-6 col-sm-12 table_td">
								Address
							</div>
							<div class="col-md-6 col-sm-12 table_td">
								<span class="txt_color"><?php if($viewclients['address'] != ''){ echo implode(",",json_decode($viewclients['address'])); }else{ echo '-'; } ?></span>
							</div>
						</div>
						<div class="table_row">
							<div class="col-md-6 col-sm-12 table_td">
								Create Date				
							</div>
							<div class="col-md-6 col-sm-12 table_td">
								<span class="txt_color"><?php if($viewclients['create_date'] != ''){ echo date($this->Amc->getDateFormat(),strtotime($viewclients['create_date'])); }else{ echo '-'; } ?></span>
							</div>
						</div>
						
</div>
</div>
<div class="white-box clientviewdata">
<ul class="nav nav-tabs tabs customtab">
			<li class="active tablinks"><a href="#sales_detail" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-user"></i></span> <span class="hidden-xs">Sales Details</span> </a> </li>
            <li class=" tablinks"><a href="#quatation_detail" data-toggle="tab"> <span class="visible-xs"><i class="fa fa-home"></i></span> <span class="hidden-xs">Quotation Details</span> </a> </li>
            <li class="tablinks"><a href="#complaint_detail" data-toggle="tab" aria-expanded="false"> <span class="visible-xs"><i class="fa fa-cog"></i></span> <span class="hidden-xs">Complaint Details</span> </a> </li>
			 
</ul>
</div>
<div class="main-wrapper">
	<div class="row panel-body">
           <div class="tab-content">            
                 <div class="tab-pane active" id="sales_detail">
                        
                        
                       
                        
                       <?php  if(!empty($saledetail)){ ?>
                         <div class="col-md-12 salesdetail">
						 
						 <?php

						 foreach($saledetail as $saledetails)
			{?>
						 <div class="col-md-9"></div>
						 <div class="col-md-3">
						 <h4>Bill Number : <?php echo $saledetails['bill_number']; ?> </h4>
						 <h4>Status : <?php echo $saledetails['status']; ?></h4>
						 <h4>Date : <?php echo $saledetails['date']; ?></h4><br/>
						 </div>
                            <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
			<thead>
				<tr>
					<th class="text-center">Item Name</th>
					<th class="text-center"> Quantity</th>
					<th class="text-center">Price </th>
					<th class="text-center">Amount </th>
				</tr>
			</thead>
			<tbody>
			
			<?php $history_record = $this->AMC->Getallsaledata($saledetails['sales_id']); ?>
					<?php
			if(!empty($history_record)){
			$total_amount=0;
			foreach($history_record as $history_records){
				$total_amount= $total_amount+$history_records->net_amount;
				
				?>
					<tr>
					<td class="text-center"><?php echo  $this->AMC->GetItemName($history_records->item_name); ?></td>
					<td class="text-center"><?php echo  $history_records->qty; ?></td>
					<td class="text-center"><?php echo  $this->AMC->getCurrencyCode()."&nbsp".$history_records->price; ?></td>
					<td class="text-center"><?php echo  $this->AMC->getCurrencyCode()."&nbsp".$history_records->net_amount; ?></td>
					
					</tr>
			<?php } ?>
			<table class="table" style="border:1px solid #ddd"  width="100%">
			<tr>
				<td colspan="2" width=195px class="text-right" align="right"><?php echo __('Grand Total:'); ?></td>
				<td colspan="2" style="padding-right:0px !important;" class="text-center" align="center"><?php echo $this->AMC->getCurrencyCode()."&nbsp". $total_amount; ?></td>
			
			</tr>
	
		</table>
			<?php }else
			{ ?>
		
				No Data Available
			<?php }				?>	
			
		  			</tbody>
		</table><hr/>
		<?php 
}		?>
                        </div> 
					   <?php } ?>
					   
					   </div>
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
					   
							 <div class="tab-pane " id="quatation_detail">
							 <?php if(!empty($quotationdetail)){ ?>
							<div class="" style="float:left;background-color:white;width:100%">
                        
                        
                       
                        
                        
                       
                         <div class="col-md-12 quotation_details">
						
						 <?php

						 foreach($quotationdetail as $quotationdetails)
			{?>
						 <div class="col-md-8"></div>
						 <div class="col-md-4">
						 <h4>Quotation Number : <?php echo $quotationdetails['quotation_no']; ?> </h4>
						 <h4>Date : <?php echo $quotationdetails['quotation_date']; ?></h4>
						 <h4>Subject : <?php echo $quotationdetails['subject']; ?></h4><br/>
						 </div>
                            <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
			<?php $history_record = $this->AMC->Getallquotationdata($quotationdetails['quotation_id']); ?>
					<?php
			if(!empty($history_record)){?>
			<thead>
				<tr>
					<th class="text-center">Item Name</th>
					<th class="text-center">Quantity</th>
					<th class="text-center">Price</th>
					<th class="text-center">Amount</th>
				</tr>
			</thead>
			<tbody>
			<?php
			
			$total_amount=0;
			foreach($history_record as $history_records){
				$total_amount= $total_amount+$history_records->net_amount;
				
				?>
					<tr>
					<td class="text-center"><?php echo  $this->AMC->GetItemName($history_records->item_name); ?></td>
					<td class="text-center"><?php echo  $history_records->qty; ?></td>
					<td class="text-center"><?php echo  $history_records->price; ?></td>
					<td class="text-center"><?php echo  $history_records->net_amount; ?></td>
					
					</tr>
			<?php } ?>
			<table class="table" style="border:1px solid #ddd"  width="100%">
			<tr>
				<td colspan="2" class="text-right" align="right"><?php echo __('Grand Total:'); ?></td>
				<td colspan="2" class="text-center" align="center"><?php echo $this->AMC->getCurrencyCode()."&nbsp".$total_amount; ?></td>
			
			</tr>
	
		</table>
			<?php }else
			{ ?>
		
				No Data Available
			<?php }				?>	
			
		  			</tbody>
		</table><hr/>
		<?php 
}		?>
                        </div>
						
							</div>
							<?php } ?>
							</div>
							
							
							
							
							
							
							
							
							
							<div class="tab-pane " id="complaint_detail">
							<div class="" style="float:left;background-color:white;width:100%">
                        
                        
                        
                       
                       <?php  if(!empty($complaintdetail)){ ?>
                        
                         <div class="col-md-12  quotation_details">
						 
						 <?php

						 foreach($complaintdetail as $complaintdetails)
			{?>
						 <div class="col-md-8"></div>
						 <div class="col-md-4">
						 <h4>Complaint Number : <?php echo $complaintdetails['complaint_no']; ?> </h4>
						 <h4>Complaint Date : <?php echo $complaintdetails['complaint_date']; ?></h4>
						 <h4>Complaint Type : <?php echo $this->AMC->getCategoryName($complaintdetails['complaint_type_id']); ?></h4>
						 <h4>Complaint Chargeble : <?php if($complaintdetails['complaint_chargeble'] == 0){ echo 'No'; }else{ echo 'Yes'; } ?></h4>
						 <h4>Product Name : <?php echo $this->AMC->GetItemName($complaintdetails['product_id']); ?> </h4><br/>
						 </div>
                            <table class="table table-bordered" width="100%" border="1" style="border-collapse:collapse;">
			
			<thead>
				<tr>
					
					<th class="text-center">Assign To</th>
					<th class="text-center">Close Date</th>
					<th class="text-center">Status</th>
				</tr>
			</thead>
			<tbody>
			
			
			
					<tr>
					
					<td class="text-center"><?php echo $this->AMC->getEmployeerName($complaintdetails['assign_to']); ?></td>
					<td class="text-center"><?php echo $complaintdetails['close_date']; ?></td>
					<td class="text-center"><?php 

                      
                            
                        if($complaintdetails['status'] == 0){
                            echo '<span class="label label-danger">'.__('Closed').'</span>';
                        }else if($complaintdetails['status'] == 1){
                            echo '<span style="padding:10px 15px;" class="label label-success">'.__('Open').'</span>';
                        }else if($complaintdetails['status'] == 2){
                            echo '<span class="label label-info">'.__('Progress').'</span>';
                        }
                            
                           


                        ?></td>
					
					</tr>
			
			
		  			</tbody>
		</table><hr/>
		<?php 
}		?>
                        </div>
					   <?php } ?>
							</div>
							
							</div>
							
							
							
							
							
							
							
							
							
							
							
							
                    
		</div> 
	</div> 
</div>
                    