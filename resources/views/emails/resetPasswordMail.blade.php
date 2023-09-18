@component('mail::message')
# Hallo!

Anda menerima email ini karena kami menerima permintaan reset password untuk akun anda.

@component('mail::button', ['url' => $details['url']])
Reset Password
@endcomponent

Perhatian, link reset password ini hanya berlaku selama 60 menit.
Jika anda tidak melakukan permintaan reset password, abaikan email ini.

Hormat Kami,<br>
{{ config('app.name') }}
___
Jika anda ada masalah dengan tombol "Reset Password", salin dan tempel link berikut ini ke web browser: <{{ $details['url'] }}>
@endcomponent
