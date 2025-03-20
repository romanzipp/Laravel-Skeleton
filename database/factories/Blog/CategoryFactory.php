<?php

namespace Database\Factories\Blog;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    protected $model = \Domain\Blog\Models\CategoryModel::class;

    public function definition()
    {
        return [
            'slug' => $this->faker->unique()->slug(),
            'title' => 'Example',
        ];
    }
}
