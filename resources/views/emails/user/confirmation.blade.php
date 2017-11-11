@component('mail::message')
# Introduction

The body of your message.

@component('mail::panel')
    Username: {{$data['username']}}
    Password: {{$data['password']}}
@endcomponent
@component('mail::button', ['url' => config('app.url').$data['url']])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
