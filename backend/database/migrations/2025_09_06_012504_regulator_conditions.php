<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('regulator_conditions', function (Blueprint $table) {
            $table->id()->primary()->autoIncrement();
            $table->string('parameter_left')->isNotEmpty();
            $table->string('operator')->isNotEmpty();
            $table->string('parameter_right')->default('value')->isNotEmpty();
            $table->decimal('value', 10, 2)->nullable();
            $table->foreignId('rule_id')->constrained('regulator_rules')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
