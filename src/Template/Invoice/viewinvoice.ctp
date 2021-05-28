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
"controller" => "Invoice",
"action" => "invoicedetail"]);?>',
	
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
<?php
$user_role=$this->request->session()->read('user_role');
?>
<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					 
                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Invoice List'),array('controller'=>'Invoice','action' => 'viewinvoice'),array('escape' => false));
						?>

					  </li>
<?php if($user_role == 'admin'){
?>
					   <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Invoice'),array('controller'=>'Invoice','action' => 'addinvoice'),array('escape' => false));
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
						<th><?php echo __('Invoice Number');?></th>
						<th><?php echo __('Customer Name');?></th>
						<th><?php echo __('Date');?></th>
                        <th><?php echo __('Billing Address');?></th>
                       
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('Invoice Number'); ?></th>
						<th><?php echo __('Customer Name'); ?></th>
						<th><?php echo __('Date'); ?></th>
                        <th><?php echo __('Billing Address'); ?></th>
                       
						<th><?php echo __('Action'); ?></th>
					</tr>
				</tfoot>
				<tbody>
                        
                  <?php
                    if($invoice_row){
                        foreach($invoice_row as $invoice_info){   
                  ?>
					<tr>
                        <td><?php echo $invoice_info['invoice_no'];?></td>
                        <td><?php echo $this->AMC->getuser_name($invoice_info['customer_id']);?></td>
                        <td><?php echo date($this->Amc->getDateFormat(),strtotime($invoice_info['date']));?></td>
                        <td><?php echo $invoice_info['address']; ?></td>
                        <?php if($user_role == 'admin'){   ?>
						<td>
						<?php echo $this->Html->link(__('Edit'),array('action' => 'updateinvoice',$invoice_info['invoice_id']),array('class'=>'btn btn-info'))."&nbsp;".$this->Html->link(__('Delete'),array('action' => 'delete',$invoice_info['invoice_id']),['confirm'=>__('Are you sure you wish to Delete this Record?'),'class'=>'btn btn-danger']); ?></td>
						<?php }else{?>
						<td>
						<?php 
						echo $this->Form->button($this->Html->tag('i',"&nbsp;", array('class' => 'fa fa-user')). __('View'),['action'=>'saledetail','data-toggle'=>'modal','data-target'=>'#myModal','print'=>$invoice_info['invoice_id'],'class'=>'btn btn-default save'],['escape' => false])." ";
						
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
			<h4 id="myLargeModalLabel" class="modal-title"><?php echo __('Invoice'); ?></h4>
		</div>
      <div class="modal-body">
		
      </div>
      
	  
   
</div>
  </div>
</div>






