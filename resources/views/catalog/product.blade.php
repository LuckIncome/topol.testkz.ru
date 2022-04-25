@extends('app')
@section('title',$product->name)
@section('image',\Voyager::image($product->thumbic))
@section('url',url()->current())
@section('seo_title',$product->seo_title)
@section('meta_description',$product->meta_description)
@section('meta_keywords',$product->meta_keywords)
@section('page_class','product-page')
@section('content')
    <div class="page product-page">
        <div class="content-sidebar">
            <h1>{{$product->name}}</h1>
            <ul class="breadcrumbs">
                <li><a href="/">@lang('general.home')</a></li>
                @foreach($product->parents->reverse() as $parentCat)
                    <li class="sep"><i class="fa fa-angle-right"></i></li>
                    <li><a href="{{$parentCat->link}}">{{$parentCat->getTranslatedAttribute('name',$locale,$fallbackLocale)}}</a></li>
                @endforeach
                <li class="sep"><i class="fa fa-angle-right"></i></li>
                <li class="current"><span>{{$product->name}}</span></li>
            </ul>
            <div class="content col-9">
                <div class="main-info">
                    <a href="{{Voyager::image($product->image)}}" class="image fb"
                       data-fancybox="gallery-{{$product->id}}">
                        <picture>
                            <source srcset="{{$product->webp}}" type="image/webp">
                            <source srcset="{{$product->bigThumb}}" type="image/pjpeg">
                            <img src="{{$product->bigThumb}}"
                                 alt="{{$product->seo_title ? $product->seo_title : $product->name}}">
                        </picture>
                    </a>
                    <div class="text">
                        <div class="description">
                            {!! $product->description !!}
                        </div>
                        <a href="#" class="btn-darkgreen" data-target="#callbackModal" data-toggle="modal"
                           data-page="{{$product->name}}  | Товар">@lang('general.makeRequest')</a>
                    </div>
                </div>
                <div class="tab-info">
                    <nav>
                        <div class="nav nav-tabs align-items-end" id="nav-productTab" role="tablist">
                            <a class="nav-item nav-link active" id="nav-functions-tab" data-toggle="tab"
                               href="#nav-functions" role="tab"
                               aria-controls="nav-functions" aria-selected="true">@lang('general.features')</a>
                            <a class="nav-item nav-link" id="nav-chars-tab" data-toggle="tab" href="#nav-chars"
                               role="tab"
                               aria-controls="nav-chars" aria-selected="false">@lang('general.specifications')</a>
                            @if($product->products->count())
                                <a class="nav-item nav-link" id="nav-accessories-tab" data-toggle="tab"
                                   href="#nav-accessories"
                                   role="tab"
                                   aria-controls="nav-accessories"
                                   aria-selected="false">@lang('general.accessories')</a>
                            @endif

                        </div>
                    </nav>
                    <div class="tab-content" id="nav-productTabContent">

                        <div class="tab-pane fade show active" id="nav-functions" role="tabpanel"
                             aria-labelledby="nav-functions-tab">
                            @foreach($product->features as $index => $feature)
                                <div class="block">
                                    <strong>{{$index}}</strong>
                                    <ul>
                                        @foreach($feature as $item)
                                            <li>
                                                <span>{{$item['name']}}</span>
                                                <p>{{$item['value']}}</p>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                        <div class="tab-pane fade" id="nav-chars" role="tabpanel" aria-labelledby="nav-chars-tab">
                            <div class="block">
                                <ul>
                                    <li>
                                        <span>@lang('general.brand')</span>
                                        <p>{{$product->brand}}</p>
                                    </li>
                                    @foreach(unserialize($product->specifications) as $item)
                                        <li>
                                            <span>{{$item['name']}}</span>
                                            <p>{{$item['value']}}</p>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @if($product->products->count())
                            <div class="tab-pane fade" id="nav-accessories" role="tabpanel"
                                 aria-labelledby="nav-accessories-tab">
                                <div class="tab-slider @if($product->products->count() < 3) not-slider @endif">
                                    <div class="content">
                                        @foreach($product->products as $item)
                                            <div class="item img-hover">
                                                <a href="{{env('APP_URL').$item->link}}" class="image">
                                                    <picture>
                                                        <source srcset="{{$item->webpImage}}" type="image/webp">
                                                        <source srcset="{{$item->bigThumb}}"
                                                                type="image/pjpeg">
                                                        <img src="{{$item->bigThumb}}"
                                                             alt="{{$item->seo_title ? $item->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $item->getTranslatedAttribute('name',$locale,$fallbackLocale)}}">
                                                    </picture>
                                                </a>
                                                <a href="{{env('APP_URL').$item->link}}"
                                                   class="name">{{$item->getTranslatedAttribute('name',$locale,$fallbackLocale)}}
                                                    <i class="icon"></i></a>
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
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="sidebar col-3">
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection
