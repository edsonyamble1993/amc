
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
<div id="dashboard">
	
<div class="default_main">
	<div class="row">
	
			<div class="col-lg-2 col-md-2 col-xs-6 col-sm-3">
			<a href="<?php echo $this->Url->build(array('controller'=>'employee','action'=>'employeelist'));?>" target="blank">
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
			<a href="<?php echo $this->Url->build(array('controller'=>'client','action'=>'clientlist'));?>" target="blank">
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
			<a href="<?php echo $this->Url->build(array('controller'=>'amc','action'=>'viewamc'));?>" target="blank">
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
			<a href="<?php echo $this->Url->build(array('controller'=>'complaint','action'=>'viewcomplaint'));?>" target="blank">
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
			<a href="<?php echo $this->Url->build(array('controller'=>'Product','action'=>'productlist'));?>" target="blank">
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
			<a href="<?php echo $this->Url->build(array('controller'=>'service','action'=>'viewservice'));?>" target="blank">
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
						<h3 class="panel-title"><?php echo __('Closing Complain'); ?></h3>						
					</div>
					<style>
					hr
					{
						margin:0px;
					}
					</style>
					<div class="panel-body">
					<div id="piechart_3d" ></div>
					
  
					</div>
					<hr/>
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo __('Closing Services'); ?></h3>						
					</div>
					<div class="panel-body">
					<div id="piechartone" ></div>
					
  
					</div>
					
					<hr/>
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo __('Smart Summary'); ?></h3>						
					</div>
					<div class="panel-body">
                        <p></p><div class="info-box-stats-appcount">
								<p class="app-counter"><?php echo $open_complaint;?></p>
								</div>
								
								 <?php echo $this->Html->image('https://www.homecrafttextiles.com.au/image/cache/data/Cotton%20Drill/Purple-500x500.jpg',array('class'=>'img-circle image-design','width'=>'40px','height'=>'40px'));?>
                                        <?php echo __('Open Complain');?>					
					<p></p><div class="info-box-stats-appcount">
								<p class="app-counter"></p>
								</div>
					<div class="info-box-stats-appcount">
								<p class="app-counter"><?php echo $closed_complaint;?></p>
								</div>
                        <?php echo $this->Html->image('https://www.homecrafttextiles.com.au/image/cache/data/Cotton%20Drill/Purple-500x500.jpg',array('class'=>'img-circle image-design','width'=>'40px','height'=>'40px'));?>
                                      <?php echo __("Closed Complain"); ?>
									  
									  
                                   <p></p><div class="info-box-stats-appcount">
								<p class="app-counter"></p>
								</div>
					<div class="info-box-stats-appcount">
								<p class="app-counter"><?php echo $progreess_complaint;?></p>
								</div>
                        <?php echo $this->Html->image('https://www.homecrafttextiles.com.au/image/cache/data/Cotton%20Drill/Purple-500x500.jpg',array('class'=>'img-circle image-design','width'=>'40px','height'=>'40px'));?>
                                      <?php echo __("Progress Complain"); ?>
                                   
                        
					              









<p></p>
					<div class="info-box-stats-appcount">
							<p class="app-counter"><?php echo $open_service;?></p>
								</div>
								
								
                                         <?php echo $this->Html->image('https://www.homecrafttextiles.com.au/image/cache/data/Cotton%20Drill/Purple-500x500.jpg',array('class'=>'img-circle image-design','width'=>'40px','height'=>'40px'));?>
                                        <?php echo __('Open Service');?>					
					<p></p>









								<div class="info-box-stats-appcount">
								<p class="app-counter"><?php echo $pending_service;?></p>
								</div>
								
								 <?php echo $this->Html->image('https://www.homecrafttextiles.com.au/image/cache/data/Cotton%20Drill/Purple-500x500.jpg',array('class'=>'img-circle image-design','width'=>'40px','height'=>'40px'));?>
                                        <?php echo __('Pending Service');?>				


