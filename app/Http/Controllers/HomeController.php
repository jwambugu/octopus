<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use DB;
use Exception;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(): Renderable
    {
        // Get the auth user
        $user = auth()->user();

        return view('home')->with([
            'user' => $user
        ]);
    }

    /**
     * Returns true if the phone number is used by someone else.
     * @param string $phoneNumber
     * @param int $userID
     * @return bool
     */
    private function checkIfPhoneNumberIsInUse(string $phoneNumber, int $userID): bool
    {
        // Check if the phone number is being used by someone else except the auth user
        $phoneNumberIsOnUse = DB::table('users')
            ->where([
                'phone_number' => $phoneNumber,
            ])->whereNotIn('id', [$userID])
            ->count('id');

        return $phoneNumberIsOnUse == 0;
    }

    /**
     * Returns true if the email is used by someone else.
     * @param string $email
     * @param int $userID
     * @return bool
     */
    private function checkIfEmailIsInUse(string $email, int $userID): bool
    {
        $emailIsOnUse = DB::table('users')
            ->where([
                'email' => $email,
            ])->whereNotIn('id', [$userID])->count('id');

        return $emailIsOnUse == 0;
    }

    /**
     * Process the request for updating the user profile
     * @param UpdateProfileRequest $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        // Extract the request data
        $userID = auth()->id();
        $phoneNumber = $request['phone_number'];
        $email = strtolower($request['email']);

        // Check if the phone number is being used by someone else except the auth user
        $phoneNumberIsInUse = $this->checkIfPhoneNumberIsInUse($phoneNumber, $userID);

        if (!$phoneNumberIsInUse) {
            throw ValidationException::withMessages([
                'phone_number' => 'The phone number is already in use.'
            ]);
        }

        // Check if the email is being used by someone else except the auth user
        $emailIsInUse = $this->checkIfEmailIsInUse($email, $userID);

        if (!$emailIsInUse) {
            throw ValidationException::withMessages([
                'email' => 'The email is already in use.'
            ]);
        }

        try {
            User::where('id', $userID)->update([
                'name' => ucwords(strtolower($request['name'])),
                'email' => $email,
                'phone_number' => $phoneNumber
            ]);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }

        return response()->json([
            'data' => [
                'message' => 'Profile updated successfully.'
            ]
        ]);
    }
}
