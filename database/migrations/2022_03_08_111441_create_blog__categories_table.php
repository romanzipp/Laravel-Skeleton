<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Support\Enums\TableName;

return new class() extends Migration {
    public function up()
    {
        Schema::create(TableName::BLOG_CATEGORIES, function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('title');
            $table->string('slug')->unique();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(TableName::BLOG_CATEGORIES);
    }
};
