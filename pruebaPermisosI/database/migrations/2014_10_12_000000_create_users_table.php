<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     //------------------------------------------------------------------------------------------
    /**
     * Esta es la tabla de usuarios, es la que se estara manipulando en la base de datos
     * Es importante que con cada cambio que se haga, en la terminal se migren los datos
     * Usando el comando 'php artisan migrate' para asi migrar esos campos
     */
     //------------------------------------------------------------------------------------------
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }
    //------------------------------------------------------------------------------------------
    /**
     * No hay mucho que mirar por aca.
     * de momento...
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
     //------------------------------------------------------------------------------------------
};
