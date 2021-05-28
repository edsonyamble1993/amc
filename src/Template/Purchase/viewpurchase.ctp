<script>
$(document).ready(function(){
   $('#plist').dataTable();

});
</script>
<style>
footer {
  position: absolute;
  right: 0;
  bottom: -35px;
  left: 0;
  padding: 1rem;
  background-color: #F1F4F9;
  text-align: center;
}
</style>
<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">

                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Purchase List'),array('controller'=>'Purchase','action' => 'viewpurchase'),array('escape' => false));
						?>

					  </li>

					   <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Purchase'),array('controller'=>'Purchase','action' => 'purchase'),array('escape' => false));
						?>

					  </li>

				</ul>
</div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
	  <div class="modal-header"> 
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 id="myLargeModalLabel" class="modal-title">Purchase</h4>
		</div>
	  
      <div class="modal-body">
		
      </div>
      
	  
    </div>

  </div>
</div>
<div class="panel-body">
	<div class="table-responsive">
		<div id="example_wrapper" class="dataTables_wrapper">
			<table id="plist" class="table table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?php echo __('Purchase No');?></th>
						<th><?php echo __('Supplier Name');?></th>
						
            <th><?php echo __('Date'); ?></th>
            <th><?php echo __('Billing Address');?></th>
            <th><?php echo __('Status');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
            <th><?php echo __('Purchase No');?></th>
            <th><?php echo __('Supplier Name');?></th>
          
              <th><?php echo __('Date'); ?></th>
            <th><?php echo __('Billing Address');?></th>
            <th><?php echo __('Status');?></th>
            <th><?php echo __('Action');?></th>
					</tr>
				</tfoot>
				<tbody>


                  <?php
                    if($purchase_row){
					//debug($purchase_row);die();
                        foreach($purchase_row as $purchase_info){
						
                  ?>
					<tr>
                        <td><?php echo $purchase_info['purchase_no'];?></td>
                        <td><?php echo $this->Amc->getSupplierName($purchase_info['supplier_id']);?></td>
                      
                        <td><?php echo date($this->Amc->getDateFormat(),strtotime($purchase_info['purchase_date']));?></td>
                        <td><?php echo $purchase_info['billing_address']; ?></td>
                        <td>
                        	<?php echo ucfirst($this->Amc->getdatafromcategory($purchase_info['status']));?>
                        	<!--<?php echo $purchase_info['status']; ?>-->
                        </td>
						<td>
						<a href="<?php echo $this->Url->build(array('controller'=>'purchase','action'=>'updatepurchase',$purchase_info['purchase_id']))?>" class="btn btn-info">Edit</a>&nbsp;<a url ="<?php echo $this->Url->build(array('controller'=>'purchase','action'=>'delete',$purchase_info['purchase_id']))?>" class="btn btn-danger sa-warning">Delete</a>
						<button action="purchasedetail" data-toggle="modal" data-target="#myModal" print="<?php echo $purchase_info['purchase_id']; ?>" class="btn btn-info save" type="submit">View</button>
					
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
});
</script>
<script type="text/javascript">

$( document ).ready(function(){

    $(".save").click(function(){ 
	   
	   $('.modal-body').html("");
	   
       var str = $(this).attr("print");
	
       $.ajax({
       type: 'POST',
       url: '<?php echo $this->Url->build(["controller" => "Purchase","action" => "purchasedetail"]);?>',
	
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