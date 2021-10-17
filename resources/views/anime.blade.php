@extends('layouts.app')

@section('title', "Релизы")

@push('styles')
    <link rel="stylesheet" href = {{ asset("/css/anime.css") }}>
@endpush

@push('libs')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <link rel="stylesheet" href= {{ asset("/libs/chosen/chosen.min.css") }}>
    <script src= {{ asset("/libs/chosen/chosen.jquery.min.js") }}></script>
@endpush

@push('scripts')
    <script src= {{ asset("/js/select.js") }}></script>
    <script src= {{ asset("/js/anime.js") }}></script>
@endpush

@section('content')
    <main class="main">
        <div class="relizes__search">
            <form action="{{ route("relizes.index") }}" method="GET" class="search">
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

        <div class="context-panel">
            <div class="context-panel__title">
                <h3>Релизы</h3>
            </div>
            <form action={{route("relizes.index")}} method="GET" class="filter">
                <div class="filter__select select" data-select-name="Жанры">
                    <div class="select__content">
                        <span class="select__placeholder">Жанры</span>
                        <div class="select__arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <div class="select__dropdown">
                        <ul class="select__dropdown-list">
                            @foreach ($categories as $key => $category)
                                <li class="select__dropdown-check">
                                    <span class="select__dropdown-text">{{ $category->name }}</span>
                                    <label class="checkbox" for="category{{$key}}">
                                        <input class="checkbox__check" name = "categories[]" value = "{{ $category->name }}" id = "category{{$key}}" type="checkbox">
                                        <span class="checkbox__checkmark"></span>
                                    </label>
                                </li>  
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="filter__select select" data-select-name="Студии">
                    <div class="select__content">
                        <span class="select__placeholder">Студии</span>
                        <div class="select__arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <div class="select__dropdown">
                        <ul>
                            @foreach ($studios as $key=> $studio)
                                <li class="select__dropdown-check">
                                    <span class="select__dropdown-text">{{ $studio->name }}</span>
                                    <label class="checkbox" for="category{{$key}}">
                                        <input class="checkbox__check" name = "studios[]" value = "{{ $studio->name }}" id = "studio{{$key}}" type="checkbox">
                                        <span class="checkbox__checkmark"></span>
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="filter__select select" data-select-name="Года">
                    <div class="select__content">
                        <span class="select__placeholder">Года</span>
                        <div class="select__arrow">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                    <div class="select__dropdown">
                        <ul>
                            <?php
                                for($i = date("Y"); $i > 2000; $i--) {    
                            ?>
                                <li class="select__dropdown-check">
                                    <span class="select__dropdown-text">{{ $i }}</span>
                                    <label class="checkbox" for="category{{$key}}">
                                        <input class="checkbox__check" name = "years[]" value = "{{ $i }}" id = "year{{$i}}" type="checkbox">
                                        <span class="checkbox__checkmark"></span>
                                    </label>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
                <button type="submit" class="filter__btn">
                    <div class="filter__btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" class="h-8 w-8" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    Поиск
                </button>
            </form>
        </div>

        <div class="serias-block">
            @each('partials.seria', $new_serias, 'seria')
        </div>  

        @include('partials.pagination', [
            "items"=> $new_serias,
            "route"=> 'relizes.index'
        ])
    </main>
@endsection