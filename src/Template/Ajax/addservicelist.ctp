<script>
$(document).ready(function(){

	$(".service_date").datepicker({
         dateFormat: "yy-mm-dd",
         changeMonth: true,
	        changeYear: true
	});
	
	$(".summary_text").click(function(){
		
		$(this).select();
	
	});

	

});



	
</script>
<div class="form-group">
<table class="table table-borderd" style="width:60em" align="center">
<thead>
	<tr>
		<th>No.</th>
		<th>Service Date</th>
		<th>Note</th>
	</tr>
<thead>

<tbody>
	<?php 
		
		if(isset($service_count)){
			$i=1;
		foreach($service_count as $service_key=>$service_val){
		?>
		
		<tr>
		<td><?php echo $i;?></td>
		<td><input type="text" name="service[service_date][]" value="<?php echo $service_key;?>" class="form-control service_date"></td>
		<td><input type="text" name="service[service_text][]" value="<?php echo $service_val?>" class="form-control summary_text"></td>
	</tr>
		
		
		
		<?php
		$i++;
			}
		
		}
		
	?>
	
	</tbody>

</table>

</div>