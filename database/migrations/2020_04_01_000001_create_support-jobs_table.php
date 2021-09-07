<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Support\Enums\TableName;

return new class() extends Migration {
    public function up()
    {
        Schema::create(TableName::SUPPORT_JOBS, function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('queue')->index();
            $table->longText('payload');
            $table->unsignedTinyInteger('attempts');

            $table->unsignedInteger('reserved_at')->nullable();
            $table->unsignedInteger('available_at');
            $table->unsignedInteger('created_at');
        });
    }

    public function down()
    {
        Schema::dropIfExists(TableName::SUPPORT_JOBS);
    }
};
