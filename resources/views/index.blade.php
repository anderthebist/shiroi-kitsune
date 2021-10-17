@extends('layouts.app')

@section('title', "Главная")

@push('styles')
    <link rel="stylesheet" href = {{ asset("/css/index.css") }}>
@endpush

@push('libs')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@endpush

@push('scripts')
<script src= {{ asset("/js/favorite.js") }}></script>
    <script src= {{ asset("/js/index.js") }}></script>
@endpush

@section('content')
    @if (count($header) > 0)
        <header class="header">
            <form action="{{ route("relizes.index") }}"  method="GET" class="header__search search">
                <button class="search__btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-8 w-8" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                <input type="text" name="search" class="search__input input" placeholder="Поиск" data-list-search = "#search_list1" autocomplete="off">
                <div class="search__list" id = "search_list1">
                </div>
            </form>
        
            <div class="head-slider swiper-container">
                <div class="head-slider__wrapper swiper-wrapper">
                    @foreach ($header as $head)
                        <div class="head-slider__slide swiper-slide">
                            <img class="head-slider__image swiper-lazy" data-src="{{ asset($head->poster) }}" src="images/5x5.png" alt="">
                            <div class="head-slider__descript">
                                <div class="head-slider__logo-container">
                                @if ($head->logo)
                                    <img class="head-slider__logo" src="{{ asset($head->logo) }}" oncontextmenu="return false;" alt="">
                                @else
                                    <h2 class="head-slider__title">{{ $head->title }}</h2>   
                                @endif
                                </div>
                                <p class="head-slider__descript-text">
                                    {{ $head->description }}
                                </p>
                                <div class="head-slider__btns">
                                    <a href="{{ route("relizes.show", ["relize"=> $head->original_title]) }}">
                                        <button class="head-slider__btn btn">
                                            <img class="head-slider__btn-icon" src="./images/play-watch.png" alt="">
                                            Смотреть
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="head-slider__preloader swiper-lazy-preloader"></div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="header__dots" id = "head_dots">
                <div class="header__pagin"></div>
            </div>
        </header>      
    @endif

    <main class="main">
        <div class="context-panel">
            <div class="context-panel__title">
                <h3>Рекомендуемые</h3>
            </div>
            <div class = "context-panel__right">
                <a class="context-panel__link link" href={{ route('relizes.index') }}>
                    Посмотреть все
                </a>
                <div class="context-panel__arrows relize-arrows">
                    <div class="arrow context-panel__arrow_prev">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                    </div>
                    <div class="arrow context-panel__arrow_next">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <div class="relize-slider swiper-container">
            <div class="swiper-wrapper">
                @each('partials.relize', $relizes, 'relize')
            </div>
        </div>
        
        <div class="context-panel">
            <div class="context-panel__title">
                <h3>Новые серии</h3>
            </div>
            <div class = "context-panel__right">
                <a class="context-panel__link link" href={{ route('relizes.index') }}>
                    Посмотреть все
                </a>
            </div>
        </div>

        <div class="serias-block">
            @each('partials.seria', $new_serias, 'seria')
        </div>  

        <div class="context-panel">
            <div class="context-panel__title">
                <h3>Новости Проекта</h3>
            </div>
            <div class = "context-panel__right">
                <a class="context-panel__link link" href={{ route('news.index') }}>
                    Посмотреть все
                </a>
            </div>
        </div>

        <div class="news">
            @each('partials.news', $news, 'news')
        </div>

    </main>
@endsection