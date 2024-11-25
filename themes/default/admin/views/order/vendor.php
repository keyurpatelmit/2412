<?php 

foreach (explode(',',$this->data['row']->vendor_ids) as $vendorid) {	
	$vendor_name = $this->sam->get_real_value('sam_customers','id',$vendorid,'name');
?>

<ul style="list-style: none;padding: 0px;">
	<li>
		<a target="blank" href='<?= base_url("admin/order/po_pdf/{$this->data['row']->id}/{$vendorid}"); ?>'><button class="btn btn-icon btn-xs waves-effect waves-light btn-primary" data-toggle="tooltip" data-placement="left" title="" data-original-title="<?= lang('puchase order'); ?>" style="width: 100%;padding: 9px;font-size: 14px;"> <?= $vendor_name?> <i class="fa fa-file-pdf-o"></i> </button></a>
	</li>
</ul>

<?php } ?>

