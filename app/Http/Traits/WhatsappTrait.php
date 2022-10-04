<?php

namespace App\Http\Traits;

use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait WhatsAppTrait
{
      public function notifyWhatsApp(Request $request)
      {
            if(Request()->ajax()){
                  $input = $request->all();
                  $validator = Validator::make($input, [
                        'message' => 'required'
                  ],[
                        'message.required' => 'Isi pesan tidak boleh kosong.'
                  ]);
                  if($validator->fails()){
                        return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
                  }else{
                        $kirim = $this->kirimWhatsapp($input);
                        if($kirim == ''){
                              return response()->json(['code' > 1, 'msg' => 'Pesan Whatsapp berhasil dikirim.']);
                        }else{
                              return response()->json(['code' > 2, 'msg' => 'Pesan Whatsapp gagal dikirim.']);
                        }
                  }
                  
            }
      }

      protected function kirimWhatsapp($input)
      {
            $twilio = new Client(getenv("TWILIO_SID"), getenv("TWILIO_AUTH_TOKEN"));
            $wa = getenv("TWILIO_WHATSAPP_FROM");
            $number = $input['no_hp'];

            $twilio->messages->create(
                  "whatsapp:$number",
                  [
                        "from" => "whatsapp:$wa",
                        'body' => $input['message']
                  ]
            );

            return '';
      }
}
