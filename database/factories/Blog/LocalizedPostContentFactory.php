<?php

namespace Database\Factories\Blog;

use Domain\Blog\Enums\Language;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocalizedPostContentFactory extends Factory
{
    protected $model = \Domain\Blog\Models\LocalizedPostContent::class;

    public function definition()
    {
        return [
            'title' => $this->faker->words(4, true),
            'intro' => $this->faker->sentence(16),
            'content' => $this->faker->text(800),
            'language' => $this->faker->randomElement(Language::toArray()),
        ];
    }
}
