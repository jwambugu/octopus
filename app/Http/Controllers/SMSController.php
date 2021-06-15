<?php

namespace App\Http\Controllers;

use App\Models\SMSOutbox;
use Exception;
use Illuminate\Database\Eloquent\Model;

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
                'phone_number' => $phoneNumber,
                'message' => $message,
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
