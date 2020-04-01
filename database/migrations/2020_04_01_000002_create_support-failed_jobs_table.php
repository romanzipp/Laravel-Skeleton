<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Support\Enums\TableName;

class CreateSupportFailedJobsTable extends Migration
{
    private const TABLE = TableName::SUPPORT_FAILED_JOBS;

    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {

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
        Schema::dropIfExists(self::TABLE);
    }
}
