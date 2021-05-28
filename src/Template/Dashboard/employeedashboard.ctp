<style>
.mytextarea,.savebutton
{
	float:left;
}
</style>

<div id="dashboard">
	
<div class="default_main">
	<div class="row">
	
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo $this->Url->build(array('controller'=>'employee','action'=>'employeelist'));?>">
				<div class="panel info-box panel-white">
					<div class="panel-body member">
					
					<?php echo $this->Html->image('dashboard/team.png',array('class'=>'dashboard_background'));?>	
                                        <div class="info-box-stats">
							<p class="counter">
                                <?php 
                                if(isset($employee_count)){
                                    echo $employee_count;
                                }
                                ?>
                                    </p>
							
							<span class="info-box-title"><?php echo __('Employees');?></span>
						</div>
						
					</div>
				</div>
			</a>
			</div>
            
            

			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo $this->Url->build(array('controller'=>'client','action'=>'clientlist'));?>">
				<div class="panel info-box panel-white">
					<div class="panel-body staff-member">
					<?php echo $this->Html->image('dashboard/client.png',array('class'=>'dashboard_background'));?>	
						<div class="info-box-stats">
							<p class="counter">
                               <?php 
                                if(isset($client_count)){
                                    echo $client_count;
                                }
                                
                                ?>
                            </p>
							<span class="info-box-title"><?php echo __('Clients');?></span>
						</div>
						
                        
					</div>
				</div>
				</a>
			</div>
            
            
            
            
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo $this->Url->build(array('controller'=>'amc','action'=>'viewamc'));?>">
				<div class="panel info-box panel-white">
					<div class="panel-body group">
					<?php echo $this->Html->image('dashboard/contract.png',array('class'=>'dashboard_background'));?>
						<div class="info-box-stats">
							<p class="counter">
                               <?php 
                                    if(isset($amc_count)){
                                        echo $amc_count;
                                    }
                                
                                ?>
                            </p>
							
							<span class="info-box-title"><?php echo __('AMC');?></span>
						</div>
					
					</div>
				</div>
				</a>
			</div>
            
            
            
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo $this->Url->build(array('controller'=>'complaint','action'=>'viewcomplaint'));?>">
				<div class="panel info-box panel-white">
					<div class="panel-body message">
					<?php echo $this->Html->image('dashboard/telemarketer.png',array('class'=>'dashboard_background'));?>
						<div class="info-box-stats">
							<p class="counter"><?php 
                                if(isset($complaint_count)){
                                    echo $complaint_count;
                                }
                                
                                ?>
								</p>
							
							<span class="info-box-title"><?php echo __('Complain');?></span>
						</div>
						
						
					</div>
				</div>
				</a>
			</div>
			
			
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo $this->Url->build(array('controller'=>'Product','action'=>'productlist'));?>">
				<div class="panel info-box panel-white">
					<div class="panel-body member">
					<?php echo $this->Html->image('dashboard/industrial-robot.png',array('class'=>'dashboard_background'));?>
						<div class="info-box-stats">
							<p class="counter">
                                <?php 
                                    if(isset($product_count)){
                                        echo $product_count;
                                    }
                                ?>
                            </p>
							
							<span class="info-box-title"><?php echo __('Products');?></span>
						</div>
						
						
					</div>
				</div>
				</a>
			</div>
			
			
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo $this->Url->build(array('controller'=>'service','action'=>'viewservice'));?>">
				<div class="panel info-box panel-white">
					<div class="panel-body staff-member">
					<?php echo $this->Html->image('dashboard/tasks.png',array('class'=>'dashboard_background'));?>	
						<div class="info-box-stats">
							<p class="counter">
                               <?php 
                                if(isset($service_count)){
                                    echo $service_count;
                                }
                                ?>
                            </p>
							<span class="info-box-title"><?php echo __('Services');?></span>
						</div>
						
                        
					</div>
				</div>
				</a>
			</div>
			
			
				
				
			
            <div class="col-md-4 membership-list">
				<div class="panel panel-white">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo __('Smart Summary'); ?></h3>						
					</div>
					<div class="panel-body">
                        
					<div class="info-box-stats-appcount">
								<p class="app-counter"><?php echo $open_amc_service_count;?></p>
								</div>
                        <?php echo $this->Html->image('https://www.homecrafttextiles.com.au/image/cache/data/Cotton%20Drill/Purple-500x500.jpg',array('class'=>'img-circle image-design','width'=>'40px','height'=>'40px'));?>
                                      <?php echo __("Open AMC Service"); ?>
                                   
                        
					               <p></p><div class="info-box-stats-appcount">
								<p class="app-counter"><?php echo $progress_amc_service_count; ?></p>
								</div>
                                        
                                          <?php echo $this->Html->image('https://www.homecrafttextiles.com.au/image/cache/data/Cotton%20Drill/Purple-500x500.jpg',array('class'=>'img-circle image-design','width'=>'40px','height'=>'40px'));?>
                                        <?php echo __("Pending AMC Service");?>					
					<p></p><div class="info-box-stats-appcount">
								<p class="app-counter"><?php echo $open_service;?></p>
								</div>
								
								
                                         <?php echo $this->Html->image('https://www.homecrafttextiles.com.au/image/cache/data/Cotton%20Drill/Purple-500x500.jpg',array('class'=>'img-circle image-design','width'=>'40px','height'=>'40px'));?>
                                        <?php echo __('Open Service');?>					
					<p></p><div class="info-box-stats-appcount">
								<p class="app-counter"><?php echo $pending_service;?></p>
								</div>
								
								 <?php echo $this->Html->image('https://www.homecrafttextiles.com.au/image/cache/data/Cotton%20Drill/Purple-500x500.jpg',array('class'=>'img-circle image-design','width'=>'40px','height'=>'40px'));?>
                                        <?php echo __('Pending Service');?>					
					<p></p><div class="info-box-stats-appcount">
								<p class="app-counter"><?php echo $open_complaint;?></p>
								</div>
								
								 <?php echo $this->Html->image('https://www.homecrafttextiles.com.au/image/cache/data/Cotton%20Drill/Purple-500x500.jpg',array('class'=>'img-circle image-design','width'=>'40px','height'=>'40px'));?>
                                        <?php echo __('Open Complain');?>					
					<p></p><div class="info-box-stats-appcount">
								<p class="app-counter"></p>
								</div>
								
								
								 
                                                           					
					</div>
				</div>
				
		
				
				
				
	
		
				
			
		   </div>
        
        
        
       
        
        
        
        
        
            
          
            <div class="col-md-8">
				<div class="panel panel-white">
						<div class="panel-body">
					<div id="calendar"></div>
				</div>
				
				
				</div>
                
                
                
                  <!-- Services start-->
					<div class=" daily_summary">
					<div class="panel panel-white">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo __('Daily Complain Summary');?></h3>						
					</div>
					<div class="panel-body">
		 	       
                      <table class="table">
                        <thead>
                        <tr>
						 <th>Customer</th>
                         
                         <th>Date</th>
                       
                         <th>Status</th>
						  <th>Action</th>
						 
                        </tr>
                            </thead>
                         
                          <?php
                           if(isset($complaint_data)){
                            foreach($complaint_data as $complaint_info){
                            ?>
                          
                           <tr>
						   <td><?php echo $this->AMC->getuser_name($complaint_info['customer_id']);?></td>
                           
						 <td><?php echo date($this->Amc->getDateFormat(),strtotime($complaint_info['complaint_date']));?></td> 
                            <td><?php 

                      
                            
                        if($complaint_info['status'] == 0){
                            echo '<span class="label label-danger">'.__('Closed').'</span>';
                        }else if($complaint_info['status'] == 1){
                            echo '<span class="label label-success">'.__('Open').'</span>';
                        }else if($complaint_info['status'] == 2){
                            echo '<span class="label label-info">'.__('Progress').'</span>';
                        }
                            
                           


                        ?></td>
<td><a href="<?php echo $this->Url->build(array('controller'=>'Complaint','action'=>'updatestatuscomplaint',$complaint_info['complaint_id']))?>" class="btn btn-info">View</a></td>						
 						
                          </tr>
                          <?php
                                }
                          
                          }else{
                              ?>
                          
                           <tr>
                               <td colspan="4"><?php echo __('There Is No Any Complain Today');?></td>
                          </tr>
                          
                          <?php   
                          }
                          ?>
                          <tbody>
                             
                              
                          
                          
                          </tbody>
                         
                      </table>  
                        
					</div>
				</div>
		
				</div>
	
					         <!-- Services End-->
                
                
                
              
                
                
			</div>
        
