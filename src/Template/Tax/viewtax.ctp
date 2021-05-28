<?php 
use Cake\Routing\Router;
?>  
 




<script>
$(document).ready(function(){
	$('#plist').dataTable();

});
</script>

<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					 
                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('View Tax'),array('controller'=>'tax','action' => 'viewtax'),array('escape' => false));
						?>

					  </li>

					  
				
					
					 
					   <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Tax'),array('controller'=>'tax','action' => 'addtax'),array('escape' => false));
						?>

					  </li>
					
					<li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('View Income Tax Code'),array('controller'=>'tax','action' => 'viewcode'),array('escape' => false));
						?>

					  </li>
						
					<li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Income Tax Code'),array('controller'=>'tax','action' => 'internationcode'),array('escape' => false));
						?>

					  </li>
				</ul>
</div>



<div class="panel-body">	
	<div class="table-responsive">
		<div id="example_wrapper" class="dataTables_wrapper">
			<table id="plist" class="table table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?php echo __('Account Tax Name');?></th>
						
						<th><?php echo __('Account Tax');?></th>
						
						
						
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('Account Tax Name');?></th>
						
						<th><?php echo __('Account Tax');?></th>
						
						
						
						<th><?php echo __('Action');?></th>
					</tr>
				</tfoot>
				<tbody>
                        
                  <?php
                    if($taskdatalist){
                        foreach($taskdatalist as $task_info){   
                  ?>
					<tr>
                        
                       
					 
					   
						
						
						
						
							<td><?php echo $task_info['acount_tax_name']; ?></td>
							<td><?php echo $task_info['tax'].' %'; ?></td>
						<td>
						<a href="<?php echo $this->Url->build(array('controller'=>'Tax','action'=>'addtax',$task_info['id']))?>" class="btn btn-info">Edit</a>&nbsp;<a url ="<?php echo $this->Url->build(array('controller'=>'Tax','action'=>'delete',$task_info['id']))?>" class="btn btn-danger sa-warning">Delete</a>
						</td>
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
	$('.accept').click(function(){
					var  apporveid = $(this).attr('apporveid');
					$('.data_decline_'+apporveid).fadeOut();
					$.ajax({
										type: 'POST',
                      					url: '<?php echo $this->Url->build(["controller" => "Task","action" => "approvestatus"]);?>',
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
                      					url: '<?php echo $this->Url->build(["controller" => "Task","action" => "declineidstatus"]);?>',
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







