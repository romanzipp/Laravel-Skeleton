@extends('app.layouts.app')

@section('content')

    <h1 class="text-5xl mb-8">
        Blog
    </h1>

    <div class="max-w-full lg:max-w-5xl mx-auto space-y-8">

        @foreach($posts->data as $index => $post)

            <a class="block bg-white rounded-md shadow-md overflow-hidden flex flex-no-wrap" href="{{ route('blog.show', $post->slug) }}">

                <div class="w-2/3 p-6 flex flex-col justify-between">

                    <div>
                        <h2 class="mb-3 font-semibold text-2xl">
                            {{ $post->primary_content->title }}
                        </h2>

                        <p>
                            {{ $post->primary_content->intro }}
                        </p>
                    </div>

                    <div class="text-gray-500">
                        {{ carbon($post->published_at)->fromNow() }}
                    </div>

                </div>

                @if($post->thumbnail)
                    <div class="w-1/3 aspect-video">
                        <img src="{{ $post->thumbnail->url }}" alt="{{ $post->primary_content->title }}">
                    </div>
                @endif

            </a>

        @endforeach

    </div>

@endsection
