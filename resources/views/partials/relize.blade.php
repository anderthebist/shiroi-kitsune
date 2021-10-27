<div class="relize swiper-slide" data-id = {{$relize->id}}>
    <?php 
        $link_name = $relize->original_title;    
    ?>
    <a href="{{ route('relizes.show', ['relize'=> $link_name]) }}">
        <div class="relize__image">
            <img class="swiper-lazy" oncontextmenu="return false;" data-src={{ asset('/images/animes/'.$relize->image) }} 
            src="{{ asset("/images/assets/5x5.png") }}" alt={{$relize->title}}>
            
            <div class="relize__descript">
                <div class="relize__top">
                    @auth
                        @include('partials.favorite', [
                            "relize"=> $relize
                        ])
                    @endauth
                </div>

                <div class="relize__play">
                    <img class="relize__play-img" src="{{ asset("images/assets/b2c60a34-f2ab-4c0e-b99b-127919b2c01e.png") }}" alt="">
                </div>

                <div class="relize__bottom">
                    <div class="relize__serias">
                        Добавлено <span class="relize__serias-count">{{count($relize->videos)}}/{{$relize->planned_series}}</span>
                    </div>
                    <div class="relize__mark">
                        <div>{{ round($relize->mark, 1) }}</div>
                        <div class="relize__mark-star">
                            <img src="{{ asset("/images/assets/star.png") }}" alt="">
                        </div>
                        
                    </div>
                </div>
            </div>
            
            <div class="swiper-lazy-preloader"></div>
        </div>
    </a>
        
    <div class="relize__title">
        <a href="{{ route('relizes.show', ['relize'=> $link_name]) }}">
            <div>{{$relize->title}}</div>
        </a>
    </div>
    
</div>