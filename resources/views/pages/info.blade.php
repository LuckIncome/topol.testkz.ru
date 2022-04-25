@extends('app')
@section('title',($seoTitle ? $seoTitle : __('general.usefulInformation')))
@section('seo_title', ($seoTitle ? $seoTitle : __('general.usefulInformation')))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',env('APP_URL').'/images/og.jpg')
@section('url',url()->current())
@section('page_class','base')
@section('content')
    <div class="page posts services">
        <div class="content-sidebar">
            <h1>@lang('general.usefulInformation')</h1>
            @include('partials.breadcrumbs',['title'=>__('general.usefulInformation')])
            <div class="content col-9">
                <div class="items">
                    @foreach($pages as $page)
                        <div class="item img-hover">
                            <picture class="image">
                                <source srcset="{{$page->webpImage}}" type="image/webp">
                                <source srcset="{{$page->bigThumb}}" type="image/pjpeg">
                                <img src="{{$page->bigThumb}}"
                                     alt="{{$page->seo_title ? $page->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $page->getTranslatedAttribute('title',$locale,$fallbackLocale)}}">
                            </picture>
                            <div class="text">
                                <a href="{{route('info.show',$page)}}"
                                   class="title">{{$page->getTranslatedAttribute('title',$locale,$fallbackLocale)}} <i
                                            class="icon"></i></a>
                                <p class="description">{{$page->getTranslatedAttribute('excerpt',$locale,$fallbackLocale)}}</p>
                                <a href="{{route('info.show',$page)}}" class="btn-dark">@lang('general.more')</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="sidebar col-3">
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection