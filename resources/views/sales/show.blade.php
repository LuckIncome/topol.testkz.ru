@extends('app')
@section('title',$sale->title)
@section('image',\Voyager::image($sale->thumbic))
@section('url',url()->current())
@section('seo_title',$sale->seo_title)
@section('meta_description',$sale->meta_description)
@section('meta_keywords',$sale->meta_keywords)
@section('page_class','single-post')
@section('content')
    <div class="page single-post">
        <div class="content-sidebar">
            <h1>{{$sale->title}}</h1>
            @include('partials.breadcrumbs',['title'=>__('general.catalogTitle'),'titleLink'=>route('catalog.index'),'subtitle'=> $category->getTranslatedAttribute('name',$locale,$fallbackLocale), 'subtitleLink'=> $category->link, 'childTitle'=> $sale->title])
            <div class="content col-9">
                <div class="text-content">
                    {!! $sale->body !!}
                </div>
                @if(count($images))
                    <div class="gallery-slider">
                        <div class="slider-data">
                            @foreach($images as $picture)
                            <div class="item">
                                <picture>
                                    <source srcset="{{$picture['webp']}}" type="image/webp">
                                    <source srcset="{{$picture['original']}}" type="image/pjpeg">
                                    <img src="{{$picture['original']}}" alt="{{$sale->seo_title}}">
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
                <div class="text-content">
                    {!! $sale->body_footer !!}
                </div>
            </div>
            <div class="sidebar col-3">
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection
