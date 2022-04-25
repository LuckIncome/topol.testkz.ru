@extends('app')
@section('title',$service->title)
@section('image',\Voyager::image($service->thumbic))
@section('url',url()->current())
@section('seo_title',$service->seo_title)
@section('meta_description',$service->meta_description)
@section('meta_keywords',$service->meta_keywords)
@section('page_class','single-post')
@section('content')
    <div class="page single-post">
        <div class="content-sidebar">
            <h1>{{$service->title}}</h1>
            @include('partials.breadcrumbs',['title'=>__('general.catalogTitle'),'titleLink'=>route('catalog.index'),'subtitle'=> $category->getTranslatedAttribute('name',$locale,$fallbackLocale), 'subtitleLink'=> $category->link, 'childTitle'=> $service->title])
            <div class="content col-9">
                <div class="text-content">
                    {!! $service->body !!}
                </div>
                @if(count($images))
                    <div class="gallery-slider">
                        <div class="slider-data">
                            @foreach($images as $picture)
                            <div class="item">
                                <picture>
                                    <source srcset="{{$picture['webp']}}" type="image/webp">
                                    <source srcset="{{$picture['original']}}" type="image/pjpeg">
                                    <img src="{{$picture['original']}}" alt="Большой каталог раций и радиостанций">
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
                    {!! $service->body_footer !!}
                </div>
                <a href="#" class="btn-darkgreen" data-toggle="modal" data-target="#consultationModal" data-page="{{$service->title}} | Услуга">@lang('general.getConsultation')</a>
            </div>
            <div class="sidebar col-3">
                <a href="#" class="btn-darkgreen sidebar-btn"  data-toggle="modal" data-target="#consultationModal" data-page="{{$service->title}} | Услуга">@lang('general.getConsultation')</a>
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection
