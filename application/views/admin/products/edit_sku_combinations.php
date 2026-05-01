<?php if(count($combinations) > 0){ ?>
<table class="table table-bordered aiz-table">
	<thead>
		<tr>
			<td class="text-center">
				Variant
			</td>
			<td class="text-center">
				Variant Price
			</td>
			<td class="text-center">
				Discount Price
			</td>
			<td class="text-center" data-breakpoints="lg">
				SKU
			</td>
			<td class="text-center" data-breakpoints="lg">
				Qty
			</td>
			<td class="text-center" data-breakpoints="lg">
				Photo
			</td>
		</tr>
	</thead>
	<tbody>
	<?php foreach ($combinations as $key => $combination){ 
			$sku = '';
// 			$str = '';
			foreach (explode(' ', $product_name) as $key => $value) {
				$sku .= substr($value, 0, 1);
				// $str .= substr($value, 0, 1);
			}

			$str = '';
			foreach ($combination as $key => $item){
				if($key > 0 ){
					$str .= '-'.str_replace(' ', '', $item);
					$sku .='-'.str_replace(' ', '', $item);
				}
				else{
					
					$str .= str_replace(' ', '', $item);
					$sku .='-'.str_replace(' ', '', $item);
					
				}
			}
		if(strlen($str) > 0){
		    $data_stock = $this->db->query("SELECT * FROM app_product_stocks WHERE product_id = '$product_id' && variant = '$str'")->row_array();
		?>
			<tr class="variant">
				<td>
					<label for="" class="control-label"><?=$str;?></label>
				</td>
				<td>
					<input type="number" lang="en" name="price_<?=$str;?>" value="<?php if($data_stock) { echo $data_stock['price'];} ?>" step="0.01" class="form-control" required>
				</td>
				<td>
					<input type="number" lang="en" name="discount_<?=$str;?>" value="<?php if($data_stock) { echo $data_stock['discount'];} ?>" step="0.01" class="form-control" required>
				</td>
				<td>
					<input type="text" name="sku_<?=$str;?>" value="<?php if($data_stock) { echo $data_stock['sku'];} ?>" required class="form-control" required>
				</td>
				<td>
					<input type="text" name="qty_<?=$str;?>" value="<?php if($data_stock) { echo $data_stock['qty'];} ?>" required class="form-control" required>
				</td>
				<td>
				    <div class="imgUp">
				        <input name="oldimg_<?=$str;?>" type="hidden" value="<?php if($data_stock) { if($data_stock['image']!=''){ echo $data_stock['image']; }} ?>"/>
                        <div class="imagePreview" style="<?php if($data_stock) { if($data_stock['image']!=''){ echo 'background-image: url('.base_url().'uploads/products/'.$data_stock['image'].');'; }} ?>"></div>
                        <label class="btn btn-upload btn-primary">
    			            Change<input type="file" class="uploadFile img" id="img_<?=$str;?>" name="img_<?=$str;?>" accept=".jpg,.jpeg,.png,.gif" value="Change Photo" style="width: 0px;height: 0px;overflow: hidden;">
                        </label>
                    </div>
				
				</td>
			</tr>
	<?php }} ?>
	</tbody>
</table>
<?php } ?>