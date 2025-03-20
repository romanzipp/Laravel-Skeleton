<?php

namespace Database\Factories\Blog;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = \Domain\Blog\Models\PostModel::class;

    public function definition()
    {
        return [
            'slug' => $this->faker->unique()->slug(),
            'tags' => ['foo', 'bar'],
            'published_at' => Carbon::now()->subHours(random_int(1, 100)),
        ];
    }
}
