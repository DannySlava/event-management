<?php

    namespace App\Console\Commands;

    use Illuminate\Console\Command;
    use App\Models\Event;
    use App\Notifications\EventReminderNotification;

    class SendEventReminder extends Command
    {
        // Signature de la commande
        protected $signature = 'send:event-reminders';

        // Description de la commande
        protected $description = 'Envoie des rappels d\'événements à tous les utilisateurs inscrits';

        public function __construct()
        {
            parent::__construct();
        }

        public function handle()
        {
            // Exemple de logique pour envoyer les rappels
            $events = Event::all();

            foreach ($events as $event) {
                foreach ($event->users as $user) {
                    $user->notify(new EventReminderNotification($event));
                }
            }

            $this->info('Rappels envoyés avec succès !');
        }
    }
