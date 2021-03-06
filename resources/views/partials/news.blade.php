<div class="news__item">
    <div class="news__descript">
        <h3 class="news__title">{{$news->title}}</h3>
        <p class="news__text">
            {!! strip_tags($news->text) !!}
        </p>
        <div class="news__btn-container">
            <a href="{{ route("news.show", ["news"=> $news->id]) }}">
                <button class="news__btn btn">
                    Узнать&nbsp;больше
                </button>
            </a>
        </div>
    </div>
    <div class="news__image-container">
        <img class="news__image lazy" oncontextmenu="return false;" data-src={{ asset("/images/news/".$news->image) }} 
        src="{{ asset("/images/assets/5x5.png") }}" alt="">
        <div class="preloader"><div class="preloader__block">
            <div class="preloader__spin"></div>
            </div>
        </div>
    </div>
</div>