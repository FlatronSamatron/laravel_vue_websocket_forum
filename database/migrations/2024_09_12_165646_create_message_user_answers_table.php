<?php

use App\Models\{User,Message};
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
        Schema::create('message_user_answers', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Message::class)->index()->constrained();
            $table->foreignIdFor(User::class)->index()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_user_answers');
    }
};
