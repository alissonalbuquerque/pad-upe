<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        ResetPassword::toMailUsing(function($notifiable, $url)
        {   
            $minutes = config('auth.passwords.'.config('auth.defaults.passwords').'.expire');

            $url = url(route('password.reset', [
                'token' => $url,
                'email' => $notifiable->getEmailForPasswordReset()
            ]), false);

            return (new MailMessage)
                ->subject('Notificação de redefinição de senha')
                ->line('Você está recebendo este e-mail porque recebemos uma solicitação de redefinição de senha para sua conta.')
                ->action('Redefinir senha', $url)
                ->line('Este link de redefinição de senha expirará em '. $minutes .' minutos.')
                ->line('Se você não solicitou uma redefinição de senha, nenhuma outra ação será necessária');
        });

    }
}
