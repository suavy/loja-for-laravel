<?php

namespace Suavy\LojaForLaravel\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Suavy\LojaForLaravel\Models\Order;

class OrderPaid extends Notification
{
    use Queueable;

    public Order $order;

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
        $mailMessage = (new MailMessage)
            ->subject('Merci pour ta commande !')
            ->greeting("Bonjour {$notifiable->name}")
            ->line("Ta commande **numéro {$this->order->id}** a bien été enregistrée. Elle sera expédiée sous 8 à 10 jours ouvrés, tu recevras un e-mail pour te confirmer l’envoi.")
            ->action('Détails de la commande', route('loja.order.show', $this->order))
            ->line('*Si tu as une question à propos de cette commande, tu peux nous contacter par mail à contact@lucilevilaine.com*');

        return $mailMessage;
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
