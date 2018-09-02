<h2>{!!$item->title!!}</h2>
<div class="backToportfolio pull-right" data-lang_id="{{$lang_id}}">
    <i style="font-size:25px;cursor:pointer" class="fa fa-level-up img thumbnail-back"></i>
</div>
<div style="clear:both"></div>
<div class="row details">
    <div class="col-md-6">
        <div class="col-md-5 col-sm-12 slider" style="direction: ltr;">
            <div id="owl-demo-gallery" class="owl-carousel owl-theme">
                @foreach($images as $image)
                <div class="item">
                    <img src="{{$image}}" alt="slider-image" class="img-responsive">
                </div>
                @endforeach
            </div>
            <script>

                    var time = 7; // time in seconds

                    var $progressBar,
                        $bar,
                        $elem,
                        isPause,
                        tick,
                        percentTime;

                    //Init the carousel
                    $("#owl-demo-gallery").owlCarousel({
                        slideSpeed : 500,
                        paginationSpeed : 500,
                        singleItem : true,
                        afterInit : progressBar,
                        afterMove : moved,
                        startDragging : pauseOnDragging
                    });

                    //Init progressBar where elem is $("#owl-demo")
                    function progressBar(elem){
                        $elem = elem;
                        //build progress bar elements
                        buildProgressBar();
                        //start counting
                        start();
                    }

                    //create div#progressBar and div#bar then prepend to $("#owl-demo")
                    function buildProgressBar(){
                        $progressBar = $("<div>",{
                            id:"progressBar"
                        });
                        $bar = $("<div>",{
                            id:"bar"
                        });
                        $progressBar.append($bar).prependTo($elem);
                    }

                    function start() {
                        //reset timer
                        percentTime = 0;
                        isPause = false;
                        //run interval every 0.01 second
                        tick = setInterval(interval, 10);
                    }
                    function interval() {
                        if(isPause === false){
                            percentTime += 1 / time;
                            $bar.css({
                                width: percentTime+"%"
                            });
                            //if percentTime is equal or greater than 100
                            if(percentTime >= 100){
                                //slide to next item
                                $elem.trigger('owl.next')
                            }
                        }
                    }

                    //pause while dragging
                    function pauseOnDragging(){
                        isPause = true;
                    }

                    //moved callback
                    function moved(){
                        //clear interval
                        clearTimeout(tick);
                        //start again
                        start();
                    }
            </script>
        </div>
    </div>
    <!-- //Slider Section End -->
    <!-- Project Description Section Start -->
    <div class="col-md-6">
       {!!$item->description!!}
    </div>
</div>
@if(count($relatedItems)>0)
<div class="row">
    <div class="col-md-12 project_images">
        <div class="text-center">
            <h3 class="border-success"><span class="heading_border bg-success">@lang('laravel_portfolio.related_projecets')</span></h3>
        </div>
            @foreach($relatedItems as $related)
            @if($related->portfolio)
                <div class="col-md-3">
                    <a href="#"  data-item_id="{{$related->portfolio->id}}" data-lang_id="{{$lang_id}}"  class="showPortfolioItem"><img src="{{$related->portfolio->url}}" class="img-responsive"></a>
                </div>
            @endif
            @endforeach
    </div>
</div>
@endif


