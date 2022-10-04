<?php

namespace App\Http\Traits;

use Twilio\Rest\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

trait MessageTrait
{
      public function __invoke(Request $request)
      {
            if(Request()->ajax()){
                  $input = $request->all();
                  $validator = Validator::make($input, [
                        'message' => 'required',
                  ], [
                        'message.required' => 'Pesan SMS tidak boleh kosong.'
                  ]);

                  if ($validator->fails()) {
                        return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
                  } else {
                        $kirim = $this->kirimSMSPemberitahuan($input);
                        if($kirim == ''){
                              return response()->json(['code' => 1, 'msg' => 'Pesan SMS Berhasil Dikirim.']);
                        }else{
                              return response()->json(['code' => 2, 'msg' => 'Pesan SMS Gagal Dikirim.']);
                        }
                  }
            }
      }

      protected function kirimSMSPemberitahuan($input)
      {
            $client = new Client(getenv("TWILIO_SID"), getenv("TWILIO_AUTH_TOKEN"));
            $number = $input['no_hp'];

                  $client->messages->create(
                        $number,
                        [
                              'from' => getenv("TWILIO_NUMBER"),
                              'body' => $input['message']
                        ]
                  );
            
            return '';
      }
}
