<?php

namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {

           try {
               
            $mail = DB::table('setting_company')->first();
            if (!empty($mail)) //checking if table is not empty
            {
                $config = array(
                    'driver'     => 'smtp',
                    'host'       => $mail->smtp_hostname,
                    'port'       => $mail->smtp_port,
                    'from'       => array('address' => $mail->smtp_no_reply_mail, 'name' => $mail->company_name),
                    'encryption' => 'tls',
                    'username'   => $mail->smtp_username,
                    'password'   => $mail->smtp_password,
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                );
                Config::set('mail', $config);
            }
           } catch (\Exception $e) {
            $res = array('code' => 201, 'msg' => 'Something went wrong! Try again');
        }
        
    }
}