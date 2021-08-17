<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Admin;
use App\Models\ReferralCode;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data): \Illuminate\Contracts\Validation\Validator
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone_number' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return User
     */
    protected function create(array $data): User
    {
        $referralCodeID = $data['referral_code_id'] ?? null;

        return User::create([
            'name' => ucwords(strtolower($data['name'])),
            'email' => strtolower($data['email']),
            'phone_number' => $data['phone_number'],
            'password' => Hash::make($data['password']),
            'referral_code_id' => $referralCodeID
        ]);
    }

    /**
     * Show the application registration form
     * @param Request $request
     * @return Application|Factory|View
     */
    public function showRegistrationForm(Request $request)
    {
        $next = $request->query->get('_next');
        $referralCode = $request->query->get('_ref');

        return view('auth.register')->with([
            'next' => $next,
            'referralCode' => $referralCode,
        ]);
    }

    /**
     * Checks if the referral code is valid. If it is, find or create a one
     * @throws ValidationException
     */
    private function validateRefererCode(string $referralCode)
    {
        $validationError = ValidationException::withMessages([
            'name' => 'Invalid referral code provided.',
        ]);

        $explodedStr = explode('-', $referralCode);

        if (!count($explodedStr)) {
            throw $validationError;
        }

        // Get the referral type
        $referralType = $explodedStr[1];
        $referralID = $explodedStr[2];

        if (!in_array($referralType, ['g', 'h'])) {
            throw $validationError;
        }

        // Check if the referral exists based on the referral type
        $referral = $referralType == 'g' ?
            User::find($referralID, ['id'])
            : Admin::find($referralID, ['id']);

        if (!$referral) {
            throw $validationError;
        }

        // Finds or creates a referral code if none exists
        $referralCodeData = ReferralCode::whereReferralCode($referralCode)->first(['id']);

        if ($referralCodeData) {
            return $referralCodeData->id;
        }

        $referralCodeData = $referralType == 'g' ?

            // Add a new user referral code
            ReferralCode::create([
                'referral_code' => $referralCode,
                'user_id' => $referralID,
            ]) :

            // Add a new admin referral code
            ReferralCode::create([
                'referral_code' => $referralCode,
                'admin_id' => $referralID,
            ]);

        return $referralCodeData->id;
    }

    /**
     * Handle the registration request
     * @param RegisterRequest $request
     * @return RedirectResponse
     * @throws ValidationException
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        $referralCode = strtolower($request['_referral_code']);

        if ($referralCode) {
            $referralCodeID = $this->validateRefererCode($referralCode);
            $request['referral_code_id'] = $referralCodeID;
        }

        // Create a new user
        $user = $this->create($request->all());

        // Login the user
        auth()->loginUsingId($user->id, true);

        $next = !$request->has('_next') ? route('home') : $request['_next'];

        return redirect()->to($next);
    }
}
