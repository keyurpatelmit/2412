<table class="table "  border=0  cellpadding="30px" id="demo_view_table">
    <tr>
        <td colspan="4" class="bg_table text-center">API details</td>
    </tr>
    
    <tr>
        <td> Title</td>
        <td><?= $this->data['row']->title; ?></td>
        
    </tr>
    <tr>
        <td >Method</td>
        <td><?= $this->data['row']->method; ?></td>
        
    </tr>    

     <tr>
        <td>Action URL</td>
        <td><?= $this->data['row']->action_url; ?></td>        
        
    </tr>

    <tr>
        <td>Params</td>
        <td><?= $this->data['row']->params; ?></td>
    </tr>

    <tr>
        <td>Mandatory Fields</td>
        <td><?= $this->data['row']->mendetory_fileds; ?></td>
    </tr>

    <tr>
        <td>Description</td>
        <td><?= $this->data['row']->description; ?></td>
        
    </tr>
   

    <tr>
        <td colspan="4" class="bg_table"><h3>Updated API</h3> </td>
    </tr>    

    <tr>
        <td colspan="4" class=" text-center">
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                       <textarea class="form-control" name="comments" id="comments" required="required" placeholder="Comment here.."></textarea>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                    <input class="form-control" type="text" name="comment" id="comment" required="required" placeholder="Your name">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <button type="submit" id="save" class="btn btn-success waves-effect waves-light">Sent</button>
                    </div>
                </div>
            </div>
        </td>
    </tr>

    
    
</table>
