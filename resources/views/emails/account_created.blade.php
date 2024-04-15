{{-- blade-formatter-disable --}}
@component('mail::message')
Dear <strong>{{ $user->full_name }}</strong>,

Your account is now activated. You can now use your {{ config('app.name') }} account to access our platform.

@component('mail::panel')
**Account Credential**
Gasoline Station: {{$user->gasoline_station->name}}
Email: {{ $user->email }}     {{-- Valid email address here --}}
Password: {{ $password }}
@endcomponent

**Note:** This is a system-generated password. For security purposes, please update your password as soon as you log in to the system.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
