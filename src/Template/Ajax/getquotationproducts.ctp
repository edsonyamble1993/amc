
<?php
				if(isset($qh_histroy) && !empty($qh_histroy)){
					
					
				?>
				
				
				<?php $row_id = 0;?>
					<?php 
						foreach($qh_histroy as $qh_row){
					?>
				
						<tr id="row_id_<?php echo $row_id;?>">
							<td>
								<select name="product[product_id][]" class="form-control select_product" id="product_id_<?php echo $row_id;?>" data-id="<?php echo $row_id;?>">
									<option value=""><?php echo __('--Select Product--');?></option>
									<?php  
											if($productlist){
												foreach($productlist as $product_info){
											?>

			<option value="<?php echo $product_info['product_id']?>" <?php 
								if($qh_row['item_name'] == $product_info['product_id']){
													echo 'selected="selected"';
												}
								
						
			
				?> ><?php echo $product_info['product_code'].' '.$product_info['item_name']; ?></option>

										<?php
									}
								}
									?>							
								</select>
							</td>
							
							<td>
							<input type="text" name="product[quantity][]" class="quantity form-control" data-id ="<?php echo $row_id;?>" value="<?php echo $qh_row['qty']; ?>" id="quantity_<?php echo $row_id;?>">
							</td>
							<td>
								<input type="text" name="product[price][]" class="product form-control" data-id ="<?php echo $row_id;?>" value="<?php echo $qh_row['price']?>" id="price_<?php echo $row_id;?>" readonly='true'>
							</td>
							<td>
								<input type="text" name="product[amount][]" class="product form-control" data-id ="<?php echo $row_id;?>" value="<?php echo $qh_row['net_amount']; ?>" id="amount_<?php echo $row_id;?>" readonly='true'>
							</td>
						
							<td>
								<span class="trash" data-id="<?php echo $row_id;?>"><i class="fa fa-trash"></i> Delete</span>
								
							</td>
						</tr>
				
				
				
				
				<?php
				   $row_id++;
					}
					}
					?>
				