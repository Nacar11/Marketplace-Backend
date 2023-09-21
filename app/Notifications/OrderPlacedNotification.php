<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedNotification extends Notification
{
    use Queueable;

    private $user;
    private $orderLine;
    private $userPaymentMethod;
    private $shippingAddress;
    private $shippingMethod;
    private $productItem;
    private $product;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user, $orderLine, $userPaymentMethod, $shippingAddress, $shippingMethod, $productItem, $product)
    {
        $this->user = $user;
        $this->orderLine = $orderLine;
        $this->userPaymentMethod = $userPaymentMethod;
        $this->shippingAddress = $shippingAddress;
        $this->shippingMethod = $shippingMethod;
        $this->productItem = $productItem;
        $this->product = $product;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->markdown('emails.OrderPlaced', [
        'user'=>$this->user, 
        'orderLine'=>$this->orderLine, 
        'userPaymentMethod'=>$this->userPaymentMethod, 
        'shippingAddress'=>$this->shippingAddress,
        'shippingMethod'=>$this->shippingMethod,
        'productItem'=>$this->productItem,
        'product'=>$this->product,
    ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
