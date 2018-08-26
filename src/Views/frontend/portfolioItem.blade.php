<h2>{!!$item->title!!}</h2>
<div class="backToportfolio pull-right" data-lang_id="{{$lang_id}}">
    <i style="font-size:25px;cursor:pointer" class="fa fa-level-up img thumbnail-back"></i>
</div>
<div style="clear:both"></div>
<div class="row details">
    <div class="col-md-6">
        <div class="col-md-5 col-sm-12 slider">
            <div id="owl-demo" class="owl-carousel owl-theme">
                @foreach($images as $image)
                <div class="item">
                    <img src="{{$image}}" alt="slider-image" class="img-responsive">
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- //Slider Section End -->
    <!-- Project Description Section Start -->
    <div class="col-md-6">
       {!!$item->description!!}
    </div>
</div>
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
<script type="text/javascript"  src="{{ asset('vendor/josh/vendors/owl-carousel/owl.carousel.js') }}"></script>
<script type="text/javascript"  src="{{ asset('vendor/josh/js/carousel.js') }}"></script>