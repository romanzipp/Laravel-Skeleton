<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Support\Enums\TableName;

return new class() extends Migration {
    public function up()
    {
        Schema::create(TableName::USER_USERS, function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('email')->unique();

            $table->string('name')->unique();
            $table->string('display_name');

            $table->string('password');

            $table->string('timezone')->nullable();

            $table->rememberToken();

            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('terms_accepted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(TableName::USER_USERS);
    }
};
