<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    public function up()
    {
        Schema::table('action_events', function (Blueprint $table) {
            $table->string('actionable_id', 125)->change();
            $table->string('model_id', 125)->change();
            $table->string('target_id', 125)->change();
            $table->string('user_id', 125)->change();
        });
    }

    public function down()
    {
        Schema::table('action_events', function (Blueprint $table) {
            $table->integer('actionable_id')->unsigned()->change();
            $table->integer('model_id')->unsigned()->change();
            $table->integer('target_id')->unsigned()->change();
            $table->integer('user_id')->unsigned()->change();
        });
    }
};
