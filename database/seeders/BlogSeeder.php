<?php

namespace Database\Seeders;

use Domain\Blog\Enums\Language;
use Domain\Blog\Models\Category;
use Domain\Blog\Models\LocalizedPostContent;
use Domain\Blog\Models\Post;
use Domain\User\Models\User;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        /** @var \Domain\User\Models\User $user */
        $user = User::query()->first() ?? User::factory()->create();

        /** @var \Domain\Blog\Models\Category $category */
        $category = Category::factory()->create();

        for ($i = 1; $i <= 5; ++$i) {
            /** @var \Domain\Blog\Models\Post $post */
            $post = Post::factory()->create();
            $post->author()->associate($user);
            $post->save();

            $post
                ->addMedia(sprintf('%s/%s.jpg', database_path('seeders/files/blog'), random_int(1, 7)))
                ->preservingOriginal()
                ->toMediaCollection('thumbnail');

            $post->localizedContents()->save(
                LocalizedPostContent::factory()->make([
                    'language' => Language::DE,
                ])
            );

            $post->localizedContents()->save(
                LocalizedPostContent::factory()->make([
                    'language' => Language::EN,
                ])
            );

            $category->posts()->attach($post);
        }
    }
}
