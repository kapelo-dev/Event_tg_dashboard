<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminCommand extends Command
{
    protected $signature = 'create:admin';
    protected $description = 'Créer un utilisateur administrateur';

    public function handle()
    {
        $admin = User::create([
            'username' => 'admin',
            'email' => 'admin@kapelo.com',
            'password' => Hash::make('password123'),
            'first_name' => 'Administrateur',
            'last_name' => 'System',
            'status' => 'ACTIVE',
            'role' => 'ADMIN'
        ]);

        $this->info('Administrateur créé avec succès!');
        $this->info('Email: admin@kapelo.com');
        $this->info('Mot de passe: password123');
    }
} 