<p></p>
                                <div class="info-box-stats-appcount">
								<p class="app-counter"><?php echo $closed_services;?></p>
								</div>
								
								 <?php echo $this->Html->image('https://www.homecrafttextiles.com.au/image/cache/data/Cotton%20Drill/Purple-500x500.jpg',array('class'=>'img-circle image-design','width'=>'40px','height'=>'40px'));?>
                                        <?php echo __('Closed Service');?>				
					
								
								
								 
                                                           					
					</div>
				</div>
				
		
				
				
				
		
			
		   </div>
            
            
            <div class="col-md-8">
				<div class="panel panel-white">
						<div class="panel-body">
					<div id="calendar"></div>
				</div>
				
				
				</div>
				
					<div class="daily_summary">
					<div class="panel panel-white">
					<div class="panel-heading">
						<h3 class="panel-title"><?php echo __('Daily Complain Summary');?></h3>						
					</div>
					<div class="panel-body">
		 	       
                      <table class="table">
                        <thead>
                        <tr>
						 <th>Customer</th>
						
                         <th>Assign To</th>
						 
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
<td><a href="<?php echo $this->Url->build(array('controller'=>'Complaint','action'=>'updatecomplaint',$complaint_info['complaint_id']))?>" class="btn btn-info">View</a></td>						
                          </tr>
                          <?php
                                }
                          
                          }else{
                              ?>
                          
                           <tr>
                               <td colspan="4"><?php echo __('There Is No Any Complaint Today');?></td>
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
											 <th>Service Type</th>
											 <th>Date</th>
											<th>Services</th>
											<th>Assign To</th>
											<th>Employee Status</th>
											<th>Edit Assign</th>
											 </tr>
								</thead>
								<tbody>
								
							<?php	if(isset($thismonthservice)){
									foreach($thismonthservice as $thismonthservices){ ?>
								<tr>
										<td><?php echo  $this->AMC->getusernamefromsale($thismonthservices['sales_id']); ?></td>
										<td><?php echo $this->AMC->getproductnamefromsale($thismonthservices['sales_id']); ?></td>
                           				<td><?php if($thismonthservices['type'] == 0){ ?><span class="label label-info">Sales Services</span> <?php }elseif($thismonthservices['type'] == 1){ ?> <span class="label label-success">AMC Service</span> <?php } ?></td>
										<td><?php echo date($this->Amc->getDateFormat(),strtotime($thismonthservices['service_date'])); ?></td> 
                           				<td><?php echo $thismonthservices['title']; ?></td> 
                           				<td><?php echo $this->AMC->getEmployeerName($thismonthservices['assign_to']); ?></td> 
                           				<td><?php if($thismonthservices['done_status'] == 0 ){ echo 'Not Done'; }elseif($thismonthservices['done_status'] == 1 ){ echo 'Done'; } ?></td> 
                           				<td><select class="form-control changeserviceemployee" id="customer" name="assign_to_id" servicesid ="<?php echo $thismonthservices['id']; ?>"> 
								<option value="" selected="selected">--Select Employee--</option>
								<?php 
									if(isset($employee_info)){
										foreach($employee_info as $employee_infos){
										?>
		<option value="<?php echo $employee_infos['user_id'];?>" <?php
        
                                if($employee_infos['user_id'] == $thismonthservices['assign_to']){
                                    echo 'selected="selected"';
                                }
        
         ?>><?php echo $employee_infos['first_name'].' '.$employee_infos['last_name']; ?></option>
										<?php
										}
									}
								?>
							</select></td> 
										
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
events: <?php echo $data;?>,
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
<script>
  $(document).ready(function(){
	 $('.changeserviceemployee').change(function(){
		 
		var employeeid = $(this).val();
		var servicesid = $(this).attr('servicesid')
		$.ajax({
                       type: 'POST',
                      url: '<?php echo $this->Url->build(["controller" => "ajax","action" => "changesalesservicestatus"]);?>',
                     data : {employeeid:employeeid,servicesid:servicesid},
                     success: function (){
                          
						},
                   
                
       });
	 });
	 $('.accept').click(function(){
					var  apporveid = $(this).attr('apporveid');
					$('.data_decline_'+apporveid).fadeOut();
					$.ajax({
										type: 'POST',
                      					url: '<?php echo $this->Url->build(["controller" => "Amc","action" => "approvestatus"]);?>',
                     					data : {apporveid:apporveid},
										success: function (response)
										{	
											
											
											
												
												
											
											
										},
										error:function(e)
										{
											console.log(e);
										}
						});
					
				});
				
				$('.decline').click(function(){
					var  declineid = $(this).attr('declineid');
					$('.data_decline_'+declineid).fadeOut();
					$.ajax({
										type: 'POST',
                      					url: '<?php echo $this->Url->build(["controller" => "Amc","action" => "declineidstatus"]);?>',
                     					data : {declineid:declineid},
										success: function (response)
										{	
											
											
											
												
												
											
											
										},
										error:function(e)
										{
											console.log(e);
										}
						});
					
				});
   });
   </script>
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

 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $piechart; ?>);

        var options = {
         
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
        chart.draw(data, options);
      }
    </script>
	<script type="text/javascript">
      google.charts.load("current", {packages:["corechart"]});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable(<?php echo $charts; ?>);

        var options = {
         
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechartone'));
        chart.draw(data, options);
      }
    </script>