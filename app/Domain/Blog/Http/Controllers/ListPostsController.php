<?php

namespace Domain\Blog\Http\Controllers;

use Domain\Blog\Repositories\PostRepository;
use Illuminate\Http\Request;

class ListPostsController
{
    public function __invoke(Request $request)
    {
        seo()->title('Blog');

        $posts = PostRepository::make()
            ->published()
            ->with([
                'localizedContents',
                'media',
            ]);

        return view('app.pages.blog.index', [
            'posts' => $posts->toObjects($request),
        ]);
    }
}
