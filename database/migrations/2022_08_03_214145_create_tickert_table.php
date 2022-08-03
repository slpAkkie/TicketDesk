<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('code', 19);
            $table->string('name');
            $table->string('email');
            $table->string('title', 255);
            $table->foreignId('category_id')->references('id')->on('ticket_categories')->cascadeOnUpdate()->restrictOnDelete();
            $table->text('description');
            $table->string('status_slug')->default('opened');
            $table->foreign('status_slug')->references('slug')->on('ticket_statuses')->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('responsible_id')->nullable()->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
};
