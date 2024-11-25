  <?php 
   
   public function customize_theater(Request $oRequest)
   {
        $is_Exist  = Customize_your_theatre::where('mobile_no', $oRequest->mobile_no)->where('delete_status','1')->first();
        if($is_Exist)
        {
            $GetEventGallery = EventGallery::where('fk_id_event',$Getvent->id_event)->get();
            return response()->json([ 'data' => $is_Exist,'success' => true,'msg'=>'This Customer Already Exist Please check Customize Theater Details']);
        }else{
             $Customize_your_theatre = Customize_your_theatre::create($oRequest->all());  

            if($Customize_your_theatre){
                 return response()->json(['status' => 'success','msg'=>'New Customer Customize theater Details Success Added']);
            }else{
                return response()->json([ 'status' => 'Fail','msg' => 'Something Wrong !']);
            }
        }

        
     }

