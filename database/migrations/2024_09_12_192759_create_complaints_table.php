<?php

use App\Models\{Message, User, Theme};
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
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->text('body');
            $table->boolean('is_solved')->default(false);
            $table->foreignIdFor(Message::class)->index()->constrained();
            $table->foreignIdFor(User::class)->index()->constrained();
            $table->foreignIdFor(Theme::class)->index()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaints');
    }
};
