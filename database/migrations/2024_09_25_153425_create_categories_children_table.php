<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        Schema::create('categories_children', function (Blueprint $table) {
            $table->foreignId('parent_id')->constrained('categories')->cascadeOnDelete();
            $table->foreignId('child_id')->constrained('categories')->cascadeOnDelete();
            $table->unique(['parent_id', 'child_id']);
        });

        DB::statement('ALTER TABLE categories_children ADD CONSTRAINT check_category_child CHECK (parent_id != child_id)');

        DB::commit();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories_children');
    }
};
