<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Support\Enums\TableName;

return new class() extends Migration {
    public function up()
    {
        Schema::create(TableName::BLOG_POSTS, function (Blueprint $table) {
            $table->ulid('id')->primary();

            $table->string('slug')->unique();

            $table->json('tags')->nullable();

            $table->ulid('author_id')->nullable();
            $table->foreign('author_id')->references('id')->on(TableName::USER_USERS)->cascadeOnDelete();

            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists(TableName::BLOG_POSTS);
    }
};
