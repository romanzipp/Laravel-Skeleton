<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Support\Enums\TableName;

return new class() extends Migration {
    public function up()
    {
        Schema::create(TableName::BLOG_POST_CATEGORIES, function (Blueprint $table) {
            $table->uuid('post_id');
            $table->foreign('post_id')->references('id')->on(TableName::BLOG_POSTS)->cascadeOnDelete();

            $table->uuid('category_id');
            $table->foreign('category_id')->references('id')->on(TableName::BLOG_CATEGORIES)->cascadeOnDelete();

            $table->unique(['post_id', 'category_id']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(TableName::BLOG_POST_CATEGORIES);
    }
};
