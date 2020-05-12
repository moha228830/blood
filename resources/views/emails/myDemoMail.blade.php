@component('mail::message')


blood bank reset password.

@component('mail::button', ['url' => ''])
{{$code}}
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
