<?php

namespace Database\Factories\Blog;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostCategoryFactory extends Factory
{
    protected $model = \Domain\Blog\Models\PostCategory::class;

    public function definition()
    {
        return [];
    }
}
