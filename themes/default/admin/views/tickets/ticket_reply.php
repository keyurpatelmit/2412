<div class="col-md-12">
	<div class="table-responsive" data-pattern="priority-columns">
	<table id="tech-companies-1" class="table  table-striped">
		<thead>
			<th>User Type</th>
			<th>User name</th>
			<th>Customer Name</th>
			<th>Reply</th>
			<th>Date</th>
		</thead>	 
	    <tbody>
		
	        <?php if(!empty($this->data['row'])) { ?>
			<?php $count = 1; foreach ($this->data['row'] as $row) : ?>
			<tr>
				<td> <?= @$row['user_type']; ?></td>
				<td><?= $this->sam->get_real_value('sam_users','id',$row['user_id'],'name') ?></td>
				<td><?= $this->sam->get_real_value('sam_customers','id',$row['customer_id'],'name') ?></td>
				<td><?= @$row['reply']; ?></td>
				<td><?= date('j M Y g:i A', strtotime($row['inserted_time'])) ?></td>
				
			</tr>
			<?php endforeach; ?>
			<?php } else { ?>
			    <tr>
			        <td colspan="6" class="text-center">No History Found</td>
			    </tr>
			<?php } ?>
		</tbody>
		</table>
	</div>
</div>

<div class="row">
<div class="col-md-12">

	<div class="modal-header"> 
		<h4 class="modal-title" id="myLargeModalLabel">&nbsp;&nbsp;&nbsp;Tickets Reply</h4>
	</div>
</div>
	<div class="col-md-12">
		<br>
	
	<div class="col-md-12">
		<div class="form-group">
			<label for="transaction_no">Ticket Reply<span class="text-danger">*</span></label>
			<textarea name="ticket_reply" id="ticket_reply" class="form-control" required="required"></textarea>
		</div>
	</div>

	<div class="col-md-4">
        <div class="form-group">
            <label for="name">Tickets status<span class="text-danger">*</span></label>
            <select  data-live-search="true" name="reply_tickets_status_id" id="reply_tickets_status_id" class="selectpicker form-control"  data-style="btn-white" required="required">
                <option value="">Select Tickets status</option>
                <?php foreach ($this->data['tickets_status'] as $key => $ticketsstatus): ?>
                <option <?php if($this->data['ticket_details']->tickets_status_id == $ticketsstatus['id']) { echo "selected"; } ?> value="<?= $ticketsstatus['id']; ?>"><?= $ticketsstatus['title']; ?></option>   
                <?php endforeach ?>
            </select>
        </div>
    </div>  

	</div>
</div>