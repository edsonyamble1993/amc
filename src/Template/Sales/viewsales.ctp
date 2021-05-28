
<script>
$(document).ready(function(){
   $('#plist').dataTable();

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
"controller" => "sales",
"action" => "saledetail"]);?>',
	
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
<style>
.custom_field
{
	padding: 7px !important;
}
</style>
<?php $user_role=$this->request->session()->read('user_role'); ?>
<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					<?php if($user_role == 'admin' || $user_role == 'employee'){ ?> 
                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Sales List'),array('controller'=>'sales','action' => 'viewsales'),array('escape' => false));
						?>

					  </li>
					<?php }else{ ?>
					 <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Purchase List'),array('controller'=>'sales','action' => 'viewsales'),array('escape' => false));
						?>

					  </li>
					<?php } ?>
<?php if($user_role == 'admin' || $user_role == 'employee'){ ?>
					   <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Sales'),array('controller'=>'sales','action' => 'sales'),array('escape' => false));
						?>

					  </li>
<?php } ?>
				</ul>
</div>



<div class="panel-body">	
	<div class="table-responsive">
		<div id="example_wrapper" class="dataTables_wrapper">
			<table id="plist" class="table table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?php echo __('Bill Number');?></th>
						<th><?php echo __('Customer Name');?></th>
						<th><?php echo __('Date');?></th>
                        <th><?php echo __('Billing Address');?></th>
                        <th><?php echo __('Status');?></th>
							<?php 
						if($this->request->session()->read('user_role') == 'admin'){
					  ?>
					   <th><?php echo __('Assign To');?></th>
						<?php } ?>
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('Bill Number'); ?></th>
						<th><?php echo __('Customer Name'); ?></th>
						<th><?php echo __('Date'); ?></th>
                        <th><?php echo __('Billing Address'); ?></th>
                        <th><?php echo __('Status'); ?></th>
						<?php 
						if($this->request->session()->read('user_role') == 'admin'){
					  ?>
					   <th><?php echo __('Assign To');?></th>
						<?php } ?>
						<th><?php echo __('Action'); ?></th>
					</tr>
				</tfoot>
				<tbody>
                        
                  <?php
                    if($sales_row){
                        foreach($sales_row as $sales_info){   
                  ?>
				  <tr>
                        <td><?php echo $sales_info['bill_number'];?></td>
                        <td><?php echo $this->AMC->getuser_name($sales_info['customer_id']);?></td>
                        <td><?php echo date($this->Amc->getDateFormat(),strtotime($sales_info['date']));?></td>
                        <td><?php echo $sales_info['address']; ?></td>
                        <td><?php echo ucfirst($sales_info['status']); ?></td>
						<?php 
						if($this->request->session()->read('user_role') == 'admin'){
					  ?>
					   <td><?php echo $this->AMC->getEmployeerName($sales_info['assign_to']); ?></td>
					  <?php } ?>
						<?php if($user_role == 'admin'){   ?>
						<td>
						<a href="<?php echo $this->Url->build(array('controller'=>'Sales','action'=>'updatesales',$sales_info['sales_id']))?>" class="btn btn-info">Edit</a>&nbsp;<a url ="<?php echo $this->Url->build(array('controller'=>'Sales','action'=>'delete',$sales_info['sales_id']))?>" class="btn btn-danger sa-warning">Delete</a>
						
						<?php 
						echo $this->Form->button($this->Html->tag('i',"&nbsp;", array('class' => '')). __('View'),['action'=>'saledetail','data-toggle'=>'modal','data-target'=>'#myModal','print'=>$sales_info['sales_id'],'class'=>'btn btn-info save'],['escape' => false])." ";
						
						 ?>
						</td> 
						<?php }else{?>
						<td>
						<?php 
						echo $this->Form->button($this->Html->tag('i',"&nbsp;", array('class' => 'fa fa-user')). __('View'),['action'=>'saledetail','data-toggle'=>'modal','data-target'=>'#myModal','print'=>$sales_info['sales_id'],'class'=>'btn btn-info save'],['escape' => false])." ";
						
						 ?>
						</td> 
						<?php } ?>
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

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
	  <div class="modal-header"> 
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 id="myLargeModalLabel" class="modal-title"><?php echo __('Sales'); ?></h4>
		</div>
      <div class="modal-body">
		
      </div>
      
	  
   
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





