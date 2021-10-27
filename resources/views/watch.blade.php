@extends('layouts.app')

@section('title', $relize->title)

@push('styles')
    <link rel="stylesheet" href = {{ asset("/css/watch.css") }}>
@endpush

@push('libs')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@endpush

@push('scripts')
    <script src= {{ asset("/js/watch.js") }}></script>
@endpush

@section('content')
    <div class="back-img">
        <img src="{{ asset("/images/animes/".$relize->poster) }}" alt="">
    </div>
    <input type="hidden" id = "anime_id" value = "{{ $relize->id }}">
    <main class="main">
        @if (count($videos) > 0 || $relize->trailer)
            <div class="player">
                <div class="player__video video">
                    <iframe src="@if($relize->trailer && count($videos) == 0) {{ $relize->trailer }} @endif" 
                        id="video_player" height="200" frameborder="0" allow="autoplay; fullscreen" allowfullscreen>
                    </iframe>
                </div>
                @if(count($videos) > 0)
                    <div class="player__bottom">
                        @if ($relize->trailer)
                            <div class="player__trailer" data-iframe-link = "{{ $relize->trailer }}">
                                Трейлер
                            </div>
                        @endif
                        <button class="player__arrows player__arrows-prev">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                        </button>
                        <div class="player__slider swiper-container">
                            <div class="swiper-wrapper">
                                @foreach ($videos as $key=> $video)
                                    <div class="player__item @if(!$relize->trailer && $key === 0) player__item_active @endif swiper-slide" data-iframe-link = "{{ $video->content }}">
                                        {{ $video->number_video }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <button class="player__arrows player__arrows-next">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                            </svg>
                        </button>
                    </div>
                @endif
            </div>
        @endif

        @can('create', App\Models\Coment::class)
            <form action="" class="form-coment" id = "send_coment">
                <input type="hidden" id = "answer">
                <h3 class="form-coment__title">Написать комментарий</h3>
                <div style="display: inline-block">
                    <div class="form-coment__answer" id = "answer_user">
                        <span class="form-coment__answer-name" id = "answer_name">
                        </span>
                        <div class="form-coment__answer-close" id = "answer_close">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </div>
                    </div>
                </div>
                
                <textarea name="coment_text" class="form-coment__text" id="text_coment" placeholder="Оставьте комментарий"></textarea>
                <div class="form-coment__btn-container">
                    <button class="form-coment__btn btn" id = "btn_coment" type="submit">Оставить комментарий</button>
                </div>
            </form>
        @endcan

        <div class="modal" id = "delete_alert">
            <div class="predelete-alert modal__content">
                <div class="predelete-alert__header">
                    <h3 class="predelete-alert__title">
                        Удалить комментарий?
                    </h3>
                    <div class="predelete-alert__text">
                        Вы дейтвительно хотите удалить комментарий?
                    </div>
                </div>
                <input type="hidden" id = "del_coment_id">
                <div class="predelete-alert__panel">
                    <button class="predelete-alert__btn predelete-alert__btn_del" id = "delete_coment">
                        Удалить
                    </button>
                    <button class="predelete-alert__btn predelete-alert__btn_close" id = "close_model_btn">
                        Отмена
                    </button>
                </div>
            </div>
        </div>

        <div class="context-panel">
            <div class="context-panel__title">
                <h3>Комментарии</h3>
            </div>
        </div>
        
        
        <div class="coments-list" id = "coment_id">
            @each('partials.coments.coment', $comments, 'comment')

            <div class="alert-coment" id = "empty_coment" @if(count($comments) > 0) style="display: none" @endif >Нет коментариев</div>
        </div>
        
    </main>
@endsection