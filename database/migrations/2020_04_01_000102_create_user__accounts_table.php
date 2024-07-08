<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Support\Enums\TableName;

return new class() extends Migration {
    public function up()
    {
        Schema::create(TableName::USER_ACCOUNTS, function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->ulid('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on(TableName::USER_USERS)->cascadeOnDelete();

            /** @see \Support\Enums\ServiceEnum */
            $table->unsignedInteger('service');
            $table->string('service_user_id');
            $table->string('service_user_name');

            $table->text('access_token')->nullable();
            $table->text('refresh_token')->nullable();
            $table->json('scopes')->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(TableName::USER_ACCOUNTS);
    }
};
