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
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')
                ->after('id');
            $table->string('last_name')
                ->after('first_name');
            $table->string('phone_number')
                ->nullable()
                ->after('email');
            $table->integer('age')
                ->after('phone_number');
            $table->enum('gender', ['male', 'female'])
                ->after('age');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('first_name');
            $table->dropColumn('last_name');
            $table->dropColumn('phone_number');
            $table->dropColumn('age');
            $table->dropColumn('gender');
        });
    }
};