<div class="col-md-12">
			<div class="daily_summary">
						<div class="panel panel-white">
								<div class="panel-heading">
								<h3 class="panel-title">Services Of This Month</h3>						
								</div>
								<div class="panel-body">
								<table class="table">
										<thead>
											<tr>
											 <th>Customer Name</th>
											 <th>Product Name</th>
											 <th>Date</th>
											<th>Services</th>
											<th>Action</th>
											 <th>Done Description</th>
											 
											 </tr>
								</thead>
								<tbody>
								
							<?php	if(isset($thismonthservice)){
									foreach($thismonthservice as $thismonthservices){ ?>
								<tr>
										<td><?php echo  $this->AMC->getusernamefromsale($thismonthservices['sales_id']); ?></td>
										<td><?php echo $this->AMC->getproductnamefromsale($thismonthservices['sales_id']); ?></td>
                           				<td><?php echo date($this->Amc->getDateFormat(),strtotime($thismonthservices['service_date'])); ?></td> 
                           				<td><?php echo $thismonthservices['title']; ?></td> 
                           				<td><select class="form-control done_status" name="status" statusdoneid="<?php echo $thismonthservices['id']; ?>">
						<option value="0" <?php if($thismonthservices['done_status'] == 0){ echo 'selected'; } ?>>Not Done</option>
						<option value="1" <?php if($thismonthservices['done_status'] == 1){ echo 'selected'; } ?>>Done</option>
						
						</select></td>
						
                           		<td class="donesave_<?php echo $thismonthservices['id'];  ?>"><?php if($thismonthservices['done_discription'] == ''){ ?><textarea rows="2" class="mytextarea servicedata_<?php echo $thismonthservices['id'];  ?>"></textarea><button type="button" class="btn btn-primary savebutton save_<?php echo $thismonthservices['id']; ?>" service_id = <?php echo $thismonthservices['id']; ?>>save</button><?php }else{ echo $thismonthservices['done_discription']; } ?></td>	
										
								</tr>
							<?php }  } ?>
								</tbody>
								</table>
								</div>
						</div>
				</div>
					
			</div>
        
        

        
			



	
		
