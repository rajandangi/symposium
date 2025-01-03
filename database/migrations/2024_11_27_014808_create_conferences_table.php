<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('conferences', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            $table->text('description');
            $table->string('url');
            $table->date('starts_at');
            $table->date('ends_at');
            $table->date('cfp_starts_at'); // Call for papers: Which is before the start date of the conference
            $table->date('cfp_ends_at');
            $table->string('callingallpapers_id')->unique();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('conferences');
    }
};
