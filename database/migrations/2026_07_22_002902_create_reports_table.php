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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->constrained('users')
                ->restrictOnDelete();

            $table->foreignId('report_type_id')
                ->constrained('report_types')
                ->restrictOnDelete();

            $table->string('title');

            $table->text('description');

            $table->string('image_path')
                ->nullable();

            $table->text('address');

            $table->decimal('latitude', 10, 7);

            $table->decimal('longitude', 10, 7);

            $table->string('status', 20)
                ->default('new')
                ->index();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};