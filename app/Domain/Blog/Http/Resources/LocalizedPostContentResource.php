<?php

namespace Domain\Blog\Http\Resources;

use Support\Http\Resources\AbstractResource;

final class LocalizedPostContentResource extends AbstractResource
{
    public function toArray($request): array
    {
        /** @var \Domain\Blog\Models\LocalizedPostContent $localizedPostContent */
        $localizedPostContent = $this->resource;

        return [
            'id' => $localizedPostContent->id,

            'language' => $localizedPostContent->language,
            'language_title' => $localizedPostContent->getLanguage()->getTitle(),

            'title' => $localizedPostContent->title,
            'intro' => $localizedPostContent->intro,
            'content_raw' => $localizedPostContent->content,
            'content' => $localizedPostContent->getParsedContent(),

            $this->withDates(),
        ];
    }
}
