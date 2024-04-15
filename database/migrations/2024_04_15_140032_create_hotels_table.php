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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('city');
            $table->string('state');
            $table->string('zip_code', 10);
            $table->string('website')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    Schema::table('hotels', function (Blueprint $table) {
        $table->dropColumn(['name', 
        'address', 
        'city', 
        'state', 
        'zip_code', 
        'website'
    ]);
    $table->dropTimestamps();
    });
    
    Schema::dropIfExists('hotels');
    }
};
