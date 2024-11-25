<div class="table-responsive" data-pattern="priority-columns">
<table id="tech-companies-1" class="table  table-striped">
	<thead>
		<th width="5%">#</th>                			
		<th>Amount</th>
		<th>Transaction Type</th>
		<th>Transaction No</th>
		<th>Transaction Date</th>
	</thead>	 
    <tbody>
	
        <?php if(!empty($this->data['row'])) { ?>
		<?php $count = 1; foreach ($this->data['row'] as $row) : ?>
		<tr>
			<td><?= $count++; ?></td>	        					
			<td><i class="fa fa-inr"></i> <?= @$row['amount']; ?></td>
			<td><?= @$row['transaction_type']; ?></td>
			<td><?= @$row['transaction_no']; ?></td>
			<td><?= date('d-m-Y', strtotime(@$row['transaction_date']))  ?></td>
			
		</tr>
		<?php endforeach; ?>
		<?php } else { ?>
		    <tr>
		        <td colspan="5" class="text-center">No Payment Found</td>
		    </tr>
		<?php } ?>
	</tbody>
	</table>
</div>


<div class="modal-header"> 
<h4 class="modal-title" id="myLargeModalLabel">Add Details</h4>
</div>

	<div class="col-md-4">
		<div class="form-group">
			<label for="transaction_type">Transaction Type<span class="text-danger">*</span></label>
			<select data-live-search="true" class="selectpicker form-control" data-style="btn-white" name="transaction_type" id="transaction_type">
				<option value="">-Select Transaction Type-</option>
				<?php foreach($transaction_type as $type):?>
					<option value="<?= $type;?>"><?= $type?></option>
				<?php endforeach;?>
			</select>
		</div>
	</div>	              				
	<div class="col-md-4">
		<div class="form-group">
			<label for="monthly_amount">Amount<span class="text-danger">*</span></label>
			<input type="number" name="amount" id="amount" class="form-control" required="required" placeholder="Amount">
		</div>
	</div>  
	
	<div class="col-md-4">
		<div class="form-group">
			<label for="transaction_no">Transaction No<span class="text-danger">*</span></label>
			<input type="text" name="transaction_no" id="transaction_no" class="form-control" required="required" placeholder="Transaction No">
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="transaction_date">Transaction Date<span class="text-danger">*</span></label>
			<input type="text" name="transaction_date" id="transaction_date" class="default_date form-control" required="required" >
		</div>
	</div>   