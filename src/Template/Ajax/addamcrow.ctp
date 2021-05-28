<tr id="row_id_<?php echo $row_id;?>">
	<td>
		<select name="product[product_id][]" class="form-control select_product" id="product_id_<?php echo $row_id;?>" data-id="<?php echo $row_id;?>">
			<option value=""><?php echo __('--Select Product--');?></option>
			<?php  
			foreach($productlist as $retrive_data)
			{
				echo '<option value="'.$retrive_data['product_id'].'">'.$retrive_data['product_code'].' '.$retrive_data['item_name'].'</option>';
			}
			?>						
		</select>
	</td>
	
	
							
							<td>
								<input type="text" name="product[note][]" class=" form-control" data-id ="<?php echo $row_id;?>" value="" id="note_<?php echo $row_id;?>">
							</td>
							
	
	
	<td>
		<span class="trash" data-id="<?php echo $row_id;?>"><i class="fa fa-trash"></i> Delete</span>
	</td>
</tr>


