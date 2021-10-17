<div class="relize swiper-slide" data-id = {{$relize->id}}>
    <?php 
        $link_name = $relize->original_title;    
    ?>
    <div class="relize__image">
        <a href="{{ route('relizes.show', ['relize'=> $link_name]) }}">
            <img class="swiper-lazy" oncontextmenu="return false;" data-src={{"https://shiroikitsune.ru/".$relize->image}} src="images/5x5.png" alt={{$relize->title}}>
        </a>
        <div class="relize__descript">
            @auth
                <div class="relize__top">
                    <div>
                        @include('partials.favorite', [
                            "relize"=> $relize
                        ])
                    </div>
                </div>
            @endauth

            <a href="{{ route('relizes.show', ['relize'=> $link_name]) }}">
                <div class="relize__play">
                    <img class="relize__play-img" src="images/b2c60a34-f2ab-4c0e-b99b-127919b2c01e.png" alt="">
                </div>
            </a>

            <div class="relize__bottom">
                <div class="relize__serias">
                    Добавлено <span class="relize__serias-count">{{count($relize->videos)}}/{{$relize->planned_series}}</span>
                </div>
                <div class="relize__mark">
                    <div>{{ round($relize->mark, 1) }}</div>
                    <div class="relize__mark-star">
                        <img src="{{ asset("/images/star.png") }}" alt="">
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="swiper-lazy-preloader"></div>
    </div>
    <div class="relize__title">
        <a href="{{ route('relizes.show', ['relize'=> $link_name]) }}">
            <div>{{$relize->title}}</div>
        </a>
    </div>
    
</div>