<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as BaseResetPassword;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Lang;

class ResetPasswordNotification extends BaseResetPassword
{
    /**
     * Build the reset password notification mail message.
     */
    public function toMail($notifiable): MailMessage
    {
        $url = $this->resetUrl($notifiable);
        $expire = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');

        return (new MailMessage)
            ->subject(Lang::get('Reset Password JUARAMETA'))
            ->greeting('Halo '.$notifiable->name.',')
            ->line('Kami menerima permintaan untuk mengganti password akun JUARAMETA Anda.')
            ->line('Klik tombol di bawah ini untuk membuat password baru. Link ini dibuat unik setiap kali diminta dan hanya dapat digunakan satu kali.')
            ->action('Ganti Password', $url)
            ->line('Link reset password ini akan kedaluwarsa dalam '.$expire.' menit.')
            ->line('Jika Anda tidak meminta reset password, abaikan email ini dan password Anda tetap aman.');
    }

    /**
     * Get the reset URL for the given notifiable.
     */
    protected function resetUrl($notifiable): string
    {
        if (static::$createUrlCallback) {
            return call_user_func(static::$createUrlCallback, $notifiable, $this->token);
        }

        return url(route('password.reset', [
            'token' => $this->token,
            'email' => $notifiable->getEmailForPasswordReset(),
        ], false));
    }
}
