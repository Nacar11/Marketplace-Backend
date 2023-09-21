<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderReceivedNotification extends Notification
{
    use Queueable;
    
    private $productOwner;
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
    public function __construct($productOwner, $orderLine, $userPaymentMethod, $shippingAddress, $shippingMethod, $productItem, $product)
    {
        $this->productOwner = $productOwner;
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
        ->markdown('emails.OrderReceived', [
        'user'=>$this->productOwner, 
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
