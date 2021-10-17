<div class="news__item">
    <div class="news__descript">
        <h3 class="news__title">{{$news->title}}</h3>
        <p class="news__text">
            {!! $news->text !!}
        </p>
        <a href="{{ route("news.show", ["news"=> $news->id]) }}">
            <button class="news__btn btn">
                Узнать&nbsp;больше
            </button>
        </a>
    </div>
    <div class="news__image-container">
        <img class="news__image lazy" oncontextmenu="return false;" data-src={{"https://shiroikitsune.ru/".$news->image}} src="images/5x5.png" alt="">
        <div class="preloader"><div class="preloader__block">
            <div class="preloader__spin"></div>
            </div>
        </div>
    </div>
</div>