<?php
use Cake\Datasource\ConnectionManager;
$user_role=$this->request->session()->read('user_role');
$connection = ConnectionManager::get('default');
function getsellproduct($id,$connection){
	$results = $connection->execute("SELECT count(*) as count_product FROM `tbl_sales_history` WHERE `item_name`=20")->fetch('assoc');
	return $results['count_product'];
}

?>

<script>
		$(document).ready(function() {
		$('#plist').DataTable();
		} );
	</script>

<div class="row schooltitle">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					
					     <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Product List'),array('controller'=>'Product','action' => 'productlist'),array('escape' => false));
						?>

						<!--	 <i class="fa fa-align-justify"></i>Add Student</a> -->

					  </li>
<?php if($user_role == 'admin'){
	?>
					     <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Product'),array('controller'=>'Product','action' => 'addproduct'),array('escape' => false));
						?>

						<!--	 <i class="fa fa-align-justify"></i>Add Student</a> -->

					  </li>
					  <li class="active">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-archive')) .__('Archive Product'),array('controller'=>'Product','action' => 'archiveproduct'),array('escape' => false));
						?>

						<!--	 <i class="fa fa-align-justify"></i>Add Student</a> -->

					  </li>
<?php } ?>
					   
				</ul>
</div>

<?php 
	
?>
<div class="panel-body">	
	<div class="table-responsive">
		<div id="example_wrapper" class="dataTables_wrapper">
			<table id="plist" class="table table-striped" cellspacing="0" width="100%">
				<thead>
					<tr>
						<th><?php echo __('Image');?></th>
                        <th><?php echo __('Product Code');?></th>
						<th><?php echo __('Product Name');?></th>
                        <th><?php echo __('Model No');?></th>
                        <th><?php echo __('Price');?></th>
						<!--<th><?php echo __('Remaining Product')?></th>-->
						<th>Action</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('Image');?></th>
                         <th><?php echo __('Product Code');?></th>
						<th><?php echo __('Product Name');?></th>
                        <th><?php echo __('Model No');?></th>
                        <th><?php echo __('Price');?></th>
					<!--<th><?php echo __('Remaining Product')?></th>-->
						<th>Action</th>
					</tr>
				</tfoot>
				<tbody>
                        
                    <?php
                        if($productlist){
                            foreach($productlist as $product_info){      
                    ?>
					<tr>
                        <Td><?php echo $this->Html->image('product/'.$product_info['image'], ['class' => 'img-circle avatar','id'=>'profileimg','width'=>'40','height'=>'40']); ?></Td>
                        <td><?php echo $product_info['product_code'];?></td>
                        <td><?php echo $product_info['item_name'];?></td>
                         <td><?php echo $product_info['model_no'];?></td>
                        <Td><?php echo $product_info['price'].''.$this->AMC->getCurrencyCode();  ?></Td>
						<!-- <Td><?php

					$rem_stock=(int)$product_info['product_qty']-(int)getsellproduct($product_info['product_id'],$connection);
					if($rem_stock <10){
						echo '<span class="label label-danger">'.$rem_stock.'</span>';
					}else if($rem_stock > 10){
						echo '<span class="label label-info">'.$rem_stock.'</span>';
					}

					?></Td>-->
						
						
						<?php if($user_role == 'admin'){
	?>
						<td>
						<?php  $data =  $this->AMC->getCountProduct($product_info['product_id']); ?>
						
						<a url ="<?php echo $this->Url->build(array('controller'=>'Product','action'=>'delete',$product_info['product_id']))?>" class="btn btn-danger <?php if($data == 0){ echo 'sa-warning'; }else{ echo 'notdelete'; } ?>">Delete</a>
						
						<?php }else{?>
						<td>
						<?php echo $this->Html->link(__('View'),array('action' => 'Viewproduct',$product_info['product_id']),array('class'=>'btn btn-info')); ?>
						</td> 
						<?php } ?>
					</tr>
            <?php
                            }
                        }?>
                   
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
	$('.notdelete').click(function(){
	 
	 
        swal({   
            title: "Delete Product", 
			text: "You have added Purchase,Complaint,Quotation,Sales With this product..",			
            type: "warning",   
            
        });
    }); 
});
</script>


