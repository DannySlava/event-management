<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('is_admin')->default(false);  // Ajouter la colonne
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin');  // Supprimer la colonne lors d'un rollback
        });
    }
};

/* 
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@exemple.com';
$user->password = Hash::make('motdepasse-securise');
$user->is_admin = true;
$user->email_verified_at = now();
$user->save();



*/
