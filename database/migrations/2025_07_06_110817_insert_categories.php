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
        DB::table("categories")->insert([
           ['name' => "Music"],
            ['name' => "Sport"],
            ['name' => "Entertainment"],
            ['name' => "Business"],
            ['name' => "Arts"],
            ['name' => "Food"],
            ['name' => "Technology"],
            ['name' => "Other"],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
