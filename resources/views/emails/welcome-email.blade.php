@component('mail::message')
# Hello {{$name}},
# Welcome to Urband Music

@component('mail::button', ['url' => ''])
Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
