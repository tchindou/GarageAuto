<?php

namespace App\Events;

use App\Models\Client;
use App\Models\User;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClientCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $client;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Client $client)
    {
        $this->client = $client;

        // Créer un utilisateur associé pour chaque gerant
        User::create([
            'name' => $client->name,
            'email' => $client->email, // ajustez l'email en fonction de votre logique
            'password' => $client->password, // ajustez le mot de passe en fonction de votre logique
            'user_type' => Client::class,
            'user_id' => $client->id,
        ]);

        print('Client data: ' . $client->toArray());
    }
}
