<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Support\Enums\TableName;

class CreateSupportFailedJobsTable extends Migration
{
    public function up()
    {
        Schema::create(TableName::SUPPORT_FAILED_JOBS, function (Blueprint $table) {

            $table->id();

            $table->text('connection');
            $table->text('queue');
            $table->longText('payload');
            $table->longText('exception');

            $table->timestamp('failed_at')->useCurrent();
        });
    }

    public function down()
    {
        Schema::dropIfExists(TableName::SUPPORT_FAILED_JOBS);
    }
}
