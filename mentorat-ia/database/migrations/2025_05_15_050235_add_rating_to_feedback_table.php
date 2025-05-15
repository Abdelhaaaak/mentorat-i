<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('feedback', function (Blueprint $table) {
        $table->unsignedTinyInteger('rating')->nullable(); // 1 to 5 for example
    });
}

public function down()
{
    Schema::table('feedback', function (Blueprint $table) {
        $table->dropColumn('rating');
    });
}

};
