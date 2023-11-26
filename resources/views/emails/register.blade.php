@component('mail::message')
Hello {{$user->name}},

@component('mail::button', ['url' => url('verify/'.$user->remember_token)])
Verify
@endcomponent

<p>Please Verify your Account </p>

<p>In case you have any issue of Verifying your account  , please contact us</p>

Thanks,<br>
{{ config('app.name') }}
@endcomponent