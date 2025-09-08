<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('announcement_stats', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->foreignId('announcement_id')->constrained('announcements')->onDelete('cascade');
            $table->integer('views')->default(0);
            $table->decimal('spent', 10, 2)->default(0);
            $table->integer('clicks')->default(0);
            $table->date('date');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcement_stats');
    }
};
