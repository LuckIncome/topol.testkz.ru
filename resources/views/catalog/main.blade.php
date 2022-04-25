@extends('app')
@section('title',($seoTitle ? $seoTitle : __('general.catalogTitle')))
@section('seo_title', ($seoTitle ? $seoTitle : __('general.catalogTitle')))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',env('APP_URL').'/images/og.jpg')
@section('url',url()->current())
@section('page_class','catalog')
@section('content')
    <div class="page catalog main-catalog">
        <div class="content-nosidebar">
            <div class="content col-12">
                <h1>@lang('general.catalogTitle')</h1>
                @include('partials.breadcrumbs',['title'=>($seoTitle ? $seoTitle : __('general.catalogTitle'))])
                <div class="items">
                    @foreach($categories as $category)
                        <div class="item">
                            <a href="{{$category->link}}">
                                <picture class="image">
                                    <source srcset="{{$category->webpImage}}" type="image/webp">
                                    <source srcset="{{$category->bigThumb}}" type="image/pjpeg">
                                    <img src="{{$category->bigThumb}}" alt="{{$category->getTranslatedAttribute('name',$locale,$fallbackLocale)}}">
                                </picture>
                                <p>{{$category->getTranslatedAttribute('name',$locale,$fallbackLocale)}} <i class="icon"></i></p>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
