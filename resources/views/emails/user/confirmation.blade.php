@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => config('app.url').$data->url])
Button Text
    Username: {{$data->username}}
    Password: {{$data->password}}
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