</div>



<?php

$notice_data_array = array();

 if(!empty($calenderdata))
	{
		foreach($calenderdata as $notice)
		{	
			//$notice_data_array = array();
			$i=1;
			$colourcode = '#E87352';
			$servicetype= 'Undefined';
			if($notice['type'] == 1){ $colourcode = '#66B5D6'; $servicetype = 'Sales - Free'; }elseif($notice['type'] == 0){ $colourcode = '#E87352'; $servicetype = 'AMC - Free';  }else{  $colourcode = '#5FCE9B'; $servicetype = 'Service - Paid';  }
			$n_start_date=date('Y-m-d', strtotime($notice['service_date']));
			$n_end_date=date('Y-m-d', strtotime($notice['service_date']));
			$name = $this->AMC->getuser_name($notice['customer_id']);
			$productname = $this->AMC->getproductnamefromsale($notice['sales_id']);
			$notice_data_array[]=array('title'=>$notice['title'],
			'start'=>$n_start_date,
			'end'=>$n_end_date,
			'color'=>$colourcode,
			'tip'=>'Customer Name:'.$name,
			'productname'=>'Product Name: '.$productname,
			'type'=>'Service Type : '.$servicetype,
			'typeds'=>'Service List',
			);
		}
		
		
	} 
	if(!empty($notice_data_array)) {
	$data = json_encode($notice_data_array);
	
	}else
	{
		$data = json_encode(array());
	}
	
?>


      <script>
	   $(document).ready(function(){
	 $('.done_status').change(function(){
		 
		var done_status = $(this).val();
		var service_mange_id = $(this).attr('statusdoneid')
		$.ajax({
                       type: 'POST',
                      url: '<?php echo $this->Url->build(["controller" => "ajax","action" => "changedonestatus"]);?>',
                     data : {done_status:done_status,service_mange_id:service_mange_id},
                     success: function (){
                          
						},
                   
                
       });
	 });
	 $('.savebutton').click(function(){
		 var service_id = $(this).attr('service_id');
		var comment = $('.servicedata_'+service_id).val();
		
		
		$.ajax({
                       type: 'POST',
                      url: '<?php echo $this->Url->build(["controller" => "ajax","action" => "changecomment"]);?>',
                     data : {service_id:service_id,comment:comment},
                      beforeSend: function() {
        // setting a timeout
        $('.save_'+service_id).text('saving..');
    },
					 success: function (done){
                          $('.donesave_'+service_id).text(comment);
						},
                   
                
       });
	 });
	 });
</script>	  
	<script>
	
$(document).ready(function() {

$('#calendar').fullCalendar({
    
	height: 450,
header: {
left: 'prev,next today',
center: 'title',
right: 'month,agendaWeek,agendaDay'
},
editable: false,
eventLimit: true, // allow "more" link when too many events
events: <?php echo $data; ?>,
eventClick:  function(event, jsEvent, view) {
        		$("#eventtypeofnm").html(event.tip);
        		$("#sche_by").html(event.productname);
        		$("#eventclientnm").html(event.type);
        		
				
        		$("#eventContent").dialog({ 
					modal: true, 
					title: event.typeds
				});
   		 	},
 
});

});

</script>
   
		
		
</div>

</div>
<style>
	.ui-dialog-titlebar-close:after {
    content: '\f00d';
    font-family: FontAwesome;
    font-size: 16px;
    top: -4px;
    position: absolute;
    right: 2px;
    outline: 0;
}
</style>
<div id="eventContent" title="Event Details">
    <div id="eventtypeofnm"   ></div>
    <div id="sche_by" ></div>
    <div id="eventclientnm"></div>
    
</div>

