<?php

use App\Models\EventPlannerRequest;
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
        Schema::create('event_planner_request_notes', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(EventPlannerRequest::class)->constrained()->onDelete('cascade');
            $table->mediumText('note');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_planner_request_notes');
    }
};
