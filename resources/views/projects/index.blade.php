@extends('app')
@section('title',($seoTitle ? $seoTitle : $page->title))
@section('seo_title', ($seoTitle ? $seoTitle : $page->title))
@section('meta_keywords', $keywords)
@section('meta_description', $description)
@section('image',\Voyager::image($page->thumbic))
@section('url',url()->current())
@section('page_class','posts')
@section('content')
    <div class="page posts">
        <div class="content-sidebar">
            <h1>{{$page->title}}</h1>
            @include('partials.breadcrumbs',['title'=>__('general.pageAbout'),'titleLink'=>route('pages.about'),'subtitle' => $page->title])
            <div class="content col-9">
                <div class="items">
                    @if($projects->count())
                        @foreach($projects as $post)
                            <div class="item img-hover">
                                <a href="{{route('projects.show',$post)}}" class="image">
                                    <picture>
                                        <source srcset="{{$post->webpImage}}" type="image/webp">
                                        <source srcset="{{$post->bigThumb}}" type="image/pjpeg">
                                        <img src="{{$post->bigThumb}}" alt="{{$post->seo_title ? $post->getTranslatedAttribute('seo_title',$locale,$fallbackLocale) : $post->getTranslatedAttribute('title',$locale,$fallbackLocale)}}">
                                    </picture>
                                </a>
                                <div class="text">
                                    <p class="date">{{$post->getTranslatedAttribute('category',$locale,$fallbackLocale)}}</p>
                                    <a href="{{route('projects.show',$post)}}" class="title">{{$post->getTranslatedAttribute('title',$locale,$fallbackLocale)}} <i class="icon"></i></a>
                                    <p class="description">{{Str::limit($post->getTranslatedAttribute('excerpt',$locale,$fallbackLocale), 165, '...')}}</p>
                                    <a href="{{route('projects.show',$post)}}" class="btn-dark">@lang('general.more')</a>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="text-center d-flex w-100 justify-content-center">@lang('general.noFiles')</p>
                    @endif
                </div>
                {!! $projects->links() !!}
            </div>
            <div class="sidebar col-3">
                <ul class="sidebar-menu">
                    @foreach($pages as $item)
                        @if($item->id == $page->id)
                            <li class="active"><span>{{$item->title}}</span></li>
                        @else
                            <li><a href="{{$item->url}}">{{$item->title}}</a></li>
                        @endif
                    @endforeach
                </ul>
                @include('partials.subscribe')
            </div>
        </div>
    </div>
@endsection