<?php
$user_role=$this->request->session()->read('user_role');

?>

<script>
		$(document).ready(function() {
		$('#plist').DataTable();
		});
</script>

	<script type="text/javascript">

$( document ).ready(function(){

    $(".save").click(function(){ 
	   
	   $('.modal-body').html("");
	   
       var str = $(this).attr("print");
	 
       $.ajax({
       type: 'POST',
       url: '<?php echo $this->Url->build(["controller" => "Quotation","action" => "quotationdetail"]);?>',
	
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

<div class="row schooltitle">
				<ul role="tablist" class="nav nav-tabs panel_tabs" style="padding-left:30px;">
					
					     <li class="active">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-list fa-lg')) .__('Quotation List'),array('controller'=>'Quotation','action' => 'quotationlist'),array('escape' => false));
						?>

						<!--	 <i class="fa fa-align-justify"></i>Add Student</a> -->

					  </li>
					  </li>
<?php if($user_role == 'admin' || $user_role == 'employee'){ ?>
					     <li class="">

					<?php  echo $this->Html->link($this->Html->tag('i', '', array('class' => 'fa fa-plus-circle fa-lg')) .__('Add Quotation'),array('controller'=>'Quotation','action' => 'addquotation'),array('escape' => false));
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
						<th><?php echo __('Quotation No');?></th>
						<th><?php echo __('Customer Name');?></th>
						<th><?php echo __('Date');?></th>
                     
                        <th><?php echo __('Email');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th><?php echo __('Quotation No');?></th>
						<th><?php echo __('Customer Name');?></th>
						<th><?php echo __('Date');?></th>
                        <th><?php echo __('Email');?></th>
						<th><?php echo __('Action');?></th>
					</tr>
				</tfoot>






				<tbody>
                        
                    <?php
                        if(isset($quotation_info)){
                        	foreach($quotation_info as $quotation_row){
                    ?>
					<tr>
                        <Td><?php echo $quotation_row['quotation_no']; ?></Td>
                        <td><?php echo $this->AMC->getuser_name($quotation_row['customer_id']); ?></td>
                        <td><?php echo date($this->Amc->getDateFormat(),strtotime($quotation_row['quotation_date'])); ?></td>
                        <td><?php echo $quotation_row['email'];?></td>
						<?php if($user_role == 'admin' || $user_role == 'employee'){   ?>
						<td>
						<!--<?php echo $this->Html->link(__('Edit'),array('action' => '',$quotation_row['quotation_id']),array('class'=>'btn btn-info'))."&nbsp;".$this->Html->link(__('Delete'),array('action' => 'delete',$quotation_row['quotation_id']),['confirm'=>__('Are you sure you wish to Delete this Record?'),'class'=>'btn btn-danger']); ?>-->

						<a href="<?php echo $this->Url->build(array('controller'=>'quotation','action'=>'updatequotation',$quotation_row['quotation_id']))?>" class="btn btn-info">Edit</a>&nbsp;<a url ="<?php echo $this->Url->build(array('controller'=>'quotation','action'=>'delete',$quotation_row['quotation_id']))?>" class="btn btn-danger sa-warning">Delete</a>
						
						<?php 
						echo $this->Form->button($this->Html->tag('i',"&nbsp;", array('class' => '')). __('View'),['action'=>'quotationdetail','data-toggle'=>'modal','data-target'=>'#myModal','print'=>$quotation_row['quotation_id'],'class'=>'btn btn-info save'],['escape' => false])." ";
						
				    	 echo $this->Html->link(__('Convert to Sales'),array('controller'=>'sales','action' => 'sales',$quotation_row['quotation_id']),['class'=>'btn btn-default'])." "; 
						 
						 ?>
						
						
						</td> 
						<?php
						
						
						 }else{?>
						<td>
						<?php 
						
						echo $this->Form->button($this->Html->tag('i',"&nbsp;", array('class' => 'fa fa-user')). __('View'),['action'=>'quotationdetail','data-toggle'=>'modal','data-target'=>'#myModal','print'=>$quotation_row['quotation_id'],'class'=>'btn btn-info save'],['escape' => false])." ";
						
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
	  <div class="modal-header"> 
			<button type="button" class="close" data-dismiss="modal">&times;</button>
			<h4 id="myLargeModalLabel" class="modal-title"><?php echo __('Quotation'); ?></h4>
		</div>
	  
      <div class="modal-body">
		
      </div>
      
	  
    </div>

  </div>
</div>



