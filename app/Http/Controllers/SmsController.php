<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointement;
use Infobip\Configuration;
use Infobip\ApiException;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Api\SmsApi;
class SmsController extends Controller
{
    

    public function showForm($appointementId)
    {
        $appointements = Appointement::findOrFail($appointementId);
        return view('send-sms', compact('appointements'));
    }
    public function sendSms(Request $request){

        $appointements = Appointement::findOrFail($request->appointement_id);
   
     
        $configuration = new Configuration(
            host: 'mmndg9.api.infobip.com',
            apiKey: 'a6dd08b285b8807e1bd356d142a1f1c0-f6e57ce8-d2cd-405f-83f2-bf41d715eef6',
        );
        $sendSmsApi = new SmsApi(config: $configuration);

        $message = new SmsTextualMessage(
            destinations: [
                new SmsDestination(to: $request->phone_number)
            ],
            from: 'AK-ASSIST-MEDICALE',
            text: $request->message
        );
    
        $request = new SmsAdvancedTextualRequest(messages: [$message]);
    
        try {
            $smsResponse = $sendSmsApi->sendSmsMessage($request);
          
            return redirect()->route('send-sms-form', ['appointement' => $appointements->id])->with('status', 'SMS envoyé avec succès');


        } catch (ApiException $apiException) {
            return redirect()->route('send-sms-form',['appointement' => $appointements->id])->with('Fail', $apiException->getMessage());
        }
    }
}
