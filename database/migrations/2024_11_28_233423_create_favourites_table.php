<?php

use App\Models\Conference;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favourites', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Conference::class)->constrained()->onDelete('cascade');
            $table->timestamps();

            $table->unique(['user_id', 'conference_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favourites');
    }
};