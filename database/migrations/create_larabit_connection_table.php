<?php

use Dev\Larabit\Models\Connection;
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
        if ( Schema::hasTable(Connection::tableName) ) return;
        Schema::create(Connection::tableName, function (Blueprint $table) {
            $table->id();
            $table->integer(Connection::user_id);
            $table->string(Connection::external_user_id)->nullable();
            $table->string(Connection::domain);
            $table->string(Connection::path);
            $table->string(Connection::token)->nullable();
            $table->enum(Connection::type, Connection::typeList)->default(Connection::typeDefault);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if ( !Schema::hasTable(Connection::tableName) ) return;
        Schema::dropIfExists(Connection::tableName);
    }
};
