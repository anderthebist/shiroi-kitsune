<?php
    $user = $comment->user;
?>
<div class="coment" data-id = "{{ $comment->id }}">
    <a href="{{route("users.show", ["user"=> $user->name])}}">
        <div class="coment__container-img">
            <img class="coment__image" src="{{ $user->image ? asset("/images/users/".$user->image) : asset("/images/users/default-user-image.png") }}" alt="">
        </div>
    </a>

    <div class="coment__content" data-id = "{{ $comment->id }}">
        <div class="coment__header">
            <a href="{{route("users.show", ["user"=> $user->name])}}">
                <div class="coment__username">
                    {{ $user->name }}
                </div>
            </a>
            <div class="coment__header-right">
                <div class="coment__date">
                    {{ $comment->created_at->format('d.m.Y') }}
                </div>
                @can('delete', $comment)
                    <div class="coment__settings" id = "del_coment{{ $comment->id }}" data-id="{{ $comment->id }}" data-modal-id = "#delete_alert">
                    </div>
                @endif
            </div>
        </div>
        <div class="coment__body">
            <p class="coment__text">
                {{ $comment->text }}
            </p>
            @if (Auth::user() && $user->id !== Auth::user()->id)
                <div class="coment__answer" data-answer = "{{ $comment->id }}" data-answer-name = "{{ $user->name }}">
                    Ответить
                </div>
            @endif
        </div>
    </div>
</div>