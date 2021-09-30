@auth
    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="col-md-12">
                <referral-program :user="{{ auth()->user() }}" :links="{{ json_encode([
            'guest' => route('register'),
            'host' => sprintf('%s%s', config('services.backend.url'), 'signup'),
        ]) }}"></referral-program>
            </div>
        </div>
    </div>
@endauth
