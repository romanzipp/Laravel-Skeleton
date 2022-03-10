@extends('app.layouts.app')

@section('content')

    <div class="max-w-full lg:max-w-5xl mx-auto">

        <div class="aspect-[26/9] relative overflow-hidden mb-16">

            <figure>
                <img src="{{ $post->thumbnail->url }}"
                     alt="{{ $content->title }}"
                     class="absolute">
            </figure>

            <div class="absolute w-full h-full top-0 left-0 bg-gradient-to-b from-transparent to-white"></div>

            <div class="absolute left-0 top-0 w-full h-full p-8 flex items-center justify-center">
                <h1 class="text-7xl sm:text-[5rem] md:text-[6rem] lg:text-[7rem] xl:text-[4rem] font-bold leading-normal">
                    {{ $content->title }}
                </h1>
            </div>

        </div>

        <article class="prose prose-a:text-blue-500 mx-auto mb-64">

            @if(count($post->localized_contents) > 1)
                <div class="flex space-x-4 mb-6 not-prose">
                    <div>
                        Language
                    </div>
                    @foreach($post->localized_contents as $localizedContent)
                        <a href="{{ route('blog.show', [$post->slug, 'lang' => $localizedContent->language]) }}"
                           class="px-2
                                @if($content->language === $localizedContent->language) bg-blue-500 text-white
                                @else hover:bg-blue-500 hover:text-white @endif">
                            {{ $localizedContent->language_title }}
                        </a>
                    @endforeach
                </div>
            @endif

            {!! $content->content !!}
        </article>

    </div>

@endsection
