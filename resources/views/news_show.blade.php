@extends('layouts.app')

@section('title', $news->title)

@push('styles')
    <link rel="stylesheet" href = {{ asset("/css/news_show.css") }}>
@endpush

@section('content')
    <main class="main">
        <a href="{{ route("news.index") }}">
            <div class="page-head">
                <div class="page-head__icon">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                </div>
                <div class="page-head__title">{{ $news->title }}</div>
            </div>
        </a>

        <div class="news-content">
            <div class="news-content__body">
                <div class="news-content__image-ontainer">
                    <img class="news-content__image" src="{{ asset("/images/news/".$news->image) }}" alt="{{ $news->title }}">
                </div>
                <div class="news-content__text">
                    {!! $news->text !!}
                </div>
            </div>
            @if ($news->video)
                <div class="video">
                    <iframe src="{{ $news->video }}" 
                        id="video_player" height="200" frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
                    </iframe>
                </div>
            @endif
        </div>
    </main>
@endsection