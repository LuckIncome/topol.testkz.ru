@extends('app')
@section('title',($seoTitle ? $seoTitle : $category->getTranslatedAttribute('name',$locale,$fallbackLocale)))
@section('seo_title', ($seoTitle ? $seoTitle : $category->getTranslatedAttribute('name',$locale,$fallbackLocale)))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',\Voyager::image($category->thumbic))
@section('url',url()->current())
@section('page_class','posts')
@section('content')
    <div class="page posts sales-page">
        <div class="content-sidebar">
            <h1>{{$category->getTranslatedAttribute('name',$locale,$fallbackLocale)}}</h1>
            @include('partials.breadcrumbs',['title'=>__('general.catalogTitle'),'titleLink'=>route('catalog.index'),'subtitle' => $category->getTranslatedAttribute('name',$locale,$fallbackLocale)])
            <div class="content col-9">
                <div class="items">
                    @if($sales->count())
                        @foreach($sales as $post)
                            <div class="item img-hover">
                                <a href="{{route('catalog.show',[$category,$post->slug])}}" class="image">
                                    <picture>
                                        <source srcset="{{$post->webpImage}}" type="image/webp">
                                        <source srcset="{{$post->bigThumb}}" type="image/pjpeg">
                                        <img src="{{$post->bigThumb}}" alt="{{$post->seo_title ? $post->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $post->getTranslatedAttribute('title',$locale,$fallbackLocale)}}">
                                    </picture>
                                </a>
                                <div class="text">
                                    <p class="date">{{$post->getTranslatedAttribute('period',$locale,$fallbackLocale)}}</p>
                                    <a href="{{route('catalog.show',[$category,$post->slug])}}" class="title">{{$post->getTranslatedAttribute('title',$locale,$fallbackLocale)}} <i class="icon"></i></a>
                                    <p class="description">{{Str::limit($post->getTranslatedAttribute('excerpt',$locale,$fallbackLocale), 165, '...')}}</p>
                                    <a href="{{route('catalog.show',[$category,$post->slug])}}" class="btn-dark">@lang('general.more')</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center d-flex w-100 justify-content-center">@lang('general.noFiles')</p>
                    @endif
                </div>
                {{--{!! $sales->links() !!}--}}
            </div>
            <div class="sidebar col-3">
                <ul class="sidebar-menu">
                    @foreach($categories as $cat)
                        <li @if($cat->id == $category->id) class="active" @endif ><a href="{{$cat->link}}">{{$cat->getTranslatedAttribute('name',$locale,$fallbackLocale)}}</a></li>
                    @endforeach
                </ul>
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection
