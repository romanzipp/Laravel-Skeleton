<?php

namespace Database\Seeders;

use Domain\Blog\Enums\Language;
use Domain\Blog\Models\CategoryModel;
use Domain\Blog\Models\LocalizedPostContentModel;
use Domain\Blog\Models\PostModel;
use Domain\User\Models\UserModel;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        /** @var \Domain\User\Models\UserModel $user */
        $user = UserModel::query()->first() ?? UserModel::factory()->create();

        /** @var \Domain\Blog\Models\CategoryModel $category */
        $category = CategoryModel::factory()->create();

        for ($i = 1; $i <= 5; ++$i) {
            /** @var \Domain\Blog\Models\PostModel $post */
            $post = PostModel::factory()->create();
            $post->author()->associate($user);
            $post->save();

            $post
                ->addMedia(sprintf('%s/%s.jpg', database_path('seeders/files/blog'), random_int(1, 7)))
                ->preservingOriginal()
                ->toMediaCollection('thumbnail');

            $post->localizedContents()->save(
                LocalizedPostContentModel::factory()->make([
                    'language' => Language::DE,
                ])
            );

            $post->localizedContents()->save(
                LocalizedPostContentModel::factory()->make([
                    'language' => Language::EN,
                ])
            );

            $category->posts()->attach($post);
        }
    }
}
