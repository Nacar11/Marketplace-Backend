@component('mail::message')
# Welcome to UkayCo.ph!

Dear User, <br>

To Confirm your Email with us, here is the Verification Code provided to continue with UkayCo.

{{ $verificationCode }}

If this is not you, please disregard this. Thank you.

Regards,<br>
UkayCo.ph
@endcomponent
