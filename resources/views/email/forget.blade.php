@component("mail::message")
Hello {{ $user->name }}

<p>We understand that you forgot your password. Please click the button below to reset your password.</p>

@component("mail::button", ["url" => url("reset/".$user->remember_token)])
    Reset your password
@endcomponent
Thanks, {{ config("app.name") }}
@endcomponent