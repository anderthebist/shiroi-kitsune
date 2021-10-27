<?php
    $isFavorite = auth()->user()->favorites->contains($relize->id);
?>
<div class="favorite" data-id="{{ $relize->id }}" data-fav="{{ $isFavorite }}">
    <img class="favorite__like @if($isFavorite) favorite__like_active @endif" src="{{ asset('images/assets/heart_red.png') }}" alt="">
    <img class="favorite__like @if(!$isFavorite) favorite__like_active @endif" src="{{ asset('images/assets/heart.png') }}" alt="">
</div>