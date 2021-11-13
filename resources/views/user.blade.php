@extends('layouts.app')

@section('title', "Профиль")

@push('styles')
    <link rel="stylesheet" href = {{ asset("/css/user.css") }}>
@endpush

@push('libs')
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
@endpush

@push('scripts')
    <script src= {{ asset("/js/favorite.js") }}></script>
    <script src= {{ asset("/js/user.js") }}></script>
@endpush

@section('content')
    <main class="main">
        <div class="profile">
            <div class="profile__image-container @can('update', $user) profile__image-container_with-own @endcan">
                <img class="profile__image" id = "profile_image" src="{{ $user->image ? asset("/images/users/".$user->image) 
                : asset("/images/users/default-user-image.png") }}" alt="">
                @can('update', $user)
                    <div class="profile__upload-image">
                        <input type="file" class="profile__file" name="upload_image" id="upload_image">
                        <img src="{{ asset("/images/assets/upload-icon.png") }}" class="profile__upload-icon" alt="">
                    </div>
                @endcan
            </div>

            <div class="modal" id="message_image_alert">
                <div class="alert">
                    <h2 class="auth-block__title">
                        Ошибка загрузки
                    </h2>
                    <p id="message_image"></p>
                    <div style="text-align: center;margin-top: 15px">
                        <button class="btn" id="message_image_btn">
                            Ок
                        </button>
                    </div>
                </div>
            </div>

            <div class="profile__info">
                <div class="profile__name">
                    <span id="user_name">
                        {{ $user->name }}
                    </span>
                    @can('update', $user)
                        <div class="profile__name-edit modal-activated" data-modal-id = "#edit_name_modal">
                            <img src="{{ asset("/images/assets/edit.png") }}" class="profile__edit-image" />
                        </div>
                    @endcan
                </div>

                @can('update', $user)
                    <div class="modal" id = "edit_name_modal">
                        <form class="edit-alert modal__content" id = "edit_alert">
                           <h3 class="edit-alert__title">
                                Изменение имени
                            </h3>
                            <p class="edit-alert__error" id="edit_error"></p>
                            <div class="edit-alert__input">
                                <input type="text" name="edit_name" id="edit_name" class="edit-alert__field input" placeholder="Введите имя" value = "{{ $user->name }}">
                            </div>
                            <button class="edit-alert__btn btn" name="submit_edit" id="submit_edit">
                                Изменить имя
                            </button>
                            <div class="edit-alert__preloader preloader"><div class="preloader__block">
                                <div class="preloader__spin"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endcan

                <div class="profile__content">
                    <div class="profile__item"> 
                        Статус:
                        <span>
                            {{ $user->status }}
                        </span>
                    </div>
                    <div class="profile__item"> 
                        Дата регистрации:
                        <span>
                            {{ $user->created_at->format('d.m.Y') }}
                        </span>
                    </div>
                    <div class="profile__item"> 
                        Комментарии:
                        <span>
                            {{ count($comments) }}
                        </span>
                    </div>
                </div>
            </div>
            @if (count($comments) > 0)
                    <?php 
                        $last = $comments[count($comments) - 1];
                    ?>
                    <div class="last-coment">
                        <div class="last-coment__title">
                            Последний комментарий
                        </div>
                        <div class="last-coment__block">
                            <div class="last-coment__header">
                                <div class="last-coment__relize">
                                    Тайтл:
                                    <a href="{{ route("watch", ["name"=> $last->anime->original_title]) }}">
                                        {{ $last->anime->title }}
                                    </a>
                                </div>
                                <div class="last-coment__date">
                                    {{ $last->created_at->format('d.m.Y') }}
                                </div>
                            </div>
                            <div class="last-coment__body">
                                {{ $last->text }}
                            </div>
                        </div>
                    </div>  
                @endif
        </div>

        <div class="favorites">
            <div class="context-panel">
                <div class="context-panel__title">
                    <h3>Избранное</h3>
                </div>
            </div>
    
            <div class="serias-block">
                @each('partials.seria', $favorites, 'seria')
            </div> 

            @include('partials.pagination', [
                "items"=> $favorites,
                "route"=> 'relizes.index'
            ])
        </div>
    </main>
@endsection