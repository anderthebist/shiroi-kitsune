<div class="serias-block__item" data-id = {{$seria->id}}>
    <a href={{ route('relizes.show', ["relize" => $seria->original_title]) }}>
        <div class = "serias-block__image-container">
            <img class="serias-block__image lazy" data-src={{"https://shiroikitsune.ru/".$seria->image}} oncontextmenu="return false;" src="images/5x5.png" alt="">
            <div class="preloader"><div class="preloader__block">
                <div class="preloader__spin"></div>
                </div>
            </div>
        </div>
        <div class="serias-block__title">
            {{$seria->title}}
        </div>
    </a>
</div>
