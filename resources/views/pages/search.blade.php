@extends('app')
@section('title',($seoTitle ? $seoTitle : __('general.searchResults')))
@section('seo_title', ($seoTitle ? $seoTitle : __('general.searchResults')))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',env('APP_URL').'/images/og.jpg')
@section('url',url()->current())
@section('page_class','search-page')
@section('content')
    <div class="page search-page" data-ng-controller="SearchController as sc">
        <div class="content-sidebar">
            <h1>@lang('general.searchResults')</h1>
            <div class="content col-9">
                <div class="search input-group" data-ng-init="searchInputInline = '{{$input}}'">
                    <input type="text" class="form-control" placeholder="@lang('general.searchPlaceholder')"
                           data-ng-model="searchInputInline"
                           aria-label="@lang('general.searchPlaceholder')" aria-describedby="button-addon1"
                           value="{{$input}}">
                    <div class="input-group-append">
                        <button class="btn" type="button" id="button-addon1"
                                data-ng-click="sc.openSearchPage(searchInputInline)">@lang('general.search')</button>
                    </div>
                </div>
                <p class="result">@lang('general.searchFound',['input'=>$input, 'total' => $items->total()])</p>
                <div class="items">
                    @foreach($items as $key=>$item)
                        <div class="item img-hover">
                            <span class="key">{{str_pad($key+1, 2, "0", STR_PAD_LEFT)}}.</span>
                            @if(class_basename($item) == 'Product')
                                <a href="{{$item->full_link}}" class="image">
                                    <picture>
                                        <source srcset="{{$item->thumbnailSmall}}" type="image/webp">
                                        <source srcset="{{Voyager::image($item->getThumbnail($item->image,'small'))}}"
                                                type="image/pjpeg">
                                        <img src="{{Voyager::image($item->getThumbnail($item->image,'small'))}}"
                                             alt="{{$item->getTranslatedAttribute('name',$locale,$fallbackLocale)}}">
                                    </picture>
                                </a>
                            @endif
                            <div class="text">
                                @if(!is_null($item->date))<p class="date">{{$item->date}}</p>@endif
                                <a href="{{$item->full_link}}"
                                   class="title">{{$item->getTranslatedAttribute('name',$locale,$fallbackLocale)}} <i
                                            class="icon"></i></a>
                                <p class="description">{{Str::limit($item->getTranslatedAttribute('excerpt',$locale,$fallbackLocale), (class_basename($item) == 'Product') ? 250 : 290 , '...')}}</p>
                            </div>
                        </div>
                        @if(!$loop->last)
                            <hr>
                        @endif
                    @endforeach
                </div>
                {!! $items->links() !!}
            </div>
            <div class="sidebar col-3">
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection