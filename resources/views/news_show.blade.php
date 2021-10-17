@extends('layouts.app')

@section('title', $news->title)

@push('styles')
    <link rel="stylesheet" href = {{ asset("/css/news_show.css") }}>
@endpush

@section('content')
    <main class="main">
        <div class="context-panel">
            <div class="context-panel__title">
                <h3>{{ $news->title }}</h3>
            </div>
        </div>

        <div class="news-content">
            <div class="news-content__body">
                <div class="news-content__image-ontainer">
                    <img class="news-content__image" src="{{"https://shiroikitsune.ru/".$news->image}}" alt="{{ $news->title }}">
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