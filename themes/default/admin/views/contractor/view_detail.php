
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
        <td colspan="5" class="bg_table text-center">Contractor Details</td>
    </tr>
   
            <tr>
                <td width="30%">Employee Name</td>
                <td><?= $this->sam->get_real_value('sam_users','id',$this->data['row']->created_by_user_id,'name') ?></td>
                <td width="30%">Customer Name</td>
                <td><?php 
                $customer_ids = explode(',', $this->data['row']->customer_id); 
                $customer_names = [];
                    foreach ($customer_ids as $id) { 
                            $customer_name = $this->sam->get_real_value('sam_customers', 'id', $id, 'name');
                            if ($customer_name) {
                                $customer_names[] = $customer_name;
                            }
                        }
                        echo implode(', ', $customer_names);
                        ?> 
                </td>
            </tr>
            <tr>
               
                <td width="30%">Contractor Name</td>
                <td><?= $this->data['row']->name; ?></td>
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
                
                <td width="30%"><?= lang('Reference_by'); ?></td>
                <td><?= $this->data['row']->reference_by; ?></td>
                <td width="30%"><?= lang('GST No'); ?></td>
                <td><?= $this->data['row']->gst_no; ?></td>
            </tr>
           <tr>
                
                <td width="30%"><?= lang('Pin Code'); ?></td>
                <td><?= $this->data['row']->pin_code; ?></td>
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
