@component('mail::message')
# Reset Password Code

Use the following code to reset your password:

{{ $resetCode }}

Note: The code will expire after 10mins

If you didn't request a password reset, no further action is required.

Thanks,
{{ config('app.name') }}
@endcomponent