<?php

namespace Domain\Blog\Http\Controllers;

use Domain\Blog\Http\Resources\LocalizedPostContentResource;
use Domain\Blog\Http\Resources\PostResource;
use Domain\Blog\Models\PostModel;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use romanzipp\Seo\Structs\Link;

class ShowPostController
{
    public function __invoke(Request $request, PostModel $post)
    {
        if ( ! $post->isPublished()) {
            throw new ModelNotFoundException();
        }

        $post->load([
            'localizedContents',
        ]);

        $payload = $request->validate([
            'lang' => ['nullable', Rule::in($post->getLanguages())],
        ]);

        $content = $post->getContent($payload['lang'] ?? null);

        seo()->title($content->title);
        seo()->description($content->intro);

        foreach ($post->localizedContents as $localizedContent) {
            seo()->add(
                Link::make()
                    ->rel('alternate')
                    ->attr('hreflang', $localizedContent->language)
                    ->href(route('blog.show', [$post, 'lang' => $localizedContent->language]))
            );
        }

        if ($thumb = $post->getThumbnail()) {
            seo()->image($thumb->getFullUrl());
        }

        return view('app.pages.blog.show', [
            'post' => PostResource::make($post)->toView($request),
            'content' => LocalizedPostContentResource::make($content)->toView($request),
        ]);
    }
}
