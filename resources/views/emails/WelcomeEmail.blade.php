@component('mail::message')
# Welcome to Marketplace!

Dear {{ $user['first_name'] }}, <br>

Thank you for registering on the Marketplace Website. We are excited to have you
as a user of the Application.
@component('mail::button', ['url' => '/'])
Redirect to HomePage
@endcomponent

Regards,<br>
Marketplace Team
@endcomponent
