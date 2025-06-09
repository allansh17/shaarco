<?php

namespace App\Mail;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CustomerMail extends Mailable
{
    use Queueable, SerializesModels;

    public $customer;
    public $password;

    public function __construct(Customer $customer, $password)
    {
        $this->customer = $customer;
        $this->password = $password;
    }

    public function build()
    {
        return $this->subject('Account Created Successfully')
                    ->view('emails.customer_added');
    }
}
