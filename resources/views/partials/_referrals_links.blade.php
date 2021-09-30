<referral-program :user="{{ auth()->user() }}" :links="{{ json_encode([
            'guest' => route('register'),
            'host' => sprintf('%s%s', config('services.backend.url'), 'signup'),
        ]) }}"></referral-program>
