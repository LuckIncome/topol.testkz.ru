@extends('app')
@section('title',($seoTitle ? $seoTitle : $subcategory->getTranslatedAttribute('name',$locale,$fallbackLocale)))
@section('seo_title', ($seoTitle ? $seoTitle : $subcategory->getTranslatedAttribute('name',$locale,$fallbackLocale)))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',\Voyager::image($subcategory->thumbic))
@section('url',url()->current())
@section('page_class','catalog-products subcategories')
@section('content')
    <div class="page catalog-products subcategories">
        <div class="content-sidebar">
            <h1>{{$subcategory->getTranslatedAttribute('name',$locale,$fallbackLocale)}}</h1>
            @include('partials.breadcrumbs',[
            'title'=>($seoTitle ? $seoTitle : $category->getTranslatedAttribute('name',$locale,$fallbackLocale)),
            'titleLink' => route('catalog.show',$category),
            'subtitle' => $subcategory->getTranslatedAttribute('name',$locale,$fallbackLocale)])
            <div class="content col-9">
                @if($subcategory->categories->count())
                    <div class="items">
                        @foreach($subcategory->categories as $subcat)
                            <div class="item img-hover">
                                <a href="{{route('catalog.products',[$category,$subcategory,$subcat])}}" class="image">
                                    <picture>
                                        <source srcset="{{$subcat->webpImage}}" type="image/webp">
                                        <source srcset="{{$subcat->bigThumb}}" type="image/pjpeg">
                                        <img src="{{$subcat->bigThumb}}"
                                             alt="{{$subcat->getTranslatedAttribute('name',$locale,$fallbackLocale)}}">
                                    </picture>
                                </a>
                                <a href="{{route('catalog.products',[$category,$subcategory,$subcat])}}"
                                   class="name">{{$subcat->getTranslatedAttribute('name',$locale,$fallbackLocale)}} <i
                                            class="icon"></i></a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-center d-flex w-100 justify-content-start">@lang('general.noFiles')</p>
                @endif
				<p class="d-flex w-100 justify-content-start mt-5 pre-line-text">{{ \Str::limit($subcategory->getTranslatedAttribute('excerpt',$locale,$fallbackLocale),1500,'.') }}</p>
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