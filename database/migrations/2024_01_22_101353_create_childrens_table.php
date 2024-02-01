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
        Schema::create('childrens', function (Blueprint $table) {
            $table->id();
            // User ID  
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            // Name
            $table->string('name');
            // Gander Enum from Man, woman
            $table->enum('gander', ['man', 'woman']);
            // Birthdate
            $table->date('birthdate');
            // Avatar
            $table->longText('avatar')->nullable()->default(null);
            // Place of birth
            $table->string('place_of_birth')->nullable()->default(null);
            // Blood type
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']);
            // Allergies
            $table->longText('allergies')->nullable()->default(null);
            // Chronic diseases
            $table->longText('chronic_diseases')->nullable()->default(null);
            // Body Length
            $table->integer('body_length')->nullable()->default(null);
            // Body Weight
            $table->integer('body_weight')->nullable()->default(null);
            // Notes
            $table->longText('notes')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('childrens');
    }
};
