<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\SmtpSetting;
use Config;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (\Schema::hasTable('smtp_settings')) {
            $smtpSetting = SmtpSetting::first();
            if ($smtpSetting) {
                $data = [
                    'driver'=>$smtpSetting->mailer,
                    'host'=>$smtpSetting->host,
                    'port'=>$smtpSetting->port,
                    'username'=>$smtpSetting->user_name,
                    'password'=>$smtpSetting->password,
                    'encryption'=>$smtpSetting->encryption,
                    'from'=>[
                        'address'=>$smtpSetting->from_address,
                        'name'=>'EasyLearning',
                    ],
                ];
                Config::set('mail', $data);
            }
        }
    }
}
