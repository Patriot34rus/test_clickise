<?php
declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('announcement_rule_logs')) {
            Schema::create('announcement_rule_logs', function (Blueprint $table) {
                $table->id()->primary()->autoIncrement();
                $table->decimal('budget', 10, 2)->default(0);
                $table->decimal('cpm', 10, 2)->default(0);
                $table->foreignId('rule_id')->constrained('regulator_rules');
                $table->foreignId('announcement_id')->constrained('announcement');
                $table->date('date');
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

    }
};
