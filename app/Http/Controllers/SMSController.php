<?php

namespace App\Http\Controllers;

use App\Models\SMSOutbox;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;
use Ramsey\Uuid\Uuid;

class SMSController extends Controller
{
    /**
     * Adds a new SMS to the DB to be sent
     * @param string $phoneNumber
     * @param string $message
     * @return SMSOutbox|Model
     * @throws Exception
     */
    public function create(string $phoneNumber, string $message)
    {
        try {
            return SMSOutbox::create([
                'uuid' => Uuid::uuid4(),
                'phone_number' => $phoneNumber,
                'message' => $message,
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    private static function unsent()
    {
        $chunks = SMSOutbox::whereNull('status')
            ->whereNull('status')
            ->where('is_sent', false)
            ->take(200)
            ->select([
                'id', 'uuid', 'phone_number', 'message'
            ])
            ->get()
            ->chunk(20)
            ->all();

        foreach ($chunks as $key => $chunk) {
            $chunks[$key] = array_values($chunk->toArray());
        }


        return collect($chunks);
    }

    /**
     * Returns the SMS request body
     * @param array $messages
     * @return array
     */
    private static function createBulkRequestBody(array $messages): array
    {
        $config = config('services.sms');

        $smsList = collect($messages)->map(function ($message) use ($config) {
            return [
                'partnerID' => $config['partnerID'],
                'apikey' => $config['apiKey'],
                'pass_type' => 'plain',
                'clientsmsid' => $message['uuid'],
                'mobile' => $message['phone_number'],
                'message' => $message['message'],
                'shortcode' => $config['shortcode'],
            ];
        });

        return [
            'count' => count($smsList),
            'smslist' => $smsList,
        ];
    }

    /**
     * Updates the SMS data depending on the response sent back
     * @param $response
     */
    private static function processRequestResponse($response)
    {
        collect($response['responses'])->each(function ($response) {
            $messageUUID = $response['clientsmsid'];
            $responseCode = $response['response-code'];
            $messageID = $responseCode != 200 ? 'NO MESSAGE ID' : $response['messageid'];
            $responseDescription = $response['response-description'];

            $currentTime = now();

            DB::table('sms_outboxes')
                ->where('uuid', $messageUUID)->update([
                    'message_id' => $messageID,
                    'status' => $responseDescription,
                    'delivery_status' => $responseCode,
                    'is_sent' => true,
                    'response_data' => json_encode($response),
                    'updated_at' => $currentTime,
                    'sent_at' => $currentTime,
                ]);
        });
    }


    /**
     * Process the task of sending bulk sms
     */
    public static function sendBulk()
    {
        $unsentMessages = self::unsent();

        if (!count($unsentMessages)) {
            return;
        }

        $url = config('services.sms.endpoint');

        $unsentMessages->each(function ($chunk) use ($url) {
            $requestBody = self::createBulkRequestBody($chunk);

            $response = Http::post($url, $requestBody)->json();

            self::processRequestResponse($response);
        });
    }
}
