<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
     //------------------------------------------------------------------------------------------
    /**
     * Esta es la tabla de post/publicaciones, es la que se estara manipulando en la base de datos
     * Es importante que con cada cambio que se haga, en la terminal se migren los datos
     * Usando el comando 'php artisan migrate' para asi migrar esos campos
     */
     //------------------------------------------------------------------------------------------
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('body');
            $table->string('image_url')->nullable();
            $table->boolean('active')->default(true);
            $table->timestamps();
            $table->unsignedBigInteger('created_by');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade'); // Atentos con las claves foraneas
        });
    }
    //------------------------------------------------------------------------------------------
    /**
     * Aun no hay nada por aqui, lea cuando sea util.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
    //------------------------------------------------------------------------------------------
};
