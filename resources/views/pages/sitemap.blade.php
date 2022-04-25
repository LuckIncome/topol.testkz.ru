@extends('app')
@section('title',($seoTitle ? $seoTitle : __('general.sitemap')))
@section('seo_title', ($seoTitle ? $seoTitle : __('general.sitemap')))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',env('APP_URL').'/images/og.jpg')
@section('url',url()->current())
@section('page_class','base')
@section('content')
    <div class="page sitemap-page">
        <div class="content-sidebar">
            <h1>@lang('general.sitemap')</h1>
            @include('partials.breadcrumbs',['title'=>($seoTitle ? $seoTitle : __('general.sitemap'))])
            <div class="content col-9">
                <ul class="sitemap">
                    <li><a href="{{route('pages.home')}}">@lang('general.home') <i class="icon"></i></a></li>
                    <li><a href="{{route('search')}}">@lang('general.search') <i class="icon"></i></a></li>
                    <li><a href="{{route('catalog.index')}}">@lang('general.catalogTitle') <i class="icon"></i></a>
                        <ul class="sitemap">
                            @foreach($categories as $category)
                                <li>
                                    <a href="{{$category->link}}">{{$category->getTranslatedAttribute('name',$locale,$fallbackLocale)}}
                                        <i
                                                class="icon"></i></a>
                                    @if($category->slug == 'uslugi')
                                        <ul class="sitemap">
                                            @foreach($services as $service)
                                                <li>
                                                    <a href="{{route('catalog.show',[$category,$service->slug])}}">{{$service->getTranslatedAttribute('title',$locale,$fallbackLocale)}}
                                                        <i class="icon"></i></a></li>
                                            @endforeach
                                        </ul>
                                    @elseif($category->slug == 'akcii')
                                        <ul class="sitemap">
                                            @foreach($sales as $sale)
                                                <li>
                                                    <a href="{{route('catalog.show',[$category,$sale->slug])}}">{{$sale->getTranslatedAttribute('title',$locale,$fallbackLocale)}}
                                                        <i class="icon"></i></a></li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <ul class="sitemap">
                                            @foreach($category->categories as $cat)
                                                <li>
                                                    <a href="{{$cat->link}}">{{$cat->getTranslatedAttribute('name',$locale,$fallbackLocale)}}
                                                        <i class="icon"></i></a></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('info.index')}}">@lang('general.pageInfo') <i class="icon"></i></a>
                        <ul class="sitemap">
                            @foreach($infoPages as $infoPage)
                                <li><a href="{{route('info.show',$infoPage)}}">{{$infoPage->getTranslatedAttribute('title',$locale,$fallbackLocale)}} <i class="icon"></i></a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li>
                        <a href="{{route('pages.about')}}">@lang('general.pageAbout') <i class="icon"></i></a>
                        <ul class="sitemap">
                            @foreach($aboutPages as $infoPage)
                                <li><a href="{{route('about.show',$infoPage)}}">{{$infoPage->getTranslatedAttribute('title',$locale,$fallbackLocale)}} <i class="icon"></i></a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li><a href="{{route('pages.contacts')}}">@lang('general.contacts') <i class="icon"></i></a></li>
                    <li><a href="{{route('posts.index')}}">@lang('general.pageNews') <i class="icon"></i></a></li>
                    <li><a href="{{route('page.terms')}}">@lang('general.terms') <i class="icon"></i></a></li>
                </ul>
            </div>
            <div class="sidebar col-3">
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection
