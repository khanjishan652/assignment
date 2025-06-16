@component('mail::message')
# You're Invited

Click the button below to complete your registration.

@component('mail::button', ['url' => $url])
Accept Invitation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent