<?php if(count($combinations) > 0) { if(count($combinations[0]) > 0){ ?>
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
		if(strlen($str) > 0){ ?>
			<tr class="variant">
				<td>
					<label for="" class="control-label"><?=$str;?></label>
				</td>
				<td>
					<input type="number" lang="en" name="price_<?=$str;?>" value="<?=$unit_price;?>" step="0.01" class="form-control" required>
				</td>
				<td>
					<input type="number" lang="en" name="discount_<?=$str;?>" step="0.01" class="form-control">
				</td>
				<td>
					<input type="text" name="sku_<?=$str;?>" value="" required class="form-control" required>
				</td>
				<td>
					<input type="text" name="qty_<?=$str;?>" value="" required class="form-control" required>
				</td>
				<td>
				    <input type="file" class="form-control" name="img_<?=$str;?>" accept="image/*" id="img_<?=$str;?>" >
				
				</td>
			</tr>
	<?php }} ?>
	</tbody>
</table>
<?php }} ?>