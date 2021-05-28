
<div class="row">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">

                    <li class="active">
					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Stoke List'),array('controller'=>'Stoke','action' => 'Stokes'),array('escape' => false));
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
			<h4 id="myLargeModalLabel" class="modal-title">Stoke</h4>
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
						<th><?php echo __('#');?></th>
						<th><?php echo __('Product Image');?></th>
						
            <th><?php echo __('Product Name'); ?></th>
            <th>Price (<?php echo $this->AMC->getCurrencyCode(); ?>)</th>
            <th><?php echo __('No Of Stock');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
            <th><?php echo __('#');?></th>
            <th><?php echo __('Product Image');?></th>
          
              <th><?php echo __('Product Name'); ?></th>
            <th>Price (<?php echo $this->AMC->getCurrencyCode(); ?>)</th>
            <th><?php echo __('No Of Stock');?></th>
            <th><?php echo __('Action');?></th>
					</tr>
				</tfoot>
				<tbody>


                  <?php
                    if($stokelist){
					//debug($purchase_row);die();
					$i = 1;
                        foreach($stokelist as $stokelists){
						
                  ?>
					<tr>
                        <td><?php echo $i; ?></td>
                        
						<td><?php echo $this->Html->image('product/'.$this->Amc->getimageofproduct($stokelists['product_id']), ['class' => 'img-circle avatar','id'=>'profileimg','width'=>'40','height'=>'40']); ?></Td>
						<td><?php echo 	$this->Amc->getproductName($stokelists['product_id']); ?></td>
						<td><?php echo 	$this->Amc->getproductPrice($stokelists['product_id']); ?></td>
						<td><?php echo 	$stokelists['number_of_stoke']; ?></td>
                       
                       
                        
						<td>
						<button action="stokedetail" data-toggle="modal" data-target="#myModal" print="<?php echo $stokelists['id']; ?>" class="btn btn-info save" type="submit">View</button>
					
					</td>
						</tr>

           <?php	$i++;
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
       url: '<?php echo $this->Url->build(["controller" => "Stoke","action" => "stokedetail"]);?>',
	
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