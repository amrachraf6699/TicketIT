<?php

use App\Models\Event;
use App\Models\EventPlanner;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->string('title');
            $table->text('description');
            $table->string('banner')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->string('google_map_url')->nullable();
            $table->foreignIdFor(EventPlanner::class)->constrained()->onDelete('cascade');
            $table->string('location');
            $table->enum('status', Event::STATUSES)->default(Event::STATUS_PENDING);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
