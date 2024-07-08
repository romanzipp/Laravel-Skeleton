<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Support\Enums\TableName;

return new class() extends Migration {
    public function up()
    {
        Schema::create(TableName::BLOG_POST_LOCALIZED_CONTENTS, function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('language')->index();

            $table->text('title');
            $table->text('intro');
            $table->longText('content');

            $table->ulid('post_id');
            $table->foreign('post_id')->references('id')->on(TableName::BLOG_POSTS)->cascadeOnDelete();

            $table->unique(['language', 'post_id']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(TableName::BLOG_POST_LOCALIZED_CONTENTS);
    }
};
