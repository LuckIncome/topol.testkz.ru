@extends('app')
@section('title',($seoTitle ? $seoTitle : $page->title))
@section('seo_title', ($seoTitle ? $seoTitle : $page->seo_title))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',\Voyager::image($page->thumbic))
@section('url',url()->current())
@section('page_class','base')
@section('content')
    <div class="page single-post about-page">
        <div class="content-sidebar">
            <h1>{{$page->title}}</h1>
            @include('partials.breadcrumbs',['title'=>($seoTitle ? $seoTitle : $page->title)])
            <div class="content col-9">
                <div class="text-content">
                  {!! $page->body !!}
                </div>
                <div class="tab-slider">
                    <div class="content">
                        @foreach($pages as $item)
                        <div class="item img-hover">
                            <a href="{{route('about.show',$item)}}" class="image">
                                <picture>
                                    <source srcset="{{$item->webpImage}}" type="image/webp">
                                    <source srcset="{{$item->bigThumb}}" type="image/pjpeg">
                                    <img src="{{$item->bigThumb}}"
                                         alt="{{$item->seo_title ? $item->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $item->getTranslatedAttribute('title',$locale,$fallbackLocale)}}">
                                </picture>
                            </a>
                            <a href="{{route('about.show',$item)}}" class="name">{{$item->getTranslatedAttribute('title',$locale,$fallbackLocale)}} <i class="icon"></i></a>
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
                <div class="text-content">
                    {!! $page->body_footer !!}
                </div>
                <div class="action-tab-block">
                    <nav>
                        <div class="nav nav-tabs align-items-end" id="nav-advantages-tab" role="tablist">
                            @foreach($advantages as $i=>$advantage)
                                <a class="nav-item nav-link {{$i == 0 ? 'active': ''}}" id="nav-av-{{$i}}-tab" data-toggle="tab"
                                   href="#nav-av-{{$i}}" role="tab"
                                   aria-controls="nav-av-{{$i}}" aria-selected="{{$i == 0 ? 'true' : 'false'}}">
                                    <img src="{{Voyager::image($advantage->icon)}}" class="svg" alt="{{$advantage->icon_text}}">
                                    <span>{{$advantage->icon_text}}</span>
                                </a>
                            @endforeach
                        </div>
                    </nav>
                    <div id="nav-advTabContent" class="tab-content" role="tablist">
                        @foreach($advantages as $i => $advantage)
                            <div class="card tab-pane fade  {{$i == 0 ? 'show active': ''}}" id="nav-av-{{$i}}" role="tabpanel"
                                 aria-labelledby="nav-av-{{$i}}-tab">
                                <div class="card-header {{$i == 0 ? 'active-acc': ''}} " role="tab" id="heading-av-{{$i}}">
                                    <h5 class="mb-0">
                                        <a data-toggle="collapse" href="#collapse-av-{{$i}}"
                                           aria-expanded="{{$i == 0 ? 'true' : 'false'}}"
                                           aria-controls="collapse-av-{{$i}}">
                                            <img src="{{Voyager::image($advantage->icon)}}" class="svg"
                                                 alt="{{$advantage->icon_text}}">
                                            <span>{{$advantage->icon_text}}</span>
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse-av-{{$i}}" class="collapse {{$i == 0 ? 'show': ''}}" role="tabpanel"
                                     aria-labelledby="heading-av-{{$i}}" data-parent="#nav-advTabContent">
                                    <div class="card-body">
                                        <div class="action-block about">
                                            <picture>
                                                <source srcset="{{$advantage->webpImage}}" type="image/webp">
                                                <source srcset="{{$advantage->bigThumb}}" type="image/pjpeg">
                                                <img src="{{$advantage->bigThumb}}"
                                                     alt="{{$advantage->title}}">
                                            </picture>
                                            <div class="text">
                                                <h2>{{$advantage->title}}</h2>
                                                <p>{{$advantage->text}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="sidebar col-3">
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection