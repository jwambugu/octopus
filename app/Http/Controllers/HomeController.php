<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Exception;
use Hash;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use RuntimeException;

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
     * @param Request $request
     * @return Renderable
     */
    public function index(Request $request): Renderable
    {
        $user = $request->user();
        $user->first_name = $user->getFirstName();

        return view('home')->with([
            'user' => $user,
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
        return User::query()
            ->where('phone_number', $phoneNumber)
            ->whereNotIn('id', [$userID])
            ->exists();
    }

    /**
     * Returns true if the email is used by someone else.
     * @param string $email
     * @param int $userID
     * @return bool
     */
    private function checkIfEmailIsInUse(string $email, int $userID): bool
    {
        return User::query()
            ->where('email', $email)
            ->whereNotIn('id', [$userID])
            ->exists();
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
        $userID = auth()->id();
        $phoneNumber = $request['phone_number'];
        $email = strtolower($request['email']);

        if (!$this->checkIfPhoneNumberIsInUse($phoneNumber, $userID)) {
            throw ValidationException::withMessages([
                'phone_number' => 'The phone number is already in use.'
            ]);
        }

        if (!$this->checkIfEmailIsInUse($email, $userID)) {
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
            throw new RuntimeException($e->getMessage());
        }

        return response()->json([
            'data' => [
                'message' => 'Profile updated successfully.'
            ]
        ]);
    }

    /**
     * Render the view for changing the user password.
     * @return Application|Factory|View
     */
    public function changePasswordView(): View|Factory|Application
    {
        return view('profile.password');
    }

    /**
     * Process the request for updating the usr password.
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = $request->user();
        $currentPassword = $request['current_password'];
        $newPassword = $request['password'];

        if (!Hash::check($currentPassword, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'The current password does not match the account password.',
            ]);
        }

        if (Hash::check($newPassword, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => 'The new password cannot be the same as the old password.',
            ]);
        }

        try {
            User::query()->where('id', $user->id)->update([
                'password' => Hash::make($newPassword),
            ]);

        } catch (Exception $e) {
            throw new RuntimeException($e->getMessage());
        }

        return response()->json([
            'data' => [
                'message' => 'Password changed successfully.'
            ]
        ]);
    }

    /**
     * Returns the current referral code for the auth user
     * @return JsonResponse
     */
    public function getReferralCode(): JsonResponse
    {
        $userID = auth()->id();

        $referralCode = sprintf('%s-g-%d-%s-%d', date('y'), $userID, date('m'), date('d'));

        return response()->json([
            'data' => [
                'code' => $referralCode
            ]
        ]);
    }
}
