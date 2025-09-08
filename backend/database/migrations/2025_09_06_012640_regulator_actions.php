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
        if (!Schema::hasTable('regulator_actions')) {
            Schema::create('regulator_actions', function (Blueprint $table) {
                $table->id()->primary()->autoIncrement();
                $table->string('action_type')->isNotEmpty();
                $table->string('parameter')->default('value');
                $table->decimal('value', 10, 2);
                $table->foreignId('rule_id')->constrained('regulator_rules')->onDelete('cascade');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
