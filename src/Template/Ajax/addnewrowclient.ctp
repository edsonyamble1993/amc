<tr id="row_id_<?php echo $row_id;?>">
	
	<td>
	<input type="hidden" name="contact_person[id][]" placeholder="Enter Name.."  class="quantity form-control" data-id ="<?php echo $row_id;?>"  id="quantity_<?php echo $row_id;?>">
								<input type="text" name="contact_person[name][]" placeholder="Enter Name.." class="quantity form-control" data-id ="<?php echo $row_id;?>"  id="quantity_<?php echo $row_id;?>">
							</td>
							
							<td>
								<input type="text" name="contact_person[mobile][]"  placeholder="Enter Mobile Number.." class="quantity form-control" data-id ="<?php echo $row_id;?>"  id="quantity_<?php echo $row_id;?>">
							</td>
							<td>
								<input type="text" name="contact_person[designation][]"  placeholder="Enter designation.." class="quantity form-control" data-id ="<?php echo $row_id;?>"  id="designation_<?php echo $row_id;?>">
							</td>
	
	<td>
		<span class="trash" data-id="<?php echo $row_id;?>"><i class="fa fa-trash"></i> Delete</span>
	</td>
</tr>


