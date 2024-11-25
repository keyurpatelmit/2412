<?php $randno = rand() ?>
<tr id="remove_tr_<?= $randno; ?>">
	<td>
	<select data-live-search="true" class="form-control selectpicker" data-style="btn-white"name="attribute_id[]" id="attribute_id_<?= $randno ?>">
		<option value="">Select Attribute</option>
		<?php foreach ($prod_attributes as $key => $prod_attribute): ?>
			<option value="<?= $prod_attribute['id'] ?>"><?= $prod_attribute['title'] ?></option>	
		<?php endforeach ?>
	</select>
	</td>
	<td><input type="text" name="quantity[]"  id="quantity" class="form-control"></td>
	<td><input type="number" name="price[]"  id="price" class="form-control" step="0.01"></td>
	<td><input type="text" name="remark[]"  id="remark" class="form-control"></td>
	<td><button onclick="remove_tr('<?= $randno; ?>')" type="button" class="btn btn-danger  waves-effect waves-light" ><i class="fa fa-minus-circle"></i></button></td>
</tr>