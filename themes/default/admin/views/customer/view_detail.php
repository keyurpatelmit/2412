
<style>
#demo_view_table tr td:nth-child(3) {
    text-transform: uppercase;
    font-weight: 600;
}

#demo_view_table tr td:nth-child(1) {
    text-transform: uppercase;
    font-weight: 600;
}
.bg_table {
    background: darkgray !important;
    color: white !important;
}
.bg_table_tr {
    background: black;
    color: white;
}
#demo_view_table {
    font-family: monospace;
    font-size: 16px;
}
.modal-dialog {
    width: 1150px;
    margin: 30px auto; 
}
</style>
<table class="table " border=0 cellpadding="30px" id="demo_view_table">
    
     <tr>
        <td colspan="4" class="bg_table text-center">Employee details</td>
    </tr>
   
            <tr>
                <td width="30%">Employee Name</td>
                <td><?= $this->sam->get_real_value('sam_users','id',$this->data['row']->created_by_user_id,'name') ?></td>
            </tr>
            <tr>
                <td width="30%">Customer Category</td>
                <td><?= $this->sam->get_real_value('tech_customer_category','id',$this->data['row']->customer_category_id,'title') ?></td>
                <td width="30%">Customer Name</td>
                <td><?= $this->data['row']->name; ?></td>
            </tr>
            <tr>
                
                <td width="30%"><?= lang('Customer_code'); ?></td>
                <td><?= $this->data['row']->customer_code; ?></td>
                    <td width="30%"><?= lang('Address'); ?></td>
                <td><?= $this->data['row']->address; ?></td>
            </tr>
           
            <tr>
            
                <td width="30%"><?= lang('Mobile Number'); ?></td>
                 <td><?= $this->data['row']->mobile; ?></td>
                 <td width="30%"><?= lang('Email'); ?></td>
                 <td><?= $this->data['row']->email; ?></td>
            </tr>
             <tr>
            
        <td width="30%"><?= lang('Service Category'); ?></td>
        <td><?= $this->sam->get_real_value('tech_service','id',$this->data['row']->service_id,'title') ?></td>
        <td width="30%"><?= lang('Product Category'); ?></td>
        <td><?= $this->sam->get_real_value('zyd_products_mst','id',$this->data['row']->product_id,'product_name') ?></td>
    </tr>
            
            
</table>
<table class="table table-striped" border=0 cellpadding="30px" id="demo_view_table">
     <tr>
         <td colspan="6" class="bg_table text-center">Address Details</td>
    </tr>
     <tr>
        <td width="30%"><?= lang('Description / Note'); ?></td>
        <td><?= $this->data['row']->description_note; ?></td>
        <td width="30%"><?= lang('Reference_by'); ?></td>
        <td><?= $this->data['row']->reference_by; ?></td>
    </tr>
    <tr>
         <td width="30%"><?= lang('GST No'); ?></td>
            <td><?= $this->data['row']->gst_no; ?></td>    
        <td width="30%"><?= lang('Pan No'); ?></td>
        <td><?= $this->data['row']->pan_no; ?></td>
    </tr>
     
</table>
            



<?php if(!empty($this->data['addresses'])) {  ?>
<table class="table table-striped" border=0 cellpadding="30px" id="demo_view_table">
     <tr>
         <td colspan="6" class="bg_table text-center">Address Details</td>
    </tr>
    <tr class="bg_table_tr">
         <td>Address Name</td>
         <td>Address</td>
         <td>State</td>
         <td>City</td>
         <td>zip code</td>
    </tr>
    <?php   
        foreach ($this->data['addresses'] as $key => $address) {
        $rand = rand(99999,00000)
    ?>
    <tr>
         <td><?= $address['cust_address_name'] ?></td>
         <td><?= $address['cust_address'] ?></td>
         <td><?= $this->sam->get_real_value('zyd_state','id',$address['cust_state_id'],'state') ?></td>
         <td><?= $this->sam->get_real_value('zyd_city','id',$address['cust_city_id'],'city') ?></td>
         <td><?= $address['cust_zip_code'] ?></td>
    </tr>
     <?php
          }
     ?>
     
</table>
            
<?php } ?>
<!-- 
<?php if(!empty($this->data['contacts'])) {  ?>
<table class="table table-striped" border=0 cellpadding="30px" id="demo_view_table">
     <tr>
         <td colspan="6" class="bg_table text-center">Contact Details</td>
    </tr>
    <tr class="bg_table_tr">
         <td>Contact Name</td>
         <td>Designation</td>
         <td>Phone</td>
         <td>Email</td>
    </tr>
    <?php   
        foreach ($this->data['contacts'] as $key => $contact) {
        $rand = rand(99999,00000)
    ?>
    <tr>
         <td><?= $contact['contact_persons'] ?></td>
         <td><?= $this->sam->get_real_value('zyd_designation','id',$contact['designations_id'],'title') ?></td>
         <td><?= $contact['mobile'] ?></td>
         <td><?= $contact['email'] ?></td>
    </tr>
     <?php
          }
     ?>
     
</table>
            
<?php } ?>
 -->