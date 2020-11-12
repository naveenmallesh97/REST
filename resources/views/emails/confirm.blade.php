Hello {{$user->name}}
 you changed your email. so we need to verify this new address. Please use the link below: 
{{route('verify', $user->verification_token)}}

@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
