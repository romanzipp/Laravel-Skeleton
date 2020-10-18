<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Support\Enums\TableName;

class CreateUserPasswordResetsTable extends Migration
{
    public function up()
    {
        Schema::create(TableName::USER_PASSWORD_RESETS, function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');

            $table->timestamp('created_at')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists(TableName::USER_PASSWORD_RESETS);
    }
}
