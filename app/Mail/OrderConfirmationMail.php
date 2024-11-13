<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $user;
    public $totalAmount;

    public function __construct($order, $user, $totalAmount)
    {
        $this->order = $order;
        $this->user = $user;
        $this->totalAmount = $totalAmount;
    }

    public function build()
    {
        return $this->view('emails.order_confirmation')
                    ->subject('Xác nhận đơn hàng')
                    ->with([
                        'order' => $this->order,
                        'user' => $this->user,
                        'totalAmount' => $this->totalAmount,
                    ]);
    }
}
