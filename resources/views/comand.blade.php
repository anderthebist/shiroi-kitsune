@extends('layouts.app')

@section('title', "Команда")

@push('styles')
    <link rel="stylesheet" href = {{ asset("/css/comand.css") }}>
@endpush

@push('libs')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@endpush

@push('scripts')
    <script src= {{ asset("/js/comand.js") }}></script>
@endpush

@section('content')
<header class="header">
        <div class="team-slider team-slider_load swiper-container">
            <div class="team-slider__wrapper swiper-wrapper">
                @foreach ($voicers as $r => $voicer)
                    <div class="team-slider__slide swiper-slide" data-id={{$voicer->id}} data-name={{$voicer->name}} data-history={{$voicer->id}}>
                        <div class="team-slider__image-container"> 
                            <img class="team-slider__image swiper-lazy" data-src="{{$voicer->image ? asset("/images/voicers/".$voicer->image) 
                            : asset("/images/users/default-user-image.png")}}" 
                            src="{{ asset("/images/assets/5x5.png") }}" alt="">
                            <div class="swiper-lazy-preloader"></div>
                        </div>
                        <div class="team-slider__content">
                            <h2 class="team-slider__title">{{$voicer->name}}</h2>
                            <div class="team-slider__status">
                                @if($voicer->status)
                                    {{ $voicer->status }}
                                @endif
                            </div>
                            <div class="team-slider__description">
                                @if($voicer->description)
                                    {!! $voicer->description !!}
                                @else
                                    ................
                                @endif  
                            </div>
                        </div>
                        <!--<img class="team-slider__image swiper-lazy" data-src="images/barakamon.jpg" src="images/5x5.png" alt="">-->
                        <div class="head-slider__preloader swiper-lazy-preloader"></div>
                    </div>  
                @endforeach
            </div>
            <button class="team-slider__arrows team-slider__arrows-prev">
                <img class="team-slider__arrow-icon" src= "{{ asset("/images/assets/team_arrow_left.png") }}" alt="">
            </button>
            <button class="team-slider__arrows team-slider__arrows-next">
                <img class="team-slider__arrow-icon" src= "{{ asset("/images/assets/team_arrow_right.png") }}" alt="">
            </button>
        </div>

        <div class="header__dots" id = "head_dots">
            <div class="header__pagin"></div>
        </div>
    </header>
    <main class="main">
        <div class="relizes__search">
            <form action = "{{ route("releases.index") }}" method="GET" class="search">
                <button class="search__btn">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-8 w-8" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </button>
                <input type="text" name="search" class="search__input input" placeholder="Поиск" data-list-search = "#search_list1" autocomplete="off">
                <div class="search__list" id = "search_list1">
                </div>
            </form>
        </div>
        <div class="team-relizes" id="team_relizes">
            <div class="context-panel">
                <div class="context-panel__title">
                    <h3>{{$name}}</h3>
                </div>
            </div>
            
            <div class="serias-block">
                @each('partials.seria', $new_serias, 'seria')
            </div>  
    
            @include('partials.pagination', [
                "items"=> $new_serias,
                "route"=> 'comand.index'
            ])
        </div>

        <div class="container-preloader">
            <div class="preloader"><div class="preloader__block">
                <div class="preloader__spin"></div>
                </div>
            </div>
        </div>

    </main>
@endsection