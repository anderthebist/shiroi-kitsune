@extends('layouts.app')

@section('title', $relize->title)

@push('styles')
    <link rel="stylesheet" href = {{ asset("/css/relize_show.css") }}>
    <link rel="stylesheet" href = {{ asset("/css/relize_show.css") }}>
@endpush

@push('scripts')
    <script src= {{ asset("/js/favorite.js") }}></script>
    <script src= {{ asset("/js/relize_show.js") }}></script>
@endpush

@section('content')
    <main class="main">
        <div class="back-img">
            <img src="{{ asset('/images/animes/'.$relize->poster) }}" alt="">
        </div>
        <div class="left-content">
            <form action="{{ route("relizes.index") }}" method="GET" class="show-search search">
                <button class="search__btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-8 w-8" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                <input type="text" class="search__input input" name="search" placeholder="Поиск" autocomplete="off" data-list-search = "#search_list1">
                <div class="search__list" id = "search_list1">
                </div>
            </form>

            <div class="relize-logo">
                @if ($relize->logo)
                    <img class="relize-logo__image" src="{{ asset("/images/animes/".$relize->logo) }}" alt="">
                @else
                    <h1 class="relize-logo__title">{{ $relize->title }}</h1>
                @endif
            </div>

            <div class="feedback">
                <div class="feedback__mark">
                    <div class="rating" data-anime="{{ $relize->id }}" 
                    @cannot('create', [App\Models\Mark::class, $relize->id]) data-marked="{{true}}" @endcannot>
                        <div class="rating__body">
                            <div>★★★★★</div>    
                            <div class="rating__active"></div>
                            <div class="rating__list">
                                <?php
                                    for($i = 1;$i<6;$i++) {
                                ?>
                                <input class="rating__item" type="radio" name = "raiting" value = "{{$i}}">
                                <?php } ?>
                            </div>
                        </div>
                        <div class="rating__value">{{ round($relize->mark, 1) }}</div>
                    </div>
    
                    <div class="rating-preloader preloader"><div class="preloader__block">
                        <div class="preloader__spin"></div>
                        </div>
                    </div>
                </div>

                @auth
                    <div class="feedback__like">
                        @include('partials.favorite', [
                            "relize"=> $relize
                        ])
                    </div>
                @endauth
            </div>

            <div class="relize-parametrs">
                <div class="relize-parametrs__item">
                    <span class="relize-parametrs__name">Жанры:</span>
                    @foreach ($relize->categories as $index=> $category)
                        <a class="relize-parametrs__link" href="{{ route("relizes.index", ["categories"=>[$category->name] ]) }}">
                            {{ $category->name }}     
                        </a>
                        @if ((count($relize->categories) - 1) !== $index) <span>&#44;</span> @endif
                    @endforeach
                </div>
                <div class="relize-parametrs__item">
                    <span class="relize-parametrs__name">Студия:</span>
                    <a class="relize-parametrs__link" href="{{ route("relizes.index", ["studios"=>[$relize->studio->name] ]) }}">
                        {{ $relize->studio->name }}
                    </a>
                </div>
                <div class="relize-parametrs__item">
                    <span class="relize-parametrs__name">Год:</span>
                    {{ $relize->year }}
                </div>
                <div class="relize-parametrs__item">
                    <span class="relize-parametrs__name">Оригинальное название:</span>
                    {{ str_replace('_', ' ', $relize->original_title) }}
                </div>
                <div class="relize-parametrs__item">
                    <span class="relize-parametrs__name">Тип:</span>
                    {{ $relize->type }}
                </div>
                <div class="relize-parametrs__item">
                    <span class="relize-parametrs__name">Страна:</span>
                    {{ $relize->contry }}
                </div>
            </div>

            <div class="relize-description">
                {{ $relize->description }}
            </div>

            <div class="relize-authors">
                <span class="relize-authors__role">
                    Дабберы:
                </span>
                @foreach ($relize->voices as $index=> $voice)
                    <a class="relize-authors__author" href="{{ route("team.index", ["id"=> $voice->id]) }}">
                        {{ $voice->name }}
                    </a>
                    @if ((count($relize->voices) - 1) !== $index) <span>&#44;</span> @endif
                @endforeach
            </div>
        </div>

        @if (count($relize->videos) > 0 || $relize->trailer)
            <div class="right-content">
                <a href="{{ route('watch', ["name"=> $relize->original_title]) }}">
                    <div class="play">
                        <img src="{{ asset("/images/assets/b2c60a34-f2ab-4c0e-b99b-127919b2c01e.png") }}" alt="">
                    </div>
                </a>
            </div>
        @endif

    </main>
@endsection