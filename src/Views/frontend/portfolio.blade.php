<div class="showPortfolio">
    <div class="col-md-12">
        <div id="gallery">
            <div>
                <button class=" btn filter btn-primary" data-filter="all">@lang('laravel_portfolio.all')</button>
                @foreach($filters as $filter)
                @if(isset($filter['portfolios']) && count($filter['portfolios'])>0)
                <button class="btn filter btn-primary" data-filter=".category-{{$filter['id']}}">{{$filter['title']}}</button>
                @endif
                @endforeach
            </div>
            <div>
                @foreach($items as $item)
                <div class="mix @if($item['tags']) @foreach($item['tags'] as $tag) category-{{$tag['id']}} @endforeach @endif" data-my-order="8">
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <a class="fancybox" href="{{$item->url}}.jpeg"><i @if($dir=="rtl") style="right: 120%;left:0px;    padding-right: 8px;" @endif class="fa fa-search-plus"></i></a>
                        <a href="#" data-item_id="{{$item->id}}" data-lang_id="{{$lang_id}}" class="showPortfolioItem"><i @if($dir=="rtl") style="right: 187%;left:0px;    padding-right: 8px;" @endif class="fa fa-link"></i></a>
                    </div>
                    <div class="thumb_zoom"><img src="{{$item->url}}" class="img-responsive"> </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
