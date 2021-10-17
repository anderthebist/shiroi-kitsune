@extends('layouts.app')

@section('title', "Профиль")

@push('styles')
    <link rel="stylesheet" href = {{ asset("/css/user.css") }}>
@endpush

@push('scripts')
    <script src= {{ asset("/js/user.js") }}></script>
@endpush

@section('content')
    <main class="main">
        <div class="profile">
            <div class="profile__image-container">
                <img class="profile__image" id = "profile_image" src="{{$user->image ? asset($user->image) : asset("/images/default-user-image.png") }}" alt="">
            </div>
            @can('create', $user)
                <div class="profile__upload-image">
                    <input type="file" class="profile__file" name="upload_image" id="upload_image">
                    <img src="{{ asset("/images/upload-icon.png") }}" class="profile__upload-icon" alt="">
                </div>
            @endcan
            <div class="profile__info">
                <div class="profile__name">
                    <span>
                        {{ $user->name }}
                    </span>
                    @can('create', $user)
                        <div class="profile__name-edit">
                            <img src="{{ asset("/images/edit.png") }}" class="profile__edit-image" />
                        </div>
                    @endcan
                </div>
                <div class="profile__content">
                    <div class="profile__item"> 
                        Статус:
                        <span>
                            {{ $user->status }}
                        </span>
                    </div>
                    <div class="profile__item"> 
                        Дата регистрация:
                        <span>
                            {{ $user->created_at->format('d.m.Y') }}
                        </span>
                    </div>
                    <div class="profile__item"> 
                        Коментарии:
                        <span>
                            {{ count($comments) }}
                        </span>
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
        </div>
        <div class="favorites">

        </div>
    </main>
@endsection