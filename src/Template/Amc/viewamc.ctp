<script>
  $(document).ready(function(){
	
	 jQuery('.accept').click(function(){
					var  apporveid = $(this).attr('apporveid');
					jQuery('.data_decline_'+apporveid).fadeOut();
					jQuery.ajax({
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
				
				jQuery('.decline').click(function(){
					var  declineid = $(this).attr('declineid');
					jQuery('.data_decline_'+declineid).fadeOut();
					jQuery.ajax({
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
<script>
jQuery(document).ready(function(){
	 
	jQuery('.emplooyement_statis').change(function(){
		
		var status = $(this).val();
		var amcid = $(this).attr('amcid')
		
		jQuery.ajax({
                       type: 'POST',
                      url: '<?php echo $this->Url->build(["controller" => "ajax","action" => "changeamcstatus"]);?>',
                     data : {status:status,amcid:amcid},
                     success: function (){
                          location.reload();
						},
                   
                
       });
	 });
});
</script>
<script type="text/javascript">

$( document ).ready(function(){

    $(".save").click(function(){ 
	   
	   $('.modal-body').html("");
	   
       var str = $(this).attr("print");
	 
       $.ajax({
       type: 'POST',
       url: '<?php echo $this->Url->build([
"controller" => "amc",
"action" => "amcdetaildata"]);?>',
	
       data : {id:str},
       success: function (data)
       {            

			  $('.modal-body').html(data);
				
   },
   beforeSend:function(){
						$(".modal-body").html("<center><h2 class=text-muted><b>Loading...</b></h2></center>");
					},
error: function(e) {
       alert("An error occurred: " + e.responseText);
       console.log(e);	
}

       });

       });
	      

   });

</script>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	  <div class="modal-header"> 
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 id="myLargeModalLabel" class="modal-title"><?php echo __('Amc Detail'); ?></h4>
		</div>
      <div class="modal-body">
		
      </div>
      
	  
   
</div>
  </div>
</div>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					 
                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Amc'),array('controller'=>'Amc','action' => 'viewamc'),array('escape' => false));
						?>

					  </li>
					  
					  
					  <?php 
						if($this->request->session()->read('user_role') != 'client' && $this->request->session()->read('user_role') == 'admin'){
					  ?>

					   <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Amc'),array('controller'=>'Amc','action' => 'addamc'),array('escape' => false));
						?>

					  </li>
					  <?php } ?>

				</ul>
</div>
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


<div class="panel-body">	
	<div class="table-responsive">
		<div id="example_wrapper" class="dataTables_wrapper">
			<table id="plist" class="table table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?php echo __('Amc Number');?></th>
						<th><?php echo __('Customer Name');?></th>
						<th><?php echo __('Date      ');?></th>
                        <th><?php echo __('Amc Detail');?></th>
						<?php 
						if($this->request->session()->read('user_role') == 'admin'){
					  ?>
                        <th><?php echo __('Assign To');?></th>
						<?php } ?>
						<th><?php echo __('Next Services');?></th>
						<th><?php echo __('Upcoming Services');?></th>
						<th><?php echo __('Status');?></th>
						
						<th><?php echo __('Employee Status');?></th>
						
					  
						<th><?php echo __('Action');?></th>
						
						<th style="display:none"><?php echo 'created_date'; ?></th> 
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('Amc Number');?></th>
						<th><?php echo __('Customer Name');?></th>
						<th><?php echo __('Date');?></th>
                        <th><?php echo __('Amc Detail');?></th>
						<?php 
						if($this->request->session()->read('user_role') == 'admin'){
					  ?>
                        <th><?php echo __('Assign To');?></th>
						<?php } ?>
						<th><?php echo __('Next Services');?></th>
						<th><?php echo __('Upcoming Services');?></th>
                        <th><?php echo __('Status');?></th>
						
					  
						<th><?php echo __('Employee Status');?></th>
						
					
						<th><?php echo __('Action');?></th>
						
						<th style="display:none"><?php echo 'created_date'; ?></th> 
					</tr>
				</tfoot>
				<tbody>
                        
                  <?php
                    if($amclist){
                        foreach($amclist as $amc_info){   
                  ?>
					<tr>
                        <td><?php echo $amc_info['amc_no'];?></td>
                        <td><?php echo $this->AMC->getuser_name($amc_info['customer_id']);?></td>
                        <td><?php echo date($this->Amc->getDateFormat(),strtotime($amc_info['date']));?></td>
                        <td><?php echo $amc_info['subject']; ?></td>
						<?php 
						if($this->request->session()->read('user_role') == 'admin'){
					  ?>
                        <td><?php echo $this->AMC->getEmployeerName($amc_info['assign_to_id']); ?></td>
						<?php } ?>
						<td><?php echo $this->AMC->getnextService($amc_info['amc_id']);?></td>
						<td><?php echo $this->AMC->getupcomeingService($amc_info['amc_id']);?></td>
						
                        <td><?php 
						
						if($amc_info['status'] == 1){
							echo '<label style="padding:10px;" class="label label-success">Open</label>';
						}else if($amc_info['status'] == 0){
							echo '<label style="padding:10px;" class="label label-danger">Close</label>';
						}else if($amc_info['status'] == 2){
							echo '<label style="padding:10px;" class="label label-info">Progress</label>';
						}


						?></td>
						
						
						
						
						
						<td><div class="employee_status_no"> <?php 

                      
                           
                        if($amc_info['employee_status'] == 0){
                            echo '<span style="padding:10px;" class="label  label-danger">'.__('Closed').'</span>';
                        }else if($amc_info['employee_status'] == 1){
                            echo '<span style="padding:10px;" class="label  label-success">'.__('Open').'</span>';
                        }else if($amc_info['employee_status'] == 2){
                            echo '<span style="padding:10px;" class="label  label-info">'.__('Progress').'</span>';
                        }
                            
                           


                        ?></div>
						<?php if($this->request->session()->read('user_role') == 'admin'){ ?>
						<?php if($amc_info['is_appove'] == 1)
						{?>
						<div class="accpt_decline data_decline_<?php echo $amc_info['amc_id']; ?>">
						<div class="accept" apporveid="<?php echo $amc_info['amc_id']; ?>" >Approve</div>
						<div class="decline" declineid="<?php echo $amc_info['amc_id']; ?>">Decline</div>
						</div>
						<?php } ?></td>
						<?php } ?>
						
						
						
						
						
						
						
						
						
						
						
						
						
						<td>
						<?php
						if($this->request->session()->read('user_role') == 'admin'){
						?>
						<a href="<?php echo $this->Url->build(array('controller'=>'amc','action'=>'updateamc',$amc_info['amc_id']))?>" class="btn btn-info">Edit</a>&nbsp;<a url ="<?php echo $this->Url->build(array('controller'=>'amc','action'=>'delete',$amc_info['amc_id']))?>" class="btn btn-danger sa-warning">Delete</a>
						<?php } ?>
						
						
						<button data-toggle="modal" data-target="#myModal" print="<?php echo $amc_info['amc_id']; ?>" class="btn btn-info save" type="submit"><i class="">&nbsp;</i>View</button>
						</td>
						 
						 <?php
						
						if($this->request->session()->read('user_role') == 'employee'){
						?>
						<td>
						<select class="form-control emplooyement_statis" name="status" amcid="<?php echo $amc_info['amc_id']; ?>">
						<option value="1" <?php if($amc_info['employee_status'] == 1){ echo 'selected';} ?>>Open</option>
						<option value="2" <?php if($amc_info['employee_status'] == 2){ echo 'selected';} ?>>Progress</option>
						<option value="0" <?php if($amc_info['employee_status'] == 0){ echo 'selected';} ?>>Closed</option>
						</select>
						</td>
						<?php } ?>
					
						<td style="display:none"><?php echo $amc_info['is_appove']; ?></td> 
						
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
<script>
$(document).ready(function(){
	$('.sa-warning').click(function(){
	  var url =$(this).attr('url');
	 
	 
        swal({   
            title: "Are you sure?", 
			text: "You will not be able to recover this data afterwards!",			
            type: "warning",   
            showCancelButton: true,   
            confirmButtonColor: "#297FCA",   
            confirmButtonText: "Yes, delete!",   
            closeOnConfirm: false 
        }, function(){
			window.location.href = url;
             
        });
    }); 
});
</script>

<script>
jQuery(document).ready(function() {
var table = jQuery('#plist').DataTable({responsive: true,
"order": [[ 8, "desc" ]],
"pagingType": "full_numbers","oLanguage": {
           "oPaginate": {
             "sNext": '<span class="icon-angle-right"></span>',
             "sPrevious": '<span class="icon-angle-left" ></span>'
			
           }
         }});
});
</script>