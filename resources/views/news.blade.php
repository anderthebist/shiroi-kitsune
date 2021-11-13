@extends('layouts.app')

@section('title', "Новости")

@push('styles')
    <link rel="stylesheet" href = {{ asset("/css/news.css") }}>
@endpush

@section('content')
    <main class="main">
        <div class="context-panel">
            <div class="context-panel__title">
                <h3>Новости</h3>
            </div>
        </div>

        <div class="news">
            @each('partials.news', $news, 'news')
        </div>

        @include('partials.pagination', [
            "items"=> $news,
            "route"=> 'news.index'
        ])
    </main>
@endsection