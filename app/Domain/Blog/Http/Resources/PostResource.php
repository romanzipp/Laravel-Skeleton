<?php

namespace Domain\Blog\Http\Resources;

use Domain\Blog\Models\LocalizedPostContent;
use Support\Http\Resources\AbstractResource;
use Support\Http\Resources\MediaResource;

final class PostResource extends AbstractResource
{
    public function toArray($request): array
    {
        /** @var \Domain\Blog\Models\Post $post */
        $post = $this->resource;

        $primaryContent = new LocalizedPostContentResource($post->localizedContents->first());

        return [
            'id' => $post->id,

            'slug' => $post->slug,

            'primary_content' => $primaryContent,
            'localized_contents' => LocalizedPostContentResource::collection($post->localizedContents),

            'languages' => array_map(fn (LocalizedPostContent $content) => $content->language, [...$post->localizedContents]),

            'thumbnail' => new MediaResource(
                $post->getFirstMedia('thumbnail')
            ),

            $this->withDates([
                'published_at',
                'created_at',
                'updated_at',
            ]),
        ];
    }
}
