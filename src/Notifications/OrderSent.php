<?php

namespace Suavy\LojaForLaravel\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Suavy\LojaForLaravel\Models\Order;

class OrderSent extends Notification
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
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
            ->subject("Ta commande a été expediée")
            ->greeting("Bonjour {$notifiable->name}")
            ->line("Bonne nouvelle ! Ta commande numéro **numéro {$this->order->id}** vient d’être expédiée.")
            ->action('Suivre ma commande', $this->order->delivery_tracking)
            ->line('*Si tu as une question à propos de cette commande, tu peux nous contacter par mail à contact@lucilevilaine.com*');
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
