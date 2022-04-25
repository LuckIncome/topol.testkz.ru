@extends('app')
@section('title',($seoTitle ? $seoTitle : $page->title))
@section('seo_title', ($seoTitle ? $seoTitle : $page->title))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',\Voyager::image($page->thumbic))
@section('url',url()->current())
@section('page_class','base')
@section('content')
    <div class="page base">
        <div class="content-sidebar">
            <h1>{{$page->title}}</h1>
            @include('partials.breadcrumbs',['title'=>__('general.pageAbout'),'titleLink'=>route('pages.about'),'subtitle' => $page->title])
            <div class="content col-9">
                <div class="docs partners reviews">
                    @foreach($reviews as $review)
                    <a href="{{$review->bigThumb}}" class="fb" data-fancybox="reviews">
                        <picture>
                            <source srcset="{{$review->webpImage}}" type="image/webp">
                            <source srcset="{{$review->bigThumb}}" type="image/pjpeg">
                            <img src="{{$review->bigThumb}}"
                                 alt="{{$review->getTranslatedAttribute('alt',$locale,$fallbackLocale)}}">
                        </picture>
                        {{--<picture>--}}
                            {{--<source srcset="{{$review->thumbnailSmall}}" type="image/webp">--}}
                            {{--<source srcset="{{Voyager::image($review->getThumbnail($review->image,'small'))}}" type="image/pjpeg">--}}
                            {{--<img src="{{Voyager::image($review->getThumbnail($review->image,'small'))}}"--}}
                                 {{--alt="{{$review->getTranslatedAttribute('alt',$locale,$fallbackLocale)}}">--}}
                        {{--</picture>--}}
                    </a>
                    @endforeach
                </div>
            </div>
            <div class="sidebar col-3">
                <ul class="sidebar-menu">
                    @foreach($pages as $item)
                        @if($item->id == $page->id)
                            <li class="active"><span>{{$item->title}}</span></li>
                        @else
                            <li><a href="{{$item->url}}">{{$item->title}}</a></li>
                        @endif
                    @endforeach
                </ul>
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection