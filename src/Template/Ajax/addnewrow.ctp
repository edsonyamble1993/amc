<tr id="row_id_<?php echo $row_id;?>">
	<td>
		<select name="product[product_id][]" class="form-control select_product" id="product_id_<?php echo $row_id;?>" data-id="<?php echo $row_id;?>" required>
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
		<input type="text" name="product[quantity][]" class="quantity form-control" data-id ="<?php echo $row_id;?>" value="1" id="quantity_<?php echo $row_id;?>" required>
	</td>
	<td>
		<input type="text" name="product[price][]" class="product form-control" data-id ="<?php echo $row_id;?>" value="" id="price_<?php echo $row_id;?>" readonly='true'>
	</td>
	<td>
		<input type="text" name="product[amount][]" class="txtamount form-control" data-id ="<?php echo $row_id;?>" value="" id="amount_<?php echo $row_id;?>" readonly='true'>
	</td>
	
	<td>
		<span class="trash" data-id="<?php echo $row_id;?>"><i class="fa fa-trash"></i> Delete</span>
	</td>
</tr>


