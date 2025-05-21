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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('recipient_id');
            $table->string('recipient_type'); // e.g., 'App\Models\Patient', 'App\Models\Doctor', etc.
            $table->string('type');
            $table->text('content');
            $table->date('sent_date');
          //$table->enum('status', ['recieved', 'Not recieved'])->default('Not recieved');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
