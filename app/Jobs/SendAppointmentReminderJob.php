<?php

namespace App\Jobs;

use App\Models\Appointement;
use Infobip\Configuration;
use Infobip\ApiException;
use Infobip\Model\SmsAdvancedTextualRequest;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Api\SmsApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class SendAppointmentReminderJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $appointement;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Appointement $appointement)
    {
        $this->appointement = $appointement;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $configuration = new Configuration(
            host: 'ggp9ne.api.infobip.com',
            apiKey: 'cedcc76a7f9330abbb8f7d140efe6cb8-a610c4eb-8454-41c9-9b98-33253c6ce79c'
        );
        $sendSmsApi = new SmsApi(config: $configuration);
    
        $patient = $this->appointement->patient;
        $message = "Bonjour {$patient->prenom} {$patient->nom}, c'est un rappel pour votre rendez-vous le {$this->appointement->date} à {$this->appointement->time}.";
    
        $smsMessage = new SmsTextualMessage(
            destinations: [
                new SmsDestination(to: $patient->formatted_phone_number)
            ],
            from: 'AK-ASSIST-MEDICALE',
            text: $message
        );
    
        $smsRequest = new SmsAdvancedTextualRequest(messages: [$smsMessage]);
    
        try {
            Log::info('Sending SMS to: ' . $patient->formatted_phone_number);
            $sendSmsApi->sendSmsMessage($smsRequest);
            Log::info('SMS sent successfully.');
        } catch (ApiException $apiException) {
            Log::error('Error sending SMS: ' . $apiException->getMessage());
        }
    }
    
}
