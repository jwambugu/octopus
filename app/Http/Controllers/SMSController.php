<?php

namespace App\Http\Controllers;

use App\Models\SMSOutbox;
use DB;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use JetBrains\PhpStorm\ArrayShape;
use Ramsey\Uuid\Uuid;
use RuntimeException;

class SMSController extends Controller
{
    /**
     * Adds a new SMS to the DB to be sent
     * @param string $phoneNumber
     * @param string $message
     * @return SMSOutbox|Model
     * @throws Exception
     */
    public function create(string $phoneNumber, string $message): Model|SMSOutbox
    {
        try {
            return SMSOutbox::create([
                'uuid' => Uuid::uuid4(),
                'phone_number' => $phoneNumber,
                'message' => $message,
            ]);
        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }
    }

    /**
     * @return Collection
     */
    private static function unsent(): Collection
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
    #[ArrayShape(['count' => "int", 'smslist' => "array"])]
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
        })->toArray();

        return [
            'count' => count($smsList),
            'smslist' => $smsList,
        ];
    }

    /**
     * Updates the SMS data depending on the response sent back
     * @param $response
     * @throws Exception
     */
    private static function processRequestResponse($response): void
    {
        collect($response['responses'])->each(function ($response) {
            $messageUUID = $response['clientsmsid'];
            $responseCode = $response['response-code'];
            /** @noinspection TypeUnsafeComparisonInspection */
            $messageID = $responseCode != 200 ? 'NO MESSAGE ID' : $response['messageid'];
            $responseDescription = $response['response-description'];

            $currentTime = now();

            DB::table('sms_outboxes')
                ->where('uuid', $messageUUID)->update([
                    'message_id' => $messageID,
                    'status' => $responseDescription,
                    'delivery_status' => $responseCode,
                    'is_sent' => true,
                    'response_data' => json_encode($response, JSON_THROW_ON_ERROR),
                    'updated_at' => $currentTime,
                    'sent_at' => $currentTime,
                ]);
        });
    }


    /**
     * Process the task of sending bulk sms
     * @throws Exception
     */
    public static function sendBulk(): void
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
