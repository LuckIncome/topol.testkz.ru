@extends('app')
@section('title',($seoTitle ? $seoTitle : $category->getTranslatedAttribute('name',$locale,$fallbackLocale)))
@section('seo_title', ($seoTitle ? $seoTitle : $category->getTranslatedAttribute('name',$locale,$fallbackLocale)))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',\Voyager::image($category->thumbic))
@section('url',url()->current())
@section('page_class','catalog-products')
@section('content')
    <div class="page catalog-products">
        <div class="content-sidebar">
            <h1>{{$category->getTranslatedAttribute('name',$locale,$fallbackLocale)}}</h1>
            @include('partials.breadcrumbs',['title'=>($seoTitle ? $seoTitle : $category->getTranslatedAttribute('name',$locale,$fallbackLocale))])
            <div class="content col-9">
                <div class="items">
                    @foreach($category->categories as $subcat)
                        <div class="item img-hover">
                            <a href="{{route('catalog.child',[$category,$subcat])}}" class="image">
                                <picture @if($subcat->bg) class="default" @endif>
                                    <source srcset="{{$subcat->webpImage}}" type="image/webp">
                                    <source srcset="{{$subcat->bigThumb}}" type="image/pjpeg">
                                    <img src="{{$subcat->bigThumb}}"
                                         alt="{{$subcat->getTranslatedAttribute('name',$locale,$fallbackLocale)}}">
                                </picture>
                                @if($subcat->bg)
                                    @php($subcat->webp = $subcat->bg)
                                    <picture class="bg">
                                        <source srcset="{{$subcat->webp}}" type="image/webp">
                                        <source srcset="{{Voyager::image($subcat->thumbnail('big','bg'))}}" type="image/pjpeg">
                                        <img src="{{Voyager::image($subcat->thumbnail('big','bg'))}}"
                                             alt="{{$subcat->getTranslatedAttribute('name',$locale,$fallbackLocale)}}">
                                    </picture>
                                @endif
                            </a>
                            <a href="{{route('catalog.child',[$category,$subcat])}}"
                               class="name">{{$subcat->getTranslatedAttribute('name',$locale,$fallbackLocale)}} <i
                                        class="icon"></i></a>
                        </div>
                    @endforeach
                </div>
				<p class="d-flex w-100 justify-content-start mt-5 pre-line-text">{{ \Str::limit($category->getTranslatedAttribute('excerpt',$locale,$fallbackLocale),1500,'.') }}</p>
            </div>
            <div class="sidebar col-3">
                <ul class="sidebar-menu">
                    @foreach($categories as $cat)
                        <li @if($cat->id == $category->id) class="active" @endif ><a href="{{route('catalog.show',[$cat])}}">{{$cat->getTranslatedAttribute('name',$locale,$fallbackLocale)}}</a></li>
                    @endforeach
                </ul>
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection