@extends('app')
@section('title',($seoTitle ? $seoTitle : $page->title))
@section('seo_title', ($seoTitle ? $seoTitle : $page->seo_title))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',\Voyager::image($page->thumbic))
@section('url',url()->current())
@section('page_class','base')
@section('content')
    <div class="page static-page">
        <div class="content-sidebar">
            <h1>{{$page->title}}</h1>
            @include('partials.breadcrumbs',['title'=>__('general.usefulInformation'),'titleLink'=>route('info.index'),'subtitle' => $page->title])
            <div class="content col-9">
                <div class="static-page-content">
                    {!! $page->body !!}
                </div>
                @if(count($images))
                    <div class="gallery-slider">
                        <div class="slider-data">
                            @foreach($images as $picture)
                                <div class="item">
                                    <picture>
                                        <source srcset="{{$picture['webp']}}" type="image/webp">
                                        <source srcset="{{$picture['original']}}" type="image/pjpeg">
                                        <img src="{{$picture['original']}}" alt="{{$page->seo_title ? $page->seo_title : $page->title}}">
                                    </picture>
                                </div>
                            @endforeach
                        </div>
                        <div class="slider-arrows">
                            <button class="arrow prevSlide"><span class="sr-only">Previous</span><i
                                        class="icon"></i>
                            </button>
                            <button class="arrow nextSlide"><span class="sr-only">Next</span><i
                                        class="icon"></i>
                            </button>
                        </div>
                    </div>
                @endif
                <div class="static-page-content">
                    {!! $page->body_footer !!}
                </div>
            </div>
            <div class="sidebar col-3">
                <ul class="sidebar-menu">
                    @foreach($pages as $item)
                        <li @if($page->id == $item->id) class="active" @endif><a href="{{route('info.show',$item)}}">{{$item->getTranslatedAttribute('title',$locale,$fallbackLocale)}}</a></li>
                    @endforeach
                </ul>
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